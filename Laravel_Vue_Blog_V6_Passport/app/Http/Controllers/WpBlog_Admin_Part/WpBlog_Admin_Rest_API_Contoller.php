<?php

namespace App\Http\Controllers\WpBlog_Admin_Part;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Storage;
use Illuminate\Support\Facades\DB;
use App\models\wpBlogImages\Wpress_images_Posts;    //model for all posts
use App\models\wpBlogImages\Wpress_images_Category; //model for all Wpress_images_Category
use App\models\wpBlogImages\Wpress_ImagesStock; //table for images
use App\User; 
use App\Http\Requests\UpdateExistingArticleRequest; //Validation Request Class
use App\Http\Controllers\Controller; //to move Controller to subfolder

class WpBlog_Admin_Rest_API_Contoller extends Controller
{
    public function __construct(){
		//$this->middleware('auth');        
	}
	
	
	
	/**
     * Admin REST API endpoint to /GET all posts
     * Ajax Requst comes from ........../resources/assets/js/WpBlog_Admin_Part/components/pages/list_all.vue.
     * Triggered in beforeMount() in /list_all.vue
     * @return json
     */
	public function getAllAdminPosts(Request $request) 
    {   

        $posts = Wpress_images_Posts::with('getImages', 'authorName', 'categoryNames')->orderBy('wpBlog_created_at', 'desc')->get(); 
        return response()->json(['error' => false, 'data' => $posts]);
    }
	
	

	
	/**
     * Admin REST API endpoint to /GET get one blog/item by ID. Used in edit/update Form.
     * Ajax Requst comes from ........../resources/assets/js/WpBlog_Admin_Part/components/pages/editItem.vue. Triggered automatically in beforeMount()
     * @return \Illuminate\Http\Response
     */
    public function getAllAdminOneItem($idX)
    {   
        //check if record with this id exists	
	    if (!Wpress_images_Posts::where('wpBlog_id', $idX)->exists()) { 
		    return response()->json(['error' => true, 'data'   => "Article does not exist"]);
		}
		
        $posts = Wpress_images_Posts::with('getImages', 'authorName', 'categoryNames')->where('wpBlog_id', $idX)->orderBy('wpBlog_created_at', 'desc')->get(); // hasMany/belongTo Eager Loading
        return response()->json(['error' => false, 'data' => $posts]);
    }
	

    
    /**
     * Admin REST API endpoint to Update/Edit one blog/item by ID, used via /PUT . Triggered by Edit/Update Form "Submit" button.
     * Ajax Requst comes from ........../resources/assets/js/WpBlog_Admin_Part/components/pages/editItem.vue. Triggered by clicking Form "Submit" button
     * @param int $idX, an id of edited post, set in URL(in editItem.vue) like this 'api/post/admin_get_one_blog/' + idZ 
     * @param UpdateExistingArticleRequest $request, e.gt => [ "title" => "Text", "body" => "JavaScript Tutorial", "selectV" => "3", "imageToDelete" => "66", "_method" => "PUT", "imagesSet" => array:1 [0 => UploadedFile {#1172, -originalName: "2254.png", -mimeType: "image/png", -size: 30871} ] 
     * @return \Illuminate\Http\Response
     */
    public function AdminUpdateOneItem($idX, UpdateExistingArticleRequest $request)  
    {   
         //Due to overridded {function failedValidation(Validator $validator)} in RequestClass, we can proceed here, even if Validation fails
        if (isset($request->validator) && $request->validator->fails()) {
           return response()->json([
               'error' => true, 
               'data' => 'Was seemed to be OK, but validation failed', 
               'validateErrors'=>  $request->validator->messages()]);
        }
		
		//check if record with this id exists
        if (!Wpress_images_Posts::where('wpBlog_id', $idX)->exists()) { 
		    return response()->json(['error' => true, 'data'   => "Article u want to update does not exist"]);
		}
        
        $model = new Wpress_images_Posts();
        //Updates one post/item in DB 'wpressimages_blog_post'
        $updatePost = $model ->updatePostItem($idX, $request); 
        //Saves new images (if any) to DB Wpress_ImagesStock (new images that a user uploaded while updtaing/editing a post)
        $uploadNewImg = $model->updateNewImages($idX, $request); //dd(5);
        //Deletes old images (if any) to DB DB Wpress_ImagesStock (old images that a user wished to delete while updtaing/editing a post)
        $deleteOldImg = $model->deleteOldImages($idX, $request);
        
        
        return response()->json([
            'error' => false, 
            'data' => 'Successfully updated. </br>' . 
                    $updatePost   . ' </br> ' .  //Title: 'xxx', body: 'xxx', category: 'xxx'
                    $uploadNewImg . ' </br> ' .  //'User Uploaded new Images' || 'User did not loaded new images'
                    $deleteOldImg                //'While updating a user requested to delete Images' || 'User did not opted to delete any old images'
        ]);
    }
	
    
    
	
    /**
     * Admin REST API endpoint to /DELETE one item (one post in DB {Wpress_images_Posts} and realtive images in DB {Wpress_ImagesStock})
     * Ajax Requst for Delete comes from ........../resources/assets/js/WpBlog_Admin_Part/components/pages/list_all.vue
	 * @param int $idN
     * @return json
     */
	public function deleteOneItem($idN) 
    {
        $data = Wpress_images_Posts::with('getImages')->findOrFail($idN);

        //version for $db->findOrFail($idN), i.e if it  returns one object
        $text = "";
        if ($data->getImages->isEmpty()){
            $text.= ' No images connected to post found. ';
        } else {
            foreach($data->getImages as $f){
                $text.= " Id to delete: " . $f->wpImStock_id . " ";
                //Delete relevant images from folder 'images/wpressImages/'
                if(file_exists(public_path('images/wpressImages/' .  $f->wpImStock_name))){
		            \Illuminate\Support\Facades\File::delete('images/wpressImages/' . $f->wpImStock_name);
		        }
                
                //Delete relevant images from DB table {Wpress_ImagesStock} (images connected to post blog)
                $img = Wpress_ImagesStock::findOrFail($f->wpImStock_id); 
                $img->delete();
            }
        }
        $data->delete(); //delete the Post itself from DB  {Wpress_images_Posts}       
        
        return response()->json([
            'error' => false, 
            'data'  => 'Successfully deleted Post ID: ' . $idN . '. </br> ' .
                       'Relevant images connected to post were deleted from Wpress_ImagesStock with IDs: ' . $text
        ]);         
    }
	
}
