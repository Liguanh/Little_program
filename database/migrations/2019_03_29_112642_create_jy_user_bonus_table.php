<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJyUserBonusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jy_user_bonus', function (Blueprint $table) {
            $table->increments('id')->comment('红包发放记录表');
            $table->integer('user_id')->default(0)->comment('用户id');
            $table->integer('bonus_id')->default(0)->comment('红包id');
            $table->timestamp('start_time')->comment('开始时间');
            $table->timestamp('end_time')->comment('结束时间');
            $table->enum('status',[1,2,3])->default('1')->comment('1未使用 2 已使用 3 已过期');
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
        Schema::dropIfExists('jy_user_bonus');
    }
}
