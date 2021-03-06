<?php

namespace App\Console\Commands;

use App\Image;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FotoThumb1 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'foto:thumb1';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Thumbs';

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
        $thumbPath = Config::get( 'images.thumb_path' );
        $sizes = [ '300x200', '1200x1200' ];

        $photoList = DB::select( 'select * from images where id % 2 = 1 order by id asc' );
        $cnt = 0;
        $totalCount = Image::count();
        foreach ( $photoList as $record ) {
            foreach ( $sizes as $size ) {
                $destinationFile = $record->file_hash . ".$size" . '.jpg';
                $destinationDir = $thumbPath . '/' . substr( $record->file_hash, 0, 2 ) . '/';

                if ( !file_exists( $destinationDir ) ) {
                    mkdir( $destinationDir, 0777, true );
                }
                $destination = $destinationDir . $destinationFile;
                $cnt++;

                if ( !file_exists( $destination ) ) {
                    echo round( ( $cnt / $totalCount ) * 100, 3 ) . '%: ' . $destination . "\n";
                    $destination = '"' . $destination . '"';
                    $source = '"' . $record->path . '/' . $record->file_name . '"';
                    if ( $size == '300x200' ) {
                        exec( "convert $source -resize $size^ -gravity center -crop $size+0+0 +repage $destination " );
                    }
                    if ( $size == '1200x1200' ) {
                        exec( "convert $source -resize $size  $destination " );
                    }
                }
            }
        }
    }
}
