<?php

use App\Http\Controllers\HomePageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

// Route::get('/', function (Request $request) {

//     // // Map domains to respective database names
//     // $array = [
//     //     'domain1.com' => 'DB1',
//     //     'domain2.com' => 'DB2'
//     // ];

//     // // Get the current request's domain (host)
//     // $host = $request->getHost();

//     // // Check if the domain is mapped to a database
//     // if (array_key_exists($host, $array)) {
//     //     $db = $array[$host]; // Get the database name for the domain

//     //     // Purge and reconnect to the new database
//     //     DB::purge('mysql'); // Clears the current connection
//     //     Config::set('database.connections.mysql.database', $db); // Set new database dynamically
//     //     DB::reconnect('mysql'); // Reconnect to the database with new settings
//     // }

//     // Render the welcome view
//     return view('welcome');
// });


Route::get('/', [HomePageController::class, 'index']);
