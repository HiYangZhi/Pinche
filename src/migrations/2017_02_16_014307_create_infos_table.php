<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInfosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type')->default(0);
            $table->string('departure')->default('');
            $table->string('destination')->default('');
            $table->datetime('time')->default('2000-01-01 01:01:01');
            $table->integer('price')->default(0);
            $table->integer('seat')->default(0);
            $table->integer('seat_taken')->default(0);
            $table->string('contact')->default('');
            $table->string('info')->default('')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('passenger_id')->unsigned();
            $table->foreign('passenger_id')->references('id')->on('passengers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('infos');
    }
}
