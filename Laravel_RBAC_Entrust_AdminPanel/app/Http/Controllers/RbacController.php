<?php
//RBAC uses Entrust package
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View; //for return View::make
use App\models\EntrustRbac\Role; //model for Entrust Role model
use App\User;
use MyHelper; //my helper
use Illuminate\Validation\Rule; //for in: validation
use Illuminate\Support\Facades\Validator; //for form validation
//use Zizaco\Entrust\Traits\EntrustUserTrait; 
//use Zizaco\Entrust\EntrustRole; 
use App\models\EntrustRbac\My_rbac\Role_User; //model for DB table Role_User
use App\Http\Requests\AssignRoleRequest; //validation request class

class RbacController extends Controller
{
    /**
     * display Users Table with Control Panel wo change RBAC roles
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    //check if logged
		if (!Auth::check()){
			$text = 'You are not logged, <a href="'. route('login') . '"> click here  </a>  to login';
			throw new \App\Exceptions\myException( $text );
		}
		
	    $userX = User::find( \Auth::user()->id ); //to pass to view, for checking with Blade
	  		
		if(Auth::user()->hasRole('admin')){ //
			$status = true;
			
        } else {
			$status = false;
            //throw new \App\Exceptions\myException('You have No rbac rights');
		}
		
        $allUsers = User::all(); //find all users for table
		$allRoles = Role::all(); //find all roles for dropdown
	    return View::make('rbac.rbacView')->with(compact('status', 'userX', 'allUsers', 'allRoles'));
	}
	
	
	
    /**
     * method to create roles in RBAC (run it one time manually)
     *
     * @return \Illuminate\Http\Response
     */
    public function createRoles()
    {	
	    $model = new Role(); 
	    //$model ->setup(); //creating roles
        $model ->assign();	   
	    echo "Good";      
    }
	
	
	
    /**
     * Method to assign role (from RBAC Table Control Panel )
     * @param  AssignRoleRequest $request, validation via Request Class
     * @return \Illuminate\Http\Response
     */
    public function assignRole(AssignRoleRequest $request) 
    {
		//apart from {required} validation rule, check if {$request->input('role_sel')}, i.e $_POST['role_sel'] in not null (if user clicked "assigned" while did not select a role in dropdown). Actually, it should never fire, as validation "required" works first
		if ($request->input('role_sel') == null) {
		    return redirect('/rbac')->with('flashMessageFailX', "Stopped. No role was selected" );
		}
		
		//if a selected user has already the role u want to assign to him. intval() is a must as $_POST is string
		if (Role_User::where('user_id', intval($request->input('user_id')))->where('role_id', intval($request->input('role_sel')) )->exists()) { 
		    //gets the role name by id from DB table Roles
			$roleAssigned = Role::where('id', intval($request->input('role_sel')))->get()[0]->name;
			return redirect('/rbac')->with('flashMessageFailX', "Stopped. User <b> " . User::where('id', intval($request->input('user_id')))->get()[0]->name . " </b>has already role <b>" . $roleAssigned .  "</b> u want to assign");
		}
			
		//assign a selected user with a selected role
		$model = new Role();
        
	    if($model->assignSelectedRoleToSelectedUser(intval($request->input('user_id')), intval($request->input('role_sel')))){   
			//gets the role name by id from DB table Roles
			$roleAssigned = Role::where('id', intval($request->input('role_sel')))->get()[0]->name;
				
			//gets the user name by id from DB table Users
			$userAssigned = User::where('id', intval($request->input('user_id')))->get()[0]->name;
				
			return redirect('/rbac')->with('flashMessageX', "<i class='	fa fa-info-circle' style='font-size:28px;color:black'></i> Successfully assigned user <b>" . $userAssigned . " </b>  with role <b> " . $roleAssigned. "</b>" );
	        
		} else {
			//something failed
			return redirect('/rbac')->with('flashMessageFailX', "Something went wrong" );
		}				
		
	}
	
	
	
	/**
     * method to detach a certain role from certain user (from RBAC Table Control Panel), send via POST form
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function detachRole(Request $request)
    {
		//gets the role name by id from DB table Roles
		$roleDetached = Role::where('id', intval($request->input('role_id')))->get()[0]->name;
		
		//gets the user name by id from DB table Users
		$userDetached = User::where('id', intval($request->input('user_id')))->get()[0]->name;
		
		//Works ONLY if u have 'admin' Rbac role in your web application!!!!!!
		//check if current user tries to detach/remove "admin" right from himself, i.e he will loose access to this RBAC panel
		$RoleAdmin = Role::where('name', 'admin')->get()->first(); //gets Object role 'admin' from Db
		if($RoleAdmin){
		    if(intval($request->input('user_id')) == auth()->user()->id && intval($request->input('role_id')) == $RoleAdmin->id ){
			    //throw new \App\Exceptions\myException("You attempeted to detach your own Admin roles that would result in loosing access to this RBAC Panel");
		        return redirect('/rbac')->with('flashMessageFailX', "<b>Danger!!! <i class='fa fa-thumbs-o-down'></i></b></br><i>You attempeted to detach your own Admin roles that would result in loosing access to this RBAC Panel</i>" );
		    }
		}
		
		//assign a selected user with a selected role
		$model = new Role();
		if($model->detachSelectedRoleFromSelectedUser(intval($request->input('user_id')), intval($request->input('role_id')) )){
		    return redirect('/rbac')->with('flashMessageX', "Detached successfully role <b> " . $roleDetached  . "</b> from user <b> " . $userDetached . "</b>" );
        } else {
			return redirect('/rbac')->with('flashMessageFailX', "Failed Detaching role <b> " . $roleDetached  . "</b> from user <b> " . $userDetached . "</b>" );

		}
	
	}
	
	
	/**
     * method to add/create a new role to Db table Role, send via POST
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeNewRole(Request $request)
    {
		
		//validation rules
        $rules = [
			'rname'  => ['required', 'string', 'min:4' ] , 
			'rDescr' => ['required', 'string', 'min:8' ] , 
			
		];
		
		//creating custom error messages. Should pass it as 3rd param in Validator::make()
		$messages = [
			'rname.required' => 'Required.We need the name to be specified',
			'rDescr.min'     => 'Description must be at least 8 letters'
		];
		
		//validate the input
		$validator = Validator::make($request->all(),$rules, $messages);
		
		//if validation fails
		if ($validator->fails()) {
			return redirect('/rbac')
			    ->withInput()
			    ->with('flashMessageFailX', "Validation Failed")
			    ->withErrors($validator);
		
		//if validation is OK
		} else {  
		    //create/insert a new role
			if (Role::where('name', $request->input('rname'))->exists()){ 	
			    return redirect('/rbac')->with('flashMessageFailX', "Stopped. Role role <b> " . $request->input('rname')  . "</b> already exists" );
			}
			
 		    $model = new Role();
			
		    if($model->createNewRole($request->input('rname'), $request->input('rDescr'))){
		        return redirect('/rbac')->with('flashMessageX', "Successfully created a new role <b> " . $request->input('rname')  . "</b>" );
            } else {
			    return redirect('/rbac')->with('flashMessageFailX', "Failed to create a new role <b> " . $request->input('rname')  . "</b>" );
		    }
		   
		}
	}
	
}