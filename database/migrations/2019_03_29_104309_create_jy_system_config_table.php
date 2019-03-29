<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJySystemConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jy_system_config', function (Blueprint $table) {
            $table->increments('id')->comment('系统配置表');
            $table->string('system_name',20)->default('')->comment('系统名称');
            $table->string('s_key',20)->default('')->comment('系统配置key');
            $table->string('s_value',100)->default('')->comment('系统配置value值');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jy_system_config');
    }
}
