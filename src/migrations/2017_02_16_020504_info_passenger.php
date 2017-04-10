<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InfoPassenger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //参与活动的用户
        Schema::create('info_passenger',function(Blueprint $table){
            $table->integer('info_id')->unsigned()->index();
            $table->foreign('info_id')->references('id')->on('infos')->onDelete('cascade');
            $table->integer('passenger_id')->unsigned()->index();
            $table->foreign('passenger_id')->references('id')->on('passengers')->onDelete('cascade');
            $table->string('contact')->default('');
            $table->integer('seat')->default(1);
            $table->timestamps();
            $table->unique(['info_id','passenger_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('info_passenger');
    }
}
