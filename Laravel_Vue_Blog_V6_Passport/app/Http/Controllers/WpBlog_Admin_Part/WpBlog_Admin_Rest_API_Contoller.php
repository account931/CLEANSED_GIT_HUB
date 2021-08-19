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
//use App\Http\Requests\SaveNewArticleRequest;
use App\Http\Requests\UpdateExistingArticleRequest; //Validation Request Class
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
     * Admin REST API endpoint to /GET get one blog/item by ID. Used in edit/update Form.
     * Ajax Requst comes from ........../resources/assets/js/WpBlog_Admin_Part/components/pages/editItem.vue. Triggered automatically in beforeMount()
     * @return \Illuminate\Http\Response
     */
    public function getAllAdminOneItem($idX)
    {    
        $posts = Wpress_images_Posts::with('getImages', 'authorName', 'categoryNames')->where('wpBlog_id', $idX)->orderBy('wpBlog_created_at', 'desc')->get(); //->with('getImages', 'authorName', 'categoryNames') => hasMany/belongTo Eager Loading
        return response()->json(['error' => false, 'data' => $posts]);
    }
	
	
    
    
    
    /**
     * Admin REST API endpoint to Update/Edit one blog/item by ID, used via  /PUT . Triggered by Edit/Update Form "Submit" button.
     * Ajax Requst comes from ........../resources/assets/js/WpBlog_Admin_Part/components/pages/editItem.vue. Triggered by clicking Form "Submit" button
     * @param $idX, an id of edited post, set in URL(in editItem.vue) like this 'api/post/admin_get_one_blog/' + idZ 
     * @param $request, example of request => [ "title" => "TTTTTTTTT", "body" => "JavaScript Tutorial", "selectV" => "3", "imageToDelete" => "66", "_method" => "PUT", "imagesZZZ" => array:1 [0 => UploadedFile {#1172, -originalName: "2254.png", -mimeType: "image/png", -size: 30871} ] 
     * @return \Illuminate\Http\Response
     */
    public function AdminUpdateOneItem($idX, UpdateExistingArticleRequest $request)  //Request Class validation //Request $request
    {   
         //Due to overridded {function failedValidation(Validator $validator)} in RequestClass, we can proceed here, even if Validation fails
        if (isset($request->validator) && $request->validator->fails()) {
           //return response()->json($request->validator->messages(), 400);
           return response()->json([
               'error' => true, 
               'data' => 'Was seem to be OK, but validation crashes', 
               'validateErrors'=>  $request->validator->messages()]);
        }
        
        
        //Below is just for testing ------
        /*
        //Old images User clicked to delete (while editing)
        $imageToDelete = ' User while updating requested to delete Images: '; 
        
        if ($request->has('imageToDelete')){
            //convert string {$request->imageToDelete} to array
            $del = explode(" ", $request->imageToDelete); // for bizzare reason {$request->imageToDelete) comes to Server as string not array 
            foreach($del as $d){
                $imageToDelete.= $d;    
            }
        } else {
            $imageToDelete.= ' Zero old images ';
        }
        
        //New images uploaded by User (while editing)
        $imagesNew = ' User Uploaded new Images: '; 
        
        if (isset($request->imagesZZZ)){
            foreach($request->imagesZZZ as $d){
                $imagesNew.= " " . $d;    
            }
        } else {
            $imagesNew.= ' Zero new images ';
        }
        
        return response()->json([
            'error' => false, 
            'data' => 'Update is OK. Implement me further. Your ID ' . $idX . ' TITLE: ' . 
                      $request->title . ' ' . $request->body . ' Category: ' . $request->selectV . ' ' .
                      $imageToDelete . ' / ' .
                      $imagesNew
        ]);
        */
        //End Below is just for testing --------
        
        

        
        $model = new Wpress_images_Posts();
        
        //Updates one post/item in DB 'wpressimages_blog_post'
        $updatePost  = $model ->updatePostItem($idX, $request);
        
        //Saves new images (if any) to DB Wpress_ImagesStock (new images that a user uploaded while updtaing/editing a post)
        $uploadNewImg = $model ->updateNewImages($idX, $request);
        
        //Deletes old images (if any) to DB DB Wpress_ImagesStock (old images that a user wished to delete while updtaing/editing a post)
        $deleteOldImg = $model ->deleteOldImages($idX, $request);
        
        
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
     * Triggered by click
     * @return json
     */
	public function deleteOneItem($idN) //http://localhost/Laravel+Yii2_comment_widget/blog_Laravel/public/post/admin_delete_item/{id}
    {
        
        $data = Wpress_images_Posts::with('getImages')->findOrFail($idN);
        //$data = Wpress_images_Posts::with('getImages', 'authorName', 'categoryNames')->where('wpBlog_id', $idN)->orderBy('wpBlog_created_at', 'desc')->get(); //->with('getImages', 'authorName', 'categoryNames') => hasMany/belongTo Eager Loading

        /*
        //version for $db->get(), i.e returns array of objects
        $text = "";
        foreach($data as $b){
            if ($b->getImages->isEmpty()){
                $text.= 'Screw ';
            } else {
                foreach($b->getImages as $f){
                    $text.= " Id to delete: " . $f->wpImStock_id . " ";
                }
                
            }
           
        }
        */
        
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
