<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use Cart;
use App\Products;

class CartController extends Controller
{

    public function addToCart(Request $request, $id)
    {
        $barang = Products::find($id);
        Cart::add(['id'=>$barang->id, 'name'=>$barang->product_name, 'qty'=>1, 'price'=>$barang->price]);
    
        Session::flash('pesan', 'Barang berhasil di masukkan ke keranjang');
    
        // $request->session()->put('cart', $cart);
        // dd($request->session()->get('cart'));
        // dd(Cart::content());
        return redirect()->back();
    }

    public function update($rowId)
    {
    	$item = Cart::get($rowId);
    	Cart::update($rowId, ['qty'=>$item->qty + 1]);

    	return redirect()->back();
    }

    public function kurangi($rowId)
    {
    	$item = Cart::get($rowId);
    	Cart::update($rowId, ['qty'=>$item->qty - 1]);

    	return redirect()->back();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Shopping Cart';
    	$barangs = Cart::content();
    	// dd($barangs);

    	return view('cart.shoppingCart', compact('barangs'));
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
    public function show($id)
    {
        
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
    public function update1(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        Cart::destroy();

        Session::flash('pesan', 'Keranjang berhasil dikosongkan');

        return redirect('/');
    }
}
