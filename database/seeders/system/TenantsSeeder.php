<?php

namespace Database\Seeders\System;

use App\Models\Tenant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TenantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenant = [
            ['name' => 'tenant1', 'domain' => 'domain1.com', 'database' => 'db1'],
            ['name' => 'tenant2', 'domain' => 'domain2.com', 'database' => 'db2'],
        ];

        Tenant::insert($tenant);
    }
}
