<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DropshipController;
use App\Http\Controllers\Dropshipper\DashboardController as DropshipperDashboardController;
use App\Http\Controllers\Dropshipper\ProductController as DropshipperProductController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [AuthController::class, 'create'])->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware(['auth'])->group(function () {

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::prefix('dashboard')->name('dashboard.')->group(function () {
            Route::get('', [DashboardController::class, 'index'])->name('index');
        });

        Route::prefix('dropshipper')->name('dropshipper.')->group(function () {
            Route::get('', [DropshipController::class, 'index'])->name('index');
            Route::get('data', [DropshipController::class, 'data'])->name('data');
            Route::get('create', [DropshipController::class, 'create'])->name('create');
            Route::post('store', [DropshipController::class, 'store'])->name('store');
            Route::get('show/{user}', [DropshipController::class, 'show'])->name('show');
            Route::get('edit/{user}', [DropshipController::class, 'edit'])->name('edit');
            Route::put('update/{user}', [DropshipController::class, 'update'])->name('update');
            Route::get('deactivate/{user}', [DropshipController::class, 'deactivate'])->name('deactivate');
            Route::get('activate/{user}', [DropshipController::class, 'activate'])->name('activate');
        });

        Route::prefix('product')->name('product.')->group(function () {
            Route::get('', [ProductController::class, 'index'])->name('index');
            Route::get('data', [ProductController::class, 'data'])->name('data');
            Route::get('create', [ProductController::class, 'create'])->name('create');
            Route::post('store', [ProductController::class, 'store'])->name('store');
            Route::get('edit/{product}', [ProductController::class, 'edit'])->name('edit');
            Route::put('update/{product}', [ProductController::class, 'update'])->name('update');
            Route::get('show/{product}', [ProductController::class, 'show'])->name('show');
        });
    });

    Route::prefix('dropshipper')->name('ds.')->group(function () {

        Route::prefix('dashboard')->name('dashboard.')->group(function () {
            Route::get('', [DropshipperDashboardController::class, 'index'])->name('index');
        });

        Route::prefix('product')->name('product.')->group(function () {
            Route::get('', [DropshipperProductController::class, 'index'])->name('index');
            Route::get('add-to-cart/{product}', [DropshipperProductController::class, 'addToCart'])->name('addToCart');
        });
    });

    Route::post('', [AuthController::class, 'destroy'])
        ->name('logout');
});
