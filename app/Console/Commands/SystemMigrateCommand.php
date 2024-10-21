<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SystemMigrateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'system:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("start migrating LandLord system");
        $this->info("-------------------------------------");

        // make migration command
        Artisan::call('migrate --path=database/migrations/system/ --database=system');

        $this->info(Artisan::output());
    }
}
