<?php
//Login and register via REST API + Passport
namespace App\Http\Controllers\Auth_API;

use App\Http\Controllers\Controller;
//use App\Models\User;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserAuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        $data['password'] = bcrypt($request->password);

        $user = User::create($data);

        $token = $user->createToken('API Token')->accessToken;

        return response([ 'user' => $user, 'token' => $token]);
    }


    /**
     * Login via Passport 
     * @param Request $request
     * @return Json
     *
     */
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($data)) {
            return response(['error_message' => 'Incorrect Details. Please try again']);
        }
        
        //IMPLEMENT DELTING OLD USER"S PASSPORT TOKEN HERE............
        
        $token = auth()->user()->createToken('API Token')->accessToken; //create token via Passport
        
        //save token to session to use in requests
        //Session::put('PassportToken', $token); //Session get => session()->get('PassportToken');	
        
        return response(['user' => auth()->user(), 'token' => $token ]);

    }
}