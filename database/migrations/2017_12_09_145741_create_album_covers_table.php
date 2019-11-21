<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumCoversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('album_covers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 64);
            $table->string('subtitle', 64);
            $table->string('filename', 256);
            $table->integer('filesize');
            $table->string('img', 256);
            $table->string('logo', 256);
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
        Schema::dropIfExists('album_covers');
    }
}
