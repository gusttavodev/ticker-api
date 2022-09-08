<?php

namespace App\Console;

use App\Jobs\GeneratePrize;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        // $schedule->job(new Heartbeat)->everyFiveMinutes();
        // $schedule->job(new GeneratePrize)->B(30);

        $schedule->call(function () {
            $time = time();
            GeneratePrize::dispatch();
            sleep(30 - (time() - $time));
            GeneratePrize::dispatch();
        })->everyMinute();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
