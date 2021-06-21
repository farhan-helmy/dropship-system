<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use DataTables;

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
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Order Submitted'],
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
            ->ajax(route('admin.order.data'));

        $pending = Order::where('status', 'Pending')->count();
       
        return view('order.index', compact('order', 'pending'));
    }

    public function data()
    {
        $orders = Order::orderBy('created_at','desc');

        return DataTables::of($orders)
            ->editColumn('action', function ($orders) {
                $order =  '<a href="order/show/' . $orders->id . '" class="btn btn-info">View</a>';
                return $order;
            })
            ->rawColumns(['action'])
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
        $total_up = [];

        foreach($order->products as $product)
        {

         array_push($total_up, $product->pivot->total_price);

        }

        $go = array_sum($total_up);

        $pending = Order::where('status', 'Pending')->count();

        return view('order.show', compact('order', 'go', 'pending'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view('order.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {   
        $order->tracking_num = $request->tracking_num;
        $order->status = "Approved";
        $order->save();

        return redirect()->route('admin.order.index')
            ->with('success', 'Order approved!');
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
