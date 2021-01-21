<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('keywords')->comment('关键字');
            $table->unsignedInteger('author_id')->comment('作者id');
            $table->string('description')->default('')->comment('描述');
            $table->tinyInteger('is_show')->default(1)->comment('文章是否显示，0 否，1是');
            $table->tinyInteger('is_top')->default(0)->comment('文章是否置顶，0 否，1是');
            $table->tinyInteger('is_original')->default(0)->comment('文章是否原创，0 否，1是');
            $table->unsignedInteger('click')->default(0)->comment('文章点击数');
            $table->tinyInteger('tid')->default(0)->comment('标签id');
            $table->timestamps();

            $table->comment ="用户文章表";
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
