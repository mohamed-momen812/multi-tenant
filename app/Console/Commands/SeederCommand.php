<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class SeederCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'system:seed {class}';

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
        // Get the value of a command argument.
        $class = $this->argument('class');

        // make Seeder command
        Artisan::call('db:seed',[
            '--class' => "Database\\Seeders\\System\\$class",
            '--database' => 'system'
        ] );

        $this->info(Artisan::output());
}
}
