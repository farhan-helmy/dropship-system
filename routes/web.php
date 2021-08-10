<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\Main\DashboardController;
use App\Http\Controllers\Main\MainController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Events\InitializingTenancy;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;

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

Route::middleware(['web'])->group(function () {
    Route::get('/home', [MainController::class, 'index'])->name('index');
    Route::get('/register', [MainController::class, 'register'])->name('register');
    Route::post('/register', [MainController::class, 'store'])->name('register');
    Route::get('/login', [MainController::class, 'register'])->name('login');
    Route::post('/login', [MainController::class, 'login'])->name('login');
    Route::get('/verify', [MainController::class, 'register'])->name('verify');
    Route::get('/verify/{id}', [MainController::class, 'verify'])->name('verifyid');
    Route::get('/testmail', [MainController::class, 'testmail'])->name('testmail');

    Route::middleware(['auth'])->group(function () {
        
        Route::prefix('dashboard')->name('dashboard.')->group(function () {
            Route::get('', [DashboardController::class, 'index'])->name('index');
            Route::post('', [DashboardController::class, 'registeruser'])->name('registeruser');

            Route::get('getcsv', [DashboardController::class, 'generateCsv'])->name('getcsv');
        });
        Route::post('', [MainController::class, 'destroy'])->name('logout');
    });
});
