<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DropshipController;
use App\Http\Controllers\Dropshipper\CheckoutController as DropshipperCheckoutController;
use App\Http\Controllers\Dropshipper\DashboardController as DropshipperDashboardController;
use App\Http\Controllers\Dropshipper\OrderController as DropshipperOrderController;
use App\Http\Controllers\Dropshipper\ProductController as DropshipperProductController;
use App\Http\Controllers\Dropshipper\ShoppingCartController as DropshipperShoppingCartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/
Route::get('/', function () {
    return "gigachad";
});
Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', [AuthController::class, 'create'])->name('login');

    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::middleware(['auth'])->group(function () {

        Route::prefix('admin')->name('admin.')->group(function () {
            Route::prefix('dashboard')->name('dashboard.')->group(function () {
                Route::get('', [DashboardController::class, 'index'])->name('index');
            });

            Route::prefix('order')->name('order.')->group(function () {
                Route::get('', [OrderController::class, 'index'])->name('index');
                Route::get('data', [OrderController::class, 'data'])->name('data');
                Route::put('update/{order}', [OrderController::class, 'update'])->name('update');
                Route::get('show/{order}', [OrderController::class, 'show'])->name('show');
                Route::get('edit/{order}', [OrderController::class, 'edit'])->name('edit');
            });

            Route::prefix('dropshipper')->name('dropshipper.')->group(function () {
                Route::get('', [DropshipController::class, 'index'])->name('index');
                Route::get('data', [DropshipController::class, 'data'])->name('data');
                Route::get('dataorder', [DropshipController::class, 'dataorder'])->name('dataorder');
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
                Route::delete('delete/{product}', [ProductController::class, 'destroy'])->name('delete');
            });

            Route::prefix('sales')->name('sales.')->group(function () {
                Route::get('index', [SaleController::class, 'index'])->name('index');
            });
        });

        Route::prefix('dropshipper')->name('ds.')->group(function () {

            Route::prefix('dashboard')->name('dashboard.')->group(function () {
                Route::get('', [DropshipperDashboardController::class, 'index'])->name('index');
                Route::get('edit/{user}', [DropshipperDashboardController::class, 'edit'])->name('edit');
                Route::get('edit/{user}', [DropshipperDashboardController::class, 'edit'])->name('edit');
                Route::put('update/{user}', [DropshipperDashboardController::class, 'update'])->name('update');
            });

            Route::prefix('order')->name('order.')->group(function () {
                Route::get('', [DropshipperOrderController::class, 'index'])->name('index');
                Route::get('data', [DropshipperOrderController::class, 'data'])->name('data');
                Route::get('show/{order}', [DropshipperOrderController::class, 'show'])->name('show');
            });

            Route::prefix('product')->name('product.')->group(function () {
                Route::get('', [DropshipperProductController::class, 'index'])->name('index');
                Route::get('show/{product}', [DropshipperProductController::class, 'show'])->name('show');
                Route::get('add-to-cart/{product}', [DropshipperProductController::class, 'addToCart'])->name('addToCart');
            });

            Route::prefix('cart')->name('cart.')->group(function () {
                Route::get('', [DropshipperShoppingCartController::class, 'index'])->name('index');
                Route::get('reduce/{id}', [DropshipperShoppingCartController::class, 'reduceByOne'])->name('reduceByOne');
                Route::get('add-one/{product}', [DropshipperShoppingCartController::class, 'addToCart'])->name('addToCart');
                Route::get('remove-all/{id}', [DropshipperShoppingCartController::class, 'removeItem'])->name('removeItem');
            });

            Route::prefix('checkout')->name('checkout.')->group(function () {
                Route::get('', [DropshipperCheckoutController::class, 'index'])->name('index');
                Route::post('post', [DropshipperCheckoutController::class, 'store'])->name('store');
            });
        });

        Route::post('', [AuthController::class, 'destroy'])
            ->name('logout');
    });
});
