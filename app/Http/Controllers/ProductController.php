<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Html\Builder;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Builder $builder)
    {
        $product = $builder->columns([
            ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
            ['data' => 'stock', 'name' => 'stock', 'title' => 'Stock'],
            ['data' => 'price', 'name' => 'price', 'title' => 'Price'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Product Created'],
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
            ->ajax(route('product.data'));

        return view('product.index', compact('product'));
    }

    public function data()
    {
        $products = Product::all();

        return DataTables::of($products)
            ->editColumn('action', function ($products) {
                $product =  '<div><a href="product/edit/' . $products->id . '" class="btn btn-info">Edit</a>
                <a href="product/show/' . $products->id . '" class="btn btn-success"> View</a>';
                return $product;
            })
            ->editColumn('status', function ($products) {
               if($products->stock >= 5)
               {
                $product = 'In Stock';
                return $product;
               }elseif($products->stock <= 5 && $products->stock >= 1 )
               {
                $product = 'Low Stock';
                return $product;
               }elseif($products->stock == 0)
               {
                $product = 'No Stock';
                return $product;
               }
                
            })
            ->rawColumns(['action', 'status'])
            ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $product = new Product();
       $product->name = $request->name;
       $product->stock = $request->stock;
       $product->price = $request->price;
       $product->description = $request->description;

       $product->save();


        return redirect()->route('product.index')
            ->with('success', 'Product registered successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->all());

        return redirect()->route('product.index')
            ->with('success', 'Product updated successfully!');

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
