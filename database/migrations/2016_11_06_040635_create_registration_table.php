<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registration', function (Blueprint $table) {
            $table->increments('id');
            $table->text('firstName');
            $table->text('lastName');
            $table->text('email');
            $table->text('cellPhone');
            $table->text('gender');
            $table->text('age');
            $table->text('event_id');
            $table->text('user_id');
            $table->text('registration_no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('registration');
    }
}
