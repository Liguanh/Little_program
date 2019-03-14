<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChapterTable extends Migration
{
    /**
     * Run the migrations.
     * 小说章节表
     * @return void
     */
    public function up()
    {
        Schema::create('chapter', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('novel_id')->default(0)->comment('小说id');
            $table->string('title',30)->comment('章节标题');
            $table->text('content')->comment('章节内容');
            $table->integer('sort')->default(1)->comment('章节排序');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chapter');
    }
}
