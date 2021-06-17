<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index()
    {

        $month = ['01','02','03',];

        $product_name = [];
        $product_id = [];
        $product_all = Product::all();

        foreach($product_all as $product)
        {
            array_push($product_name, $product->name);
            array_push($product_id, $product->id);
        }

        $product = [];
        foreach ($product_id as $key => $value) {
            $product[] = ProductOrder::where('product_id', $value)->count();
        }

    	return view('sales.index')->with('product_name',json_encode($product_name))->with('product',json_encode($product,JSON_NUMERIC_CHECK));

    }
}
