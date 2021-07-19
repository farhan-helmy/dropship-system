<?php


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
Route::get('/', function () {
    return "gigachadmoment";
});