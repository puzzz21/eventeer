<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'events',
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('event_name');
                $table->string('venue');
                $table->dateTime('event_date');
                $table->dateTime('event_start_datetime');
                $table->dateTime('event_end_datetime');
                $table->string('logo')->nullable();
                $table->string('description');
                $table->integer('user_id')->unsigned()->index();
                $table->float('latitude')->nullable();
                $table->float('longitude')->nullable();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->timestamps();
            }
        );
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('events');
    }
}
