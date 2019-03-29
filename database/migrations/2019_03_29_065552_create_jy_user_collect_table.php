<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJyUserCollectTable extends Migration
{
    /**
     * Run the migrations.
     * 用户收藏商品记录
     * @return void
     */
    public function up()
    {
        Schema::create('jy_user_collect', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->default(0)->comment('用户id');
            $table->integer('goods_id')->default(0)->comment('商品id');
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
        Schema::dropIfExists('jy_user_collect');
    }
}
