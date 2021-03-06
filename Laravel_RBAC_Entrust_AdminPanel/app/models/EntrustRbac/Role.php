<?php 
//it is Entrust RBAC model

namespace App\models\EntrustRbac;

use Zizaco\Entrust\EntrustRole;
use App\User;
use App\models\EntrustRbac\My_rbac\Role_User; //model for DB table Role_User. used for manual detaching/removing a selected role from selected user as {$selectedUser->detachRoles($selectedRole) does not work} 


class Role extends EntrustRole
{
	
	/**
     * method to assign a selected user with selected role (assigned from Entrust Rbac Admin Panel table)
     * @param int $user
	 * @param int $role
     * @return boolean
     */
	public function assignSelectedRoleToSelectedUser($userID, $roleId){
		$selectedUser = User::find($userID );
		$selectedRole = self::where('id', $roleId)->get()->first();
		$selectedUser->roles()->attach($selectedRole );
		return true;
		
	}
	
	
	/**
     * method to detach/delete/remove a selected role from selected used (triggered from Entrust Rbac Admin Panel table)
     * @param int $user
	 * @param int $role
     * @return boolean
     */
	public function detachSelectedRoleFromSelectedUser($userID, $roleId)
    {
		
	    $selectedUser = User::find($userID ); //$selectedUser = User::firstOrFail($userID );  //
		$selectedRole = self::where('id', $roleId)->get()->first();  //$selectedRole = self::where('id', $roleId)->get()->first(); 
		
		//manual detaching/removing a selected role from selected user as {$selectedUser->detachRoles($selectedRole) does not work} 
		if(Role_User::where('user_id', $userID)->where('role_id', $roleId)->exists()) { 
		    Role_User::where('user_id', $userID)->where('role_id', $roleId)->delete(); //Manual delete
            return true;
		} else {
			return false;
		}
		
	}
	
	
	
	/**
     * method to create/insert a new role (triggered from Entrust Rbac Admin Panel table)
     * @param string $roleName
	 * @param string $roleDescr
     * @return boolean
     */
	public function createNewRole($roleName, $roleDescr)
    {		
		
		if (!self::where('name', $roleName)->exists()){ //if doesnot exist
            $managerC = new Role();
            $managerC->name = $roleName;
            $managerC->display_name = 'custom role'; // optional
            $managerC->description = $roleDescr; // optional
            $managerC->save();
		    return true;
		} else {
			return false;
		}

	}
    
    
    //for test only!
	//creates roles in DB (to create roles manually, must be run by admin one time only)
	public function setup() 
    {
		$roleOwner =  self::where('name', 'owner')->get();
		if (!$roleOwner){ //if doesnot exist
		    $owner = new Role();
            $owner->name         = 'owner';
            $owner->display_name = 'Project Owner'; // optional
            $owner->description  = 'User is the owner of a given project'; // optional
            $owner->save();
		}
		
    
        $roleAdmin =  self::where('name', 'admin')->get();
		if (!$roleAdmin){ //if doesnot exist
            $admin = new Role();
            $admin->name         = 'admin';
            $admin->display_name = 'User Administrator'; // optional
            $admin->description  = 'User is allowed to manage and edit other users'; // optional
            $admin->save();
		}

        $roleManager =  self::where('name', 'manager')->get();
		if (!$roleManager){ //if doesnot exist
           $manager = new Role();
           $manager->name         = 'manager';
           $manager->display_name = 'Company Manager'; // optional
           $manager->description  = 'User is a manager of a Department'; // optional
           $manager->save();
		} else {
			dd('Roles exist');}
    }

	
	//for test only!!!!!!!!!!!!!!!!!!!!!!
	public function assign() 
    {
	   $user = User::find(\Auth::user()->id );
       // role attach alias
       //$user->attachRole('admin'); // parameter can be an Role object, array, or id
	   $admin_role = self::where('name', 'admin')->get()->first();
	   $user->roles()->attach($admin_role);
	   dd("Great");
	}
	
	
}