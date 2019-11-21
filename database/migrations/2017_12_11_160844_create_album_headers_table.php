<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('album_headers', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('status')->default(true);
            $table->string('title', 256)->nullable();
            $table->string('logo', 256)->nullable();
            $table->string('img', 256);
            $table->string('xs_img', 256);
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
        Schema::dropIfExists('album_headers');
    }
}
