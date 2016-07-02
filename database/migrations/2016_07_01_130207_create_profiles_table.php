<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        chema::create('users', function($table)
//        {
//            $table->increments('id');
//        });
    Schema::create('profile', function(Blueprint $table){
        $table->increments('id');
        $table->string('name');
        $table->string('address');
        $table->double('phone_number');
        $table->json('interested_events');
        $table->integer('user_id')->unsigned();
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
//        $table->timestamps();


    });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('profiles');
    }
}
