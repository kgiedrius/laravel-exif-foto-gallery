<?php

namespace App\Console\Commands;

use App\Image;
use Illuminate\Console\Command;

class FotoClear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'foto:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear fotos index from storage';

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
        Image::truncate();
    }
}
