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
        // edit & delete {category}
        Route::resource('/categories', CategoryController::class)->names([
            'index' => 'categories.index',
            'create' => 'categories.create',
        ]);
});