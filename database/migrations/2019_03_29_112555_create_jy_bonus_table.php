<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJyBonusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jy_bonus', function (Blueprint $table) {
            $table->increments('id')->comment('红包表');
            $table->string('bonus_name',30)->default('')->comment('红包名字');
            $table->decimal('money',10,2)->default(0.00)->comment('红包金额');
            $table->decimal('min_money',10,2)->default(0.00)->comment('满多少钱可使用');
            $table->tinyInteger('expires')->default(0)->comment('用户红包可用天数');
            $table->date('send_start_date')->comment('红包开发日期');
            $table->date('send_end_date')->comment('红包结束发放日期');
            $table->enum('status',[1,2])->default('1')->comment('1可用 2 不可用');
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
        Schema::dropIfExists('jy_bonus');
    }
}
