<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CR extends Command
{
    protected $signature = 'cr';

    protected $description = 'Cache views and routes for the application';

    public function handle()
    {
        $this->call('view:cache');

        $this->call('route:cache');

        $this->info('Views and routes have been cached successfully.');

        return 0;
    }
}