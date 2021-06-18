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

       // $month = ['01','02','03',];

        $ds_name = [];
        $ds_id = [];
        $ds_all = User::role('ds')->get();

        foreach($ds_all as $ds)
        {
            array_push($ds_name, $ds->name);
            array_push($ds_id, $ds->id);
        }

        $order = [];
        foreach ($ds_id as $key => $value) {
            $order[] = Order::where('user_id', $value)->count();
        }

    	return view('sales.index')->with('name',json_encode($ds_name))->with('order',json_encode($order,JSON_NUMERIC_CHECK));

    }
}
