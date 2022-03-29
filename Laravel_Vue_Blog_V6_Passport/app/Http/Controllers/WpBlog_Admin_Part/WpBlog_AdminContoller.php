<?php

namespace App\Http\Controllers\WpBlog_Admin_Part;

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
use Cookie;
use App\Http\Controllers\Controller; //to move Controller to subfolder

class WpBlog_AdminContoller extends Controller
{
    public function __construct(){
		//$this->middleware('checkX');
	}
	
	
	/**
     * Show List of all blogs with Delete/Edit option. Uses Vue component.
     * uses middleware' => ['sendTokenMy'] in routes/api
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		/*
		dd(Auth::guard('api')->user());
		//dd(auth()->user());
		//dd($request->bearerToken()->first());
		$authedUser = Auth::user(); //getting the logged user Object, version for Passport
		dd($authedUser);
        if(!$authedUser->hasAllPermissions(['edit articles', 'delete articles',])){ 
		    throw new \App\Exceptions\myException('No rbac rights');
		}
		*/
        return view('wpBlog_Admin_Part.index');
    }
        
}
