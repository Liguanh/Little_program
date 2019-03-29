<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJyGoodsSkuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jy_goods_sku', function (Blueprint $table) {
            $table->increments('id')->comment('商品sku表');
            $table->integer('goods_id')->default(0)->comment('商品id');
            $table->integer('attr_id')->default(0)->comment('属性id');
            $table->string('sku_value',20)->default('')->comment('属性值');
            $table->decimal('attr_price',10,2)->default(0.00)->comment('属性价格');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jy_goods_sku');
    }
}
