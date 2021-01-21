<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('ouid')->default(0)->comment('评论用户id');
            $table->tinyInteger('type')->default(1)->comment('评论类型，文章评论');
            $table->unsignedInteger('pid')->default(0)->comment('父id');
            $table->unsignedInteger('aid')->comment('文章id');
            $table->text('content')->comment('评论内容');
            $table->tinyInteger('status')->default(1)->comment('1已审核，2未审核');
            $table->tinyInteger('is_delete')->default(0)->comment('是否删除 ，0否');
            $table->timestamps();

            $table->comment ="文章评论表";
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
