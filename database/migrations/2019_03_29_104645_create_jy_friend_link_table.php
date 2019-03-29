<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJyFriendLinkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jy_friend_link', function (Blueprint $table) {
            $table->increments('id')->comment('友情链接表');
            $table->string('link_name',20)->default('')->comment('链接的名字');
            $table->string('url',80)->default('#')->comment('链接地址');
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
        Schema::dropIfExists('jy_friend_link');
    }
}
