<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJyBrandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jy_brand', function (Blueprint $table) {
            $table->increments('id')->comment('商品品牌表');
            $table->string('brand_name',20)->default('')->comment('品牌名字');
            $table->enum('status',[1,2])->default('1')->comment('1可用2禁用');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jy_brand');
    }
}
