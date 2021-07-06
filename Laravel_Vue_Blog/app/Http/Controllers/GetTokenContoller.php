<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Storage;
use Illuminate\Support\Facades\DB;
use App\models\wpBlogImages\Wpress_images_Posts; //model for all posts
use App\models\wpBlogImages\Wpress_images_Category; //model for all Wpress_images_Category
use App\User; 
use Illuminate\Support\Str;

class GetTokenContoller extends Controller
{
    public function __construct(){
		   //$this->middleware('auth');
	}
	
	
	
	/**
     * Displays current token or button to generate
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userToken;
        $currentUser = auth()->user();
        if ($currentUser->api_token != null){
            $userToken = $currentUser->api_token;
        } else {
            $userToken = null;
        }
        
        return view('get_token.index')->with(compact('userToken'));
        
    }
    
    
    
    /**
     * Generates token
     * 
     * @return \Illuminate\Http\Response
     */
    public function generate()
    {
         //if there is api_token field in {User table}
        if(auth()->user()->api_token != null){
            return redirect('/getToken')->with('flashMessageX', 'You have alredy token');
        }
        
        $currentUser = User::findOrFail(auth()->user()->id);
        $currentUser->api_token = hash('sha256', Str::random(60));
        if($currentUser->save()){
            return redirect('/getToken')->with('flashMessageX', 'Token has been generated successfully!!!');
        }
    }
	
}
