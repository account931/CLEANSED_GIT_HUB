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
use App\User; 
use App\Http\Requests\SaveNewArticleRequest;

class WpBlog_Rest_API_Contoller extends Controller
{
    public function __construct(){
		//$this->middleware('auth');                
	}
	
	
	/**
     * REST API endpoint to /GET all posts
     * Ajax Requst comes onLoad from /assets/js/store/index.js. Triggered in beforeMount(this.$store.dispatch('getAllPosts');) in \resources\assets\js\WpBlog_Vue\components\pages\blog_2021.vue
     * @return json
     */
	public function getAllPosts(Request $request) 
    {   
        $posts = Wpress_images_Posts::with('getImages', 'authorName', 'categoryNames')->orderBy('wpBlog_created_at', 'desc')->get();// hasMany/belongTo Eager Loading
        return response()->json(['error' => false, 'data' => $posts]);
    }
	
	
	/**
     * View one article 
     * no method for "View one article", view one record is extracted from Vuex store (this.$store.state.posts[this.currentDetailID].wpBlog_title)
     *
     *	 
     */
	 
	 
	
	/**
     * REST API to /POST (create) a new blog. 
     * Ajax Requst comes by button click from \resources\assets\js\WpBlog_Vue\components\pages\loadnew.vue
     * @param SaveNewArticleRequest $request
     * @return json
     */
	public function createPost(SaveNewArticleRequest $request) 
    {
        //dd($request->imagesSet);
        //Due to overridded {function failedValidation(Validator $validator)} in RequestClass, we can proceed here, even if Validation fails
        if (isset($request->validator) && $request->validator->fails()) {
           return response()->json([
               'error' => true, 
               'data' => 'Attention, validation failed', 
               'validateErrors'=>  $request->validator->messages()]);
        }
        
		$userX      = Auth::user();  //getting the logged user Object, version for Passport
        $data       = array($request->title, $request->body, $request->selectV); 
		$imagesData = $request->imagesSet; //uploaded images
		
	    try{
			$ticket = new Wpress_images_Posts();
			if($b = $ticket->saveFields($data, $imagesData, $userX->id)){ //$b = 'image1.jpg, image2.jpg'
			    return response()->json(['error' => false, 'data' => 'Post was saved successfully with connected images: ' . $b]);
            } else {
                return response()->json(['error' => true, 'data' => 'Saving failed']);
            }
		} catch(Exception $e){
			return response()->json(['error' => true, 'data' => 'Saving failed']);
		}
    
    }
	
	
	
	
	/**
     * REST API endpoint to /GET all DB table categories (to build <select> in loadnew.vue)
     * Ajax Requst comes onLoad (is in section {mounted ()}) from \resources\assets\js\WpBlog_Vue\components\pages\loadnew.vue
     * @return json
	 *
     */
	public function getAllCategories() 
    { 
        $posts =  Wpress_images_Category::all();//gets categories for dropdown select
        return response()->json(['error' => false, 'data' => $posts]);
    }
	
	
}
