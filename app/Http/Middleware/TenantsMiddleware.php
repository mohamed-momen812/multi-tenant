<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use App\Services\TenantService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class TenantsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the current request's domain (host)
        $host = $request->getHost();

        // Get the current request's tenant
        $tenant = Tenant::where('domain', $host)->firstOrFail();

        // use class method for switching logic
        TenantService::switchToTenant($tenant);

        // // Purge and reconnect to the new database
        // DB::purge('system'); // Clears the current connection
        // Config::set('database.connections.tenant.database', $tenant->database); // Set new database dynamically
        // DB::reconnect('tenant'); // Reconnect to the tenant database with new settings
        // DB::setDefaultConnection('tenant'); // need to set tenant to be a defualt connection

        return $next($request);
    }
}
