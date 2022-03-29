<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session; //MINE to redirect to prev page after Login

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home'; //to redirect to prev page after Login
	

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
		//to redirect to prev page after Login
		Session::put('backUrl', url()->previous());
		
    }
	
    
	/**
     * Function to redirect to prev page after Login
     *
     * @return void
     */
    public function redirectTo()
    {
       return session()->get('backUrl') ? session()->get('backUrl') :   $this->redirectTo; //if SESSION['backUrl'] is set, go there, else go "/home"
    }
	
	


}
