<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJyUserAddressTable extends Migration
{
    /**
     * Run the migrations.
     * 收货地址表
     * @return void
     */
    public function up()
    {
        Schema::create('jy_user_address', function (Blueprint $table) {
            $table->increments('id');
            $table->string('address_name',30)->default('')->comment('名称');
            $table->integer('user_id')->default(0)->comment('用户id');
            $table->string('consignee',20)->default('')->comment('收货人姓名');
            $table->smallInteger('country')->default(0)->comment('收货人的国家');
            $table->smallInteger('province')->default(0)->comment('收货人的省份');
            $table->smallInteger('city')->default(0)->comment('收货人城市');
            $table->smallInteger('district')->default(0)->comment('收货人的地区');
            $table->string('address',120)->default('')->comment('收货人的详细地址');
            $table->string('zipcode',20)->default('')->comment('收货人的邮编');
            $table->char('mobile',11)->comment('收货人的手机号');

            $table->timestamps();

            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jy_user_address');
    }
}
