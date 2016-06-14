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
        'path_hash',
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


    public static function isIndexedFilePath( $fileName )
    {
        return ( new static )->where( 'path_hash', '=', md5( $fileName ) )->count() > 0 ?: false;
    }



    public function getPhotosList($limit=30){
        return $this->orderBy('exif_date_time','desc')->paginate($limit);
    }

    public function getFotoUrl(){
        return 'http://192.168.88.187/fotos/'.strrev(dirname(dirname(strrev($this->path)))).'/'.$this->file_name;
    }
}