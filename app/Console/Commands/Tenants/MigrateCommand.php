<?php

namespace App\Console\Commands\Tenants;

use App\Models\Tenant;
use App\Services\TenantService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class MigrateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenants:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'loop of all tenants and run migration to in its db';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // get all tenant as collection
        $tenants = Tenant::get();

        // loop for all tenants in collection to switch config to it and run migrations
        $tenants->each(function ($tenant) {

            // use TenantService to switch config to tenant
            TenantService::switchToTenant($tenant);

            $this->info("start migrating : {$tenant->domain}");
            $this->info("-------------------------------------");

            // make migration command
            Artisan::call('migrate --path=database/migrations/tenants/ --database=tenant');

            $this->info(Artisan::output());
        });
    }
}
