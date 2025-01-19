<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RefreshDatabaseCommand extends Command
{
    protected $signature = 'db:refresh';

    protected $description = 'Refresh the database';

    public function handle(): void
    {
        $this->call('migrate:refresh', [
            '--seed' => true,
            '--force' => true,
        ]);
    }
}
