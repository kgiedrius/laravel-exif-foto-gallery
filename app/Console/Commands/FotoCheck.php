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

class FotoCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'foto:check';

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
        $extensions = [ ];
        foreach ( $files as $file ) {
            $extension = strtolower(pathinfo( $file, PATHINFO_EXTENSION ));
            @$extensions[ $extension ] += 1;
            if ($extension != 'jpg')
                echo $file."\n";
        }
        print_R($extensions);
    }
}
