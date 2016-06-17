<?php

namespace App\Console\Commands;

use App\Image;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class FotoThumb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'foto:thumb';

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
        $size = '300x200';

        $photoList = DB::select( 'select * from images order by id asc limit 5' );
        $cnt = 0;
        $totalCount = Image::count();
        foreach ( $photoList as $record ) {
            $destinationFile = $record->file_hash . ".$size" . '.jpg';
            $destinationDir = $thumbPath . '/' . substr( $record->file_hash, 0, 2 ).'/';
            mkdir($destinationDir,0777,true);
            $destination = $destinationDir . $destinationFile;
            $cnt++;

            echo round( ( $cnt / $totalCount ) * 100, 3 ) . '%: ' . $destination . "\n";
            $destination = '"' . $destination . '"';
            $source = '"' . $record->path . '/' . $record->file_name . '"';

            exec( "convert $source -resize 300x200^ -gravity center -crop 300x200+0+0 +repage $destination " );
        }
    }
}
