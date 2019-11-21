<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatelogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catelogs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('album_covers_id');
            $table->tinyInteger('templates');
            $table->string('title', 64)->nullable();
            $table->string('subtitle', 64)->nullable();
            $table->string('content', 512)->nullable();
            $table->string('main_img', 256);
            $table->string('xs_main_img', 256);
            $table->string('sub_img', 256)->nullable();
            $table->string('xs_sub_img', 256)->nullable();
            $table->string('detail', 256)->nullable();
            $table->integer('order');
            $table->boolean('visible')->default(true);
            $table->softDeletes();
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
        Schema::dropIfExists('catelogs');
    }
}
