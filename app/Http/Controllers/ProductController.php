<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Stringable;
use Yajra\DataTables\Html\Builder;
use App\Traits\UploadTrait;


class ProductController extends Controller
{
    use UploadTrait;
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
            ->ajax(route('admin.product.data'));

        return view('product.index', compact('product'));
    }

    public function data()
    {
        $products = Product::all();

        return DataTables::of($products)
            ->editColumn('image', function ($products) {
                $product =  '<div class="symbol symbol-90 symbol-light mt-1">
                <span class="symbol-label">
                    <img src="'.$products->image.'" class="h-75 align-self-end" alt="" />
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

        $request->validate([
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $product = new Product();
        $product->name = $request->name;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->description = $request->description;

        if ($request->has('product_image')) {
            // Get image file
            $image = $request->file('product_image');
            //dd($image);
            // Make a image name based on user name and current timestamp
            $name = Str::slug($request->name) . '_' . time();
            // Define folder path
            $folder = '/uploads/images/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath
            $product->product_image = $filePath;
        }

        $product->save();

        return redirect()->route('admin.product.index')
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
        return view('product.show', compact('product'));
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
        $request->validate([
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $product->name = $request->name;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->description = $request->description;

        if ($request->has('product_image')) {
            // Get image file
            $image = $request->file('product_image');
            //dd($image);
            // Make a image name based on user name and current timestamp
            $name = Str::slug($request->name) . '_' . time();
            // Define folder path
            $folder = '/uploads/images/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath
            $product->product_image = $filePath;
        }

        $product->save();


        return redirect()->route('admin.product.index')
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
