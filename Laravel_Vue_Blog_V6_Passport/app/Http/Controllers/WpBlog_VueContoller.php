<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Storage;
use Illuminate\Support\Facades\DB;
use App\models\wpBlogImages\Wpress_images_Posts;    //model for all posts
use App\models\wpBlogImages\Wpress_images_Category; //model for all Wpress_images_Category
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Cookie;

class WpBlog_VueContoller extends Controller
{
    public function __construct(){
		//$this->middleware('checkX');
	}
	
	
	/**
     * Show all Blog entries (on Vue framework). 
     * uses middleware' => ['sendTokenMy'] in routes/api
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $myDBToken = 'test'; 
        return view('wpBlog_Vue.index')->with(compact('myDBToken'));
    }
	
}
