<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserTableAddOpenId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jy_user', function (Blueprint $table) {
            //
            $table->string('open_id', 60)->default('')->after('id')->comment('第三方登陆的openid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jy_user', function (Blueprint $table) {
            //
        });
    }
}
