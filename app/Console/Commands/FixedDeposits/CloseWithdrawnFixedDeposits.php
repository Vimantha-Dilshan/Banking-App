<?php

namespace App\Console\Commands\FixedDeposits;

use App\Models\FixedDeposit;
use Illuminate\Console\Command;

class CloseWithdrawnFixedDeposits extends Command
{
    protected $signature = 'app:close-withdrawn-fixed-deposits';

    protected $description = 'Command description';

    public function handle()
    {
        $fixedDeposits = FixedDeposit::where('status', FixedDeposit::STATUS_WITHDRAWN)
            ->where('closed', false)
            ->get();

        if ($fixedDeposits->isEmpty()) {
            $this->info('No non-closed withdrawn fixed deposits found.');

            return;
        }

        $count = 0;

        foreach ($fixedDeposits as $deposit) {
            $deposit->status = FixedDeposit::STATUS_CLOSED;
            $deposit->closed = true;
            $deposit->save();

            $count++;
        }

        $this->info('Successfully closed '.$count.' withdrawn fixed deposits.');
    }
}
