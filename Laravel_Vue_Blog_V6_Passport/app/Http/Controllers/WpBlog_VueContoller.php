<?php
//https://medium.com/js-dojo/build-a-simple-blog-with-multiple-image-upload-using-laravel-vue-5517de920796

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Storage;
use Illuminate\Support\Facades\DB;
use App\models\wpBlogImages\Wpress_images_Posts; //model for all posts
use App\models\wpBlogImages\Wpress_images_Category; //model for all Wpress_images_Category
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Cookie;

class WpBlog_VueContoller extends Controller
{
    public function __construct(){
		//$this->middleware('checkX');
		//$Passport_Token = session()->get('PassportToken');  //Session get var=> 
	}
	
	
	
	/**
     * Show all Blog entries (on Vue framework). 
     * uses middleware' => ['sendTokenMy'] in routes/api
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
    
        //if so far no api_token field in {User table}
        /* PASSPORT-purpose CHANGES were made here
        if(auth()->user()->api_token == null){
            return redirect('/getToken')->with('flashMessageFailX', 'Redirected here as no api_token was found. Please generate');
        }
        */
        
        //dd(auth()->guard('api')->user());
        //gets current user Db table field {api_token}
        $myDBToken = 'somee'; // auth()->user()->api_token; //PASSPORT CHANGES
        //$myDBToken = new User();
        //$myDBToken = 'a86d6bc15b3837198fde636319d1fce7c2c915e894021fc38492463a16f396057ccdaa2b993e02a0';
        
        
        
        //$categories = Wpress_images_Category::all();//gets categories for dropdown select
        
        //set global var
        /*        
        session_start();
        session(['myGlobalApiToken' => $myDBToken]);
        //dd(session('myGlobalApiToken'));
        
        Config(['myGlobalApiToken' => $myDBToken]);
        //dd(Config('myGlobalApiToken'));
        */
  
        /*
        Config(['myGlobalApiToken' => $myDBToken]);
        Cache::put('myGlobalApiToken', $myDBToken, 60); 
        session(['myGlobalApiToken' => $myDBToken]);*/
        
        //$data = ['admin_color' => $myDBToken]; // your input];
        //Config::write('admin-settings', $data);
    
        return view('wpBlog_Vue.index')->with(compact('myDBToken'));
    }
	
}
