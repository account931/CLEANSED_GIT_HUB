<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWpressImageImagesStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
		if (!Schema::hasTable('wpressImage_ImagesStock')) { 
		    Schema::create('wpressImage_ImagesStock', function (Blueprint $table) {
                $table->increments('wpImStock_id');
			    $table->string('wpImStock_name', 77)->nullable();  //equivalent VARCHAR  222 // ->nullable() 
            
			    //Create Foreign key for table {wpressImages_blog_posts}	
			    $table->integer('wpImStock_postID')->unsigned()->nullable()->comment = 'Author ID';
                $table->foreign('wpImStock_postID')->references('wpBlog_id')->on('wpressImages_blog_post')->onUpdate('cascade')->onDelete('cascade');
	            //End Create Foreign key for table {wpressImages_blog_posts}	
			
			    $table->timestamps();
            });
	    }
    }
	
	

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
		Schema::dropIfExists('wpressImage_ImagesStock');
    }
	
}
