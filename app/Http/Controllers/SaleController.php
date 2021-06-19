<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index()
    {
       
        $month = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
        $test = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $order = [];
        foreach ($month as $key => $value) {
            $order[] = ProductOrder::whereMonth('created_at', $value)->sum('total_price');
        }

        // $order[] = Order::whereMonth('created_at', $value)->get()->each(function ($order) {
        //     $order->products->sum('pivot.total_price');
        // });
        $pending = Order::where('status', 'Pending')->count();

        return view('sales.index', compact('pending'))->with('month', json_encode($test))->with('order', json_encode($order, JSON_NUMERIC_CHECK));
    }
}
