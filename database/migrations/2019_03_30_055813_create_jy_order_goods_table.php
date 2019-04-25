<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJyOrderGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jy_order_goods', function (Blueprint $table) {
            $table->increments('id')->comment('订单商品表');
            $table->integer('goods_id')->default(0)->comment('商品id');
            $table->integer('order_id')->default(0)->comment('订单id');
            $table->string('goods_name',30)->default('')->comment('商品名字');
            $table->integer('goods_num')->default(0)->comment('商品购买数量');
            $table->decimal('shop_price',10,2)->default(0.00)->comment('商品市场价');
            $table->decimal('market_price',10,2)->default(0.00)->comment('本店售价');
            $table->string('goods_attr',50)->default('')->comment('属性');
            $table->engine="InnoDB";
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jy_order_goods');
    }
}
