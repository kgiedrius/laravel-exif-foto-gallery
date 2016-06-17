<?php

namespace App\Console\Commands;

use App\Image;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DeleteDuplicates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'foto:deleteduplicates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Find and delete duplicates';

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
        $duplicateList = DB::select( 'select * from images group by file_hash having count(*) > 1 limit 1' );
        //   echo count($duplicateList);
        foreach ( $duplicateList as $record ) {
            $file = $record->path . '/' . $record->file_name . "\n";

            echo $file . "\n";

            Image::destroy($record->id);
            exec('rm "'.$file.'" ');
            //unlink( '"'.$file.'"' );
        }
        //   DB::Select()

        /* $files = File::allFiles( Config::get( 'images.source_path' ) );
         $extensions = [ ];
         foreach ( $files as $file ) {
             $extension = strtolower(pathinfo( $file, PATHINFO_EXTENSION ));
             @$extensions[ $extension ] += 1;
             if ($extension != 'jpg')
                 echo $file."\n";
         }
        */
        // print_R($extensions);
    }
}
