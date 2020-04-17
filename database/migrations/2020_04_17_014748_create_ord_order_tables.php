<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/5
 * Time: 12:50
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdOrderTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ord_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('status')->default(0)->comment('1未支付 2已支付 3删除');
            $table->tinyInteger('pay_type')->default(1)->comment('1微信 2支付宝');
            $table->integer('user_id')->default(0)->comment('用户ID');
            $table->string('serial')->default('')->comment('订单号');
            $table->integer('good_id')->default(0)->comment('商品ID');
            $table->string('good_name')->default('')->comment('商品名称');
            $table->integer('price')->default(0)->comment('价格');
            $table->integer('old_price')->default(0)->comment('原价');
            $table->timestamp('payed_at')->comment('支付时间');
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
        Schema::drop('articles');
    }
}
