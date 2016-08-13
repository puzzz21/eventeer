<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSpecialRequestToEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('special_requirements');
            $table->integer('price');
            $table->string('tags');
            $table->string('event_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('special_requirements');
            $table->dropColumn('price');
            $table->dropColumn('tags');
            $table->dropColumn('event_type');
        });
    }
}
