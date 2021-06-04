<?php

namespace App\Http\Controllers\Dropshipper;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use DataTables;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Builder $builder)
    {
        $order = $builder->columns([
            ['data' => 'id', 'name' => 'id', 'title' => 'Order ID'],
            ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Date submitted'],
            [
                'defaultContent' => '',
                'data'           => 'action',
                'name'           => 'action',
                'title'          => 'Action',
                'render'         => null,
                'orderable'      => false,
                'searchable'     => false,
                'exportable'     => false,
                'printable'      => true,
                'footer'         => '',
            ]
        ])
            ->ajax(route('ds.order.data'));

        return view('ds.order.index', compact('order'));
    }

    public function data()
    {
        $orders = Order::where('user_id', Auth::id());

        return DataTables::of($orders)
        ->editColumn('id', function ($orders) {
            $html =  '#'. $orders->id;
            return $html;
        })
        ->editColumn('action', function ($orders) {
            $order =  '<a href="order/show/' . $orders->id . '" class="btn btn-success"> View</a>';
            return $order;
        })
        ->rawColumns(['action','id'])
        ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {

        $testis = [];

        foreach($order->products as $product)
        {

         array_push($testis, $product->pivot->total_price);

        }

        $go = array_sum($testis);
        
        return view('ds.order.show', compact('order', 'go'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
