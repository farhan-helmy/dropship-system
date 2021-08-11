<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
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
            ['data' => 'image', 'name' => 'image', 'title' => 'Image'],
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
            ->parameters(['responsive' => true])
            ->ajax(route('admin.product.data'));

        $pending = Order::where('status', 'Pending')->count();

        return view('product.index', compact('product','pending'));
    }

    public function data()
    {
        $products = Product::all();

        return DataTables::of($products)
            ->editColumn('image', function ($products) {
                $media = $products->getFirstMediaUrl();
                $product =  '<div class="symbol symbol-90 symbol-light mt-1">
                <span class="symbol-label">
                    <img src="'.$media.'" class="h-75 align-self-end" alt="" />
                </span>
            </div>';
                return $product;
            })
            ->editColumn('action', function ($products) {
                $product =  '<div><a href="product/edit/' . $products->id . '" class="btn btn-info">Edit</a>
                <a href="product/show/' . $products->id . '" class="btn btn-success"> View</a>';
                return $product;
            })
            ->editColumn('status', function ($products) {
                if ($products->stock >= 5) {
                    $product = 'In Stock';
                    return $product;
                } elseif ($products->stock <= 5 && $products->stock >= 1) {
                    $product = 'Low Stock';
                    return $product;
                } elseif ($products->stock == 0) {
                    $product = 'No Stock';
                    return $product;
                }
            })
            ->rawColumns(['action', 'status','image'])
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
        $data = $request->validate([
            'name' => 'required|string',
            'stock' => 'required|integer|min:0',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $product = Product::create(
            collect($data)
                ->only(['name', 'stock', 'description', 'price'])
                ->toArray()
        );

        $product
            ->addMediaFromRequest('product_image')
            ->toMediaCollection();

        return redirect()
            ->route('admin.product.index')
            ->with('success', 'Product registered successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $pending = Order::where('status', 'Pending')->count();

        return view('product.show', compact('product', 'pending'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $pending = Order::where('status', 'Pending')->count();

        return view('product.edit', compact('product', 'pending'));
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
        if ($request->product_image == NULL)
        {
            $data = $request->validate([
                'name' => 'required|string',
                'stock' => 'required|integer|min:0',
                'description' => 'required|string',
                'price' => 'required|numeric|min:0',
                'product_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $product->update($data);

            $product
                ->addMediaFromRequest('product_image')
                ->toMediaCollection();

            return redirect()
                ->route('admin.product.index')
                ->with('success', 'Product updated successfully!');
        }

        else
        {
            $product->getFirstMedia()->delete();

            $data = $request->validate([
                'name' => 'required|string',
                'stock' => 'required|integer|min:0',
                'description' => 'required|string',
                'price' => 'required|numeric|min:0',
                'product_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $product->update($data);

            $product
                ->addMediaFromRequest('product_image')
                ->toMediaCollection();

            return redirect()->route('admin.product.index')
                ->with('success', 'Product updated successfully!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('admin.product.index')
            ->with('success', 'Product deleted successfully!');
    }
}
