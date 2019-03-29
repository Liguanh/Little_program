<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJyAdPositionTable extends Migration
{
    /**
     * Run the migrations.
     * 广告位
     * @return void
     */
    public function up()
    {
        Schema::create('jy_ad_position', function (Blueprint $table) {
            $table->increments('id');
            $table->string('position_name',30)->default('')->comment('广告位名称');
            $table->string('position_desc')->default('')->comment('广告位描述');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jy_ad_position');
    }
}
