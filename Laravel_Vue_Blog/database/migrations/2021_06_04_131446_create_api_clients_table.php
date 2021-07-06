<?php
//Confirm delete
//my Rest api token auth implementation (without Passport)

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApiClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('api_clients')) { //my fix for migration

            Schema::create('api_clients', function (Blueprint $table) {
                $table->increments('id');
                $table->string('api_token')->unique();
            });   
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('api_clients');
    }
}
