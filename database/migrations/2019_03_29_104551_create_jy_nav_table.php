<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJyNavTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jy_nav', function (Blueprint $table) {
            $table->increments('id')->comment('导航栏表');
            $table->string('nav_name',20)->default('')->comment('导航栏的名字');
            $table->string('url',80)->default('#')->comment('导航栏链接地址');
            $table->enum('status',[1,2])->default('1')->comment('状态1可用2禁用');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jy_nav');
    }
}
