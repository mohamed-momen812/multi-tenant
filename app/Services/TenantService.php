<?php

namespace App\Services;

use App\Models\Tenant;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TenantService
{

    private static $tenant;
    private static $domain;
    private static $database;


    public static function switchToTenant(Tenant $tenant)
    {
        if(!$tenant instanceof Tenant){
            throw ValidationException::withMessages(['field_name' => 'This value is incorrect']);
        }

        // Purge and reconnect to the new database
        DB::purge('system'); // Clears the current from system connection
        DB::purge('tenant'); // Clears the current from tenant connection
        Config::set('database.connections.tenant.database', $tenant->database); // Set new database dynamically
        DB::reconnect('tenant'); // Reconnect to the tenant database with new settings
        DB::setDefaultConnection('tenant'); // need to set tenant to be a defualt connection

        // self::$tenant = $tenant;
        // self::$domain = $tenant->domain;
        // self::$database = $tenant->database;
    }

    public static function switchToDefault()
    {
        DB::purge('system');
        DB::purge('tenant');
        DB::reconnect('system');
        DB::setDefaultConnection('system');
    }
}
