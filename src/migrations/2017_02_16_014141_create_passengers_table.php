<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePassengersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passengers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('openid')->unique()->comment('微信用户openid');
            $table->string('nickname')->default('')->comment('用户昵称');
            $table->string('sex')->default('')->comment('用户的性别');
            $table->string('province')->default('')->comment('用户个人资料填写的省份');
            $table->string('city')->default('')->comment('普通用户个人资料填写的城市');
            $table->string('country')->default('')->comment('国家，如中国为CN');
            $table->string('headimgurl')->default('')->comment('头像');
            $table->string('privilege')->default('')->comment('用户特权信息，json 数组，如微信沃卡用户为（chinaunicom）');
            $table->string('unionid')->default('')->comment('只有在用户将公众号绑定到微信开放平台帐号后，才会出现该字段');
            $table->string('contact')->default('')->comment('用户联系方式');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('passengers');
    }
}
