<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;


Route::group([
    'middleware' => ['auth'],
    'prefix' => 'dashboard',
    // 'as' => 'dashboard.',
    // 'namespace' => 'App\Http\Controllers\Dashboard',
    ], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('/categories', CategoryController::class)->names([
            'index' => 'categories',
            'create' => 'categories.create',
        ]);
});

// Route::middleware('auth')->prefix('dashboard')->group(function () {
// });
