<?php

namespace App\Console\Commands\Tenants;

use App\Models\Tenant;
use App\Services\TenantService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SeederCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

     // {class} will be the argument that will pass to the command
     // dynamic class cause more than one seeder
    protected $signature = 'tenants:seed {class}';

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

        // get all tenant as collection
        $tenants = Tenant::get();

        // loop for all tenants in collection to switch config to it and run migrations
        $tenants->each(function ($tenant) use ($class) {

            // use TenantService to switch config to tenant
            TenantService::switchToTenant($tenant);

            $this->info("start seeding : {$tenant->domain}");
            $this->info("-------------------------------------");

            // make Seeder command
            Artisan::call('db:seed',[
                '--class' => "Database\\Seeders\\Tenants\\$class",
                '--database' => 'tenant'
            ] );

            $this->info(Artisan::output());
        });
    }
}
