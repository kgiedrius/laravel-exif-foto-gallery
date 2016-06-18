<?php

namespace App\Console;

use App\Console\Commands\FotoIndex;
use App\Console\Commands\FotoCheck;
use App\Console\Commands\FotoClear;
use App\Console\Commands\DeleteDuplicates;
use App\Console\Commands\FotoThumb;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        FotoIndex::class,
        FotoCheck::class,
        FotoClear::class,
        DeleteDuplicates::class,
        FotoThumb::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule( Schedule $schedule )
    {
        $schedule->command( 'foto:index' )->hourly()->withoutOverlapping();
        $schedule->command( 'foto:thumb' )->everyFiveMinutes()->withoutOverlapping();
    }
}
