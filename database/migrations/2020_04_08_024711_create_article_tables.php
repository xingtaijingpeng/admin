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

class CreateArticleTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('status')->default(0)->comment('1正常 2审核 3下架 4删除');
            $table->integer('user_id')->default(0)->comment('发布人ID');
            $table->string('title')->default('')->comment('');
            $table->string('cover')->default('')->comment('');
            $table->string('url')->default('')->comment('外部链接');
            $table->integer('price')->default(0)->comment('价格');
            $table->integer('old_price')->default(0)->comment('原价');
            $table->timestamp('opened_at')->nullable()->comment('公开时间');
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
