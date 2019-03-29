<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJyGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jy_goods', function (Blueprint $table) {
            $table->increments('id')->comment('商品表');
            $table->integer('cate_id')->default(0)->comment('商品分类id');
            $table->integer('brand_id')->default(0)->comment('品牌id');
            $table->integer('type_id')->default(0)->comment('商品类型');
            $table->string('goods_name',30)->default('')->comment('商品名称');
            $table->string('goods_sn',16)->default('')->comment('商品货号');
            $table->decimal('shop_price',10,2)->default(0.00)->comment('市场价');
            $table->decimal('market_price',10,2)->default(0.00)->comment('本店售价');
            $table->integer('goods_num')->default(rand(1,100))->comment('库存数量');
            $table->integer('warn_num')->default(0)->comment('库存报警数量');
            $table->string('keywords',30)->default('')->comment('商品关键字');
            $table->text('goods_desc')->comment('商品描述');
            $table->enum('is_shop',[1,2])->default('1')->comment('是否上架 1，是 2否');
            $table->timestamp('shop_time')->comment('上架时间');
            $table->enum('is_recommand',[1,2])->default('1')->comment('是否推荐 1，是 2否');
            $table->enum('is_new',[1,2])->default('1')->comment('是否最新 1，是 2否');
            $table->enum('is_hot',[1,2])->default('1')->comment('是否热销 1，是 2否');
            $table->integer('sort')->default(100)->comment('商品排序');
            $table->integer('give_score')->default(0)->comment('商品送的积分');
            $table->enum('status',[1,2])->default(1)->comment('1未审核  2已审核');
            $table->timestamps();
            $table->unique('goods_sn');
            $table->index('goods_name');
            $table->index('keywords');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jy_goods');
    }
}
