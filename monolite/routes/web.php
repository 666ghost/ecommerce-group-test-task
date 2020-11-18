<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

function generateRoutes(\Illuminate\Database\Eloquent\Collection $routes)
{
    foreach ($routes as $route) {
        Route::prefix($route->uri)->group(function () use ($route) {
            Route::get('', function (\Illuminate\Http\Request $request) use ($route) {
                return (new \App\Http\Controllers\MainController())->show($route, $request);
            });
            if (count($route->child)) {
                generateRoutes($route->child);
            }
        });
    }
}

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$mainRoutes = Cache::remember('main_routes', now()->addHours(12), function () {
    return \App\Models\Route::query()->with('child')->where('parent_id', null)->get();
});

Route::prefix("role")->name("role.")->group(function () {
    Route::post("/set", [\App\Http\Controllers\MainController::class, 'setRole'])->name("set");
    Route::post("/update", [\App\Http\Controllers\MainController::class, 'updateRole'])->name("edit");
});


generateRoutes($mainRoutes);
