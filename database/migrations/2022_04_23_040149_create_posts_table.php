<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            // this will be unsigned to get all the positive 
            // values. index is also provided here for giving it a 
            // bit of speed inside the database
            // $table->integer('user_id')->unsigned()->index();
            // this would reference the users table using the id column
            // that means we have a foreignkey constraind to this
            // here if a user is deleted then the posts related with 
            // the user will also be deleted
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('body');
            $table->timestamps();  // we get created at and updated at column
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
