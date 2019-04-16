<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jy_message', function (Blueprint $table) {
            $table->increments('id')->comment('短信或邮件下发记录');
            $table->enum('type',[1,2])->default('1')->comment('1短信，2邮件');
            $table->string('get_user',100)->default('')->comment('邮件或短信的接收者');
            $table->string('content')->default('')->comment('发送的内容');
            $table->timestamps();

            $table->engine="InnoDB";
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jy_message');
    }
}
