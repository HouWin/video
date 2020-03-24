<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->comment('任务标题');
            $table->text('content')->comment('任务内容');
            $table->integer('post_user')->comment('发布者');
            $table->integer('get_user')->nullable()->default(null)->comment('接收者');
            $table->tinyInteger('status')->default(0)->comment('任务状态 0未接收 1已接收 2已完成');
            $table->integer('price')->nullable()->default(null)->comment('价格');
            $table->timestamp('success_time')->nullable()->comment('完成时间');
            $table->timestamps();

            $table->index('post_user');
            $table->index('get_user');
            $table->index('title');
            $table->foreign('post_user')->references('id')->on('users');
            $table->foreign('get_user')->references('id')->on('users');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
