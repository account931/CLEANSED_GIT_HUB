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
use App\User; 
use App\Http\Requests\SaveNewArticleRequest;
use App\Http\Controllers\Controller; //to move Controller to subfolder

class WpBlog_Admin_Rest_API_Contoller extends Controller
{
    public function __construct(){
		//$this->middleware('auth');
        //dd(auth()->user()->id);             
	}
	
	
	
	/**
     * Admin REST API endpoint to /GET all posts
     * Ajax Requst comes from ........../resources/assets/js/WpBlog_Admin_Part/components/pages/list_all.vue.
     * Triggered automatically in beforeMount() in /list_all.vue
     * @return json
     */
	public function getAllAdminPosts(Request $request) //http://localhost/Laravel+Yii2_comment_widget/blog_Laravel/public/post/get_all
    {   
        $posts = Wpress_images_Posts::with('getImages', 'authorName', 'categoryNames')->orderBy('wpBlog_created_at', 'desc')->get(); //->with('getImages', 'authorName', 'categoryNames') => hasMany/belongTo Eager Loading
        return response()->json(['error' => false, 'data' => $posts]);
    }
	
	

	
	/**
     * Admin REST API endpoint to /GET get one blog/item by ID.
     * Ajax Requst comes from ........../resources/assets/js/WpBlog_Admin_Part/components/pages/editItem.vue. Triggered automatically in beforeMount()
     * @return \Illuminate\Http\Response
     */
    public function getAllAdminOneItem($idX)
    {    
        $posts = Wpress_images_Posts::with('getImages', 'authorName', 'categoryNames')->where('wpBlog_id', $idX)->orderBy('wpBlog_created_at', 'desc')->get(); //->with('getImages', 'authorName', 'categoryNames') => hasMany/belongTo Eager Loading
        return response()->json(['error' => false, 'data' => $posts]);
    }
	
	
	
    /**
     * Admin REST API endpoint to /DELETE one item
     * Ajax Requst for Delete comes from ........../resources/assets/js/WpBlog_Admin_Part/components/pages/list_all.vue
     * Triggered by click
     * @return json
     */
	public function deleteOneItem($idN) //http://localhost/Laravel+Yii2_comment_widget/blog_Laravel/public/post/admin_delete_item/{id}
    {
        return response()->json(['error' => false, 'data' => "Implement Deleting for  " . $idN ]); 

        /*
        $data = Abz_Employees::findOrFail($id);
        $info = $data;
        
        //reassign a new superior to deleted user's subordinates. Upon deleting this employee, find this employee subordinates (whose who has this deleted emplyee's ID as in their 'superior_id' column and assign them other superior with the same rank)
		$model = new Abz_Employees();
		$v = $model->reassignSuperior($info);
        
        //delete the image from folder '/images/employees/'
		//$product = Abz_Employees::where('id', $id)->first(); //found image 
		if(file_exists(public_path('images/employees/' . $data->image))){
		    \Illuminate\Support\Facades\File::delete('images/employees/' . $data->image);
		}
        
		$data->delete(); //delete the user
		
		return response()->json(['result' => $v]);
        */        
    }
	
}
