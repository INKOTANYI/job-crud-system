<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestSchedule extends Command
{
    protected $signature = 'test:schedule';
    protected $description = 'Test the scheduler';

    public function handle()
    {
        $this->info('Scheduler is working!');
        \Log::info('TestSchedule command ran at ' . now());
    }
}
