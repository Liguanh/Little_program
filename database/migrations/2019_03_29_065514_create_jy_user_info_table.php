<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJyUserInfoTable extends Migration
{
    /**
     * Run the migrations.
     * //会员详情表
     * @return void
     */
    public function up()
    {
        Schema::create('jy_user_info', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->default(0)->comment('用户id');
            $table->string('email',50)->default('')->comment('用户邮箱');
            $table->enum('sex',[1,2,3])->default('1')->comment('性别1男 2女 3保密');
            $table->string('link_name',50)->default('')->comment('紧急联系人');
            $table->char('link_phone',11)->default('')->comment('紧急联系人手机号');
            $table->char('invite_code',6)->default('')->comment('用户的邀请码');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jy_user_info');
    }
}
