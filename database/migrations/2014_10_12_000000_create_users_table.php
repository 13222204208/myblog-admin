<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('password');
            $table->tinyInteger('login_enable')->default(0)->comment('是否禁用登陆，0 否，1是');
            $table->string('login_last_time')->default('')->comment('最后登陆时间');
            $table->string('user_portrait')->default('https://scpic.chinaz.net/files/pic/pic9/202007/apic26873.jpg')->comment('头像');
            $table->string('user_explain')->default('hello friends')->comment('说明');
            $table->string('user_display_name')->default('momo')->comment('显示名称');
            $table->string('user_email')->default('')->comment('邮箱');
            $table->timestamps();

            $table->comment ="用户表";
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
