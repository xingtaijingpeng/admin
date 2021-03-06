<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('guard')->default('')->comment('守卫');
            $table->string('name')->default('')->comment('');
            $table->Integer('sort')->default(0)->comment('');
            $table->Integer('parent_id')->default(0)->comment('');
            $table->tinyInteger('status')->default(1)->comment('1正常 2停止');
            $table->timestamps();
        });
        Schema::create('sys_categoriables', function (Blueprint $table) {
            $table->Integer('sys_category_id')->default(0)->comment('');
            $table->string('sys_categoriable_type')->default('')->comment('');
            $table->Integer('sys_categoriable_id')->default(0)->comment('');
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
        Schema::dropIfExists('sys_categories');
        Schema::dropIfExists('sys_categoriables');
    }
}
