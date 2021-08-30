<?php

namespace App\Http\Controllers\Dropshipper;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Notifications\StockLow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Session::has('cart')) {
            return view('ds.cart.index');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        
        $data = [
            'products' => $cart->items,
            'totalQty' => $cart->totalQty
        ];

        $total = $cart->totalPrice;

        return view('ds.checkout.index', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice, 'data' => $data, 'total' => $total]);
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
        $request->validate([
            'receipt' => 'required',
            'name' => 'required',
            'phoneno' => 'required',
            'address1' => 'required',
            'postcode' => 'required',
            'bandar' => 'required',
            'negeri' => 'required',
        ]);
    
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        $data = [
            'products' => $cart->items,
            'totalQty' => $cart->totalQty
        ];

        $total = $cart->totalPrice;

        $order = Order::create($request->except('receipt'));
        $order->status = "Pending";
        $order->user_id = Auth::id();
        $order->save();

        $order
         ->addMediaFromRequest('receipt')
         ->toMediaCollection();

        //$all_prod = [];
        foreach($cart->items as $items)
        {
            $qty = $items['qty'];
            $price = $items['price'];
            $id = $items['item']['id'];
            $name = $items['item']['name'];
            //$user = User::where('id', 1)->first();

            $product = Product::where('id', $id)->first();

            if($product->stock < $qty)
            {
                return redirect()->route('ds.order.index')
            ->with('success', 'Fail purchase, no stock');
            }

            $new_value = $product->stock - $qty;
            $product->stock = $new_value;
            $product->save();

            //$user->notify(new StockLow($name));

            $order->products()->attach($id, ['total_price' => $price, 'quantity' => $qty]);
        }

        

        $request->session()->forget('cart');

        return redirect()->route('ds.order.index')
            ->with('success', 'Item has been purchased successfully!');
        //dd($all_prod);
        //dd($request->all());   
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
