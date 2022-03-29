<?php
//if troubles with time of creation at 'wpBlog_created_at', set it's default value as null
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWpressImagesBlogPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('wpressImages_blog_post')) {     
		    Schema::create('wpressImages_blog_post', function (Blueprint $table) {
                $table->increments('wpBlog_id');
			    $table->string('wpBlog_title', 222)->nullable();   //VARCHAR с длинной 222 // ->nullable()  is a fix
			    $table->text('wpBlog_text')->nullable();           //equivalent for text 
			    $table->integer('wpBlog_author')->nullable();      //equivalent INTEGER 
			    $table->timestamp('wpBlog_created_at')->nullable();//->default( date('Y-m-d H:i:s') );  //use=> ->default(DB::raw('CURRENT_TIMESTAMP'));   //Эквивалент TIMESTAMP для базы данных
		        //$table->integer('wpBlog_category')->nullable();  //equivalent INTEGER  
			
			    //Create Foreign key for table {}	
			    $table->integer('wpBlog_category')->unsigned()->nullable()->comment = 'Category';
                $table->foreign('wpBlog_category')->references('wpCategory_id')->on('wpressImage_category')->onUpdate('cascade')->onDelete('cascade');
	            //End Create Foreign key for table {}	
			    $table->enum('wpBlog_status', ['0', '1'])->default('1'); //equivalent ENUM 
  
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
        Schema::dropIfExists('wpressImages_blog_post');
    }
}
