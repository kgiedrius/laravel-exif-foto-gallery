<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use League\Flysystem\Util;
use App\Image as ImageModel;
use Mockery\CountValidator\Exception;

//use App\File;

class FotoIndex extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'foto:index';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $files = File::allFiles( Config::get( 'images.source_path' ) );
        foreach ( $files as $file ) {
            $pathHash = md5( $file );
            $isIndexed = ImageModel::isIndexedFilePath( $file );

            if ( $isIndexed ) {
                echo "Skipping1: $file\n";
                continue;
            }

            if ( exif_imagetype( $file ) == 2 ) {
                try {
                    $exif = exif_read_data( $file );
                    ImageModel::create( [
                        'path'                 => dirname( $file ),
                        'path_hash'            => $pathHash,
                        'file_name'            => basename( $file ),
                        'file_hash'            => md5_file( $file ),
                        'exif_date_time'       => $exif['DateTime'],
                        'exif_width'           => $exif['COMPUTED']['Width'],
                        'exif_height'          => $exif['COMPUTED']['Height'],
                        'exif_camera_model'    => $exif['Model'],
                        'exif_iso'             => $exif['ISOSpeedRatings'],
                        'exif_focal_length_mm' => isset( $exif['FocalLengthIn35mmFilm'] ) ?: '-',
                        'exif_file_size'       => $exif['FileSize'],
                        'exif_file_date_time'  => $exif['FileDateTime'],
                        'exif_orientation'     => $exif['Orientation'],
                    ] );
                } catch ( \Exception $e ) {
                    echo $e->getMessage() . "\n";
                }
            }
            else{
                echo  "Skipping2: $file";
            }
        }

        echo "\ndone\n";
        //        $files = Storage::files('files_to_index');
        //        foreach ($files as $file){
        //            $filePath = Config::get('filesystems.disks.local.root').'/'.$file;
        //            //$image = Image::make(Util::normalizePath($filePath));
        //            //dd(array_keys($image->exif()));
        //
        //            $exif = exif_read_data($filePath);
        //            echo ($exif['DateTime']);
        //
        //
        //

        //        }
    }
}
