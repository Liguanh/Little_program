<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJyGoodsAttrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jy_goods_attr', function (Blueprint $table) {
            $table->increments('id')->comment('商品属性');
            $table->integer('cate_id')->default(0)->comemnt('分类id');
            $table->string('attr_name',20)->default('')->comemnt('属性名字');
            $table->enum('input_type',[1,2])->default('1')->comemnt('1、手动输入  2、单选');
            $table->string('attr_value')->default('')->comemnt('属性值');
            $table->enum('status',[1,2])->default('1')->comment('1可用2禁用');
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jy_goods_attr');
    }
}
