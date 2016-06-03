<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\File
 *
 * @mixin \Eloquent
 */
class Image extends Model
{
    protected $fillable = [
        'path',
        'file_name',
        'file_hash',
        'exif_date_time',
        'exif_width',
        'exif_height',
        'exif_camera_model',
        'exif_iso',
        'exif_focal_length_mm',
        'exif_file_size',
        'exif_file_date_time',
        'exif_orientation'
    ];
}