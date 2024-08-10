<?php

namespace App\Console;

use App\Mail\DailyBackupDatabaseMail;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('disposable:update')->weekly();
        $schedule->command('activitylog:clean')->monthly();

        // $schedule->job(new DailyBackupDatabaseMail())
        //     ->dailyAt('00:00')
        //     ->timezone('Asia/Jakarta');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
