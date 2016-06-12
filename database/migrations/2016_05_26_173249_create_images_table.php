<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('path', 255);
            $table->string('path_hash',50);
            $table->string('file_name');
            $table->string('file_hash',50);
            $table->dateTime('exif_date_time');
            $table->integer('exif_width');
            $table->integer('exif_height');
            $table->string('exif_camera_model',255);
            $table->string('exif_iso',255);
            $table->string('exif_focal_length_mm',255);
            $table->string('exif_file_size',255);
            $table->string('exif_file_date_time',255);
            $table->string('exif_orientation',255);
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
        Schema::drop('images');
    }
}
