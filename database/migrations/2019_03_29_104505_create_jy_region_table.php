<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJyRegionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jy_region', function (Blueprint $table) {
            $table->increments('id')->comment('地区表');
            $table->integer('f_id')->comment('上级id');
            $table->string('region_name',20)->comment('地区名字');
            $table->tinyInteger('level')->default(0)->comment('地区级别');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jy_region');
    }
}
