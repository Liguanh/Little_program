<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJyUserFundHistoryTable extends Migration
{
    /**
     * Run the migrations.
     * 用户资金流水表
     * @return void
     */
    public function up()
    {
        Schema::create('jy_user_fund_history', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->default(0)->comment('用户id');
            $table->decimal('amount',10,2)->default('0.00')->comment('变动金额 负数减少 正数增加');
            $table->enum('type',[1,2,3])->default('1')->comment('1红包奖励 2 退款  3转账');
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
        Schema::dropIfExists('jy_user_fund_history');
    }
}
