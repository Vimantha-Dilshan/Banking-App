<?php

namespace App\Console;

use App\Console\Commands\FixedDeposits\CloseWithdrawnFixedDeposits;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        CloseWithdrawnFixedDeposits::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('app:close-withdrawn-fixed-deposits')->daily();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
