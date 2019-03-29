<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJyArticleContentTable extends Migration
{
    /**
     * Run the migrations.
     *  文章内容表
     * @return void
     */
    public function up()
    {
        Schema::create('jy_article_content', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('a_id')->default(0)->comment('文章id');
            $table->text('content')->comment('文章的内容');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jy_article_content');
    }
}
