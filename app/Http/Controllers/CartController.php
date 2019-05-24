<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use Cart;
use App\Carts;
use App\Products;

class CartController extends Controller
{

    public function addToCart(Request $request, $id)
    {
        $barang = Products::find($id);
        Cart::add(['id'=>$barang->id, 'name'=>$barang->product_name, 'qty'=>1, 'price'=>$barang->price]);
    
        Session::flash('pesan', 'Barang berhasil di masukkan ke keranjang');
        $inputToCart['user_id']=Auth::id();
        $cart = new Carts;
        $cart->user_id = $inputToCart["user_id"];
        $cart->product_id = $id;
        $cart->product_id = $request->qty;
        $cart->created_at = date('Y-m-d H:i:s');
        $cart->updated_at = date('Y-m-d H:i:s');
        $cart->status = 'notyet';

        return redirect()->back();
    }

    public function addToCarts(Request $request){
        
        $inputToCart=$request->all();
        Session::forget('discount_amount_price');
        Session::forget('coupon_code');
        // if($inputToCart['size']==""){
        //     return back()->with('message','Please select Size');
        // }else{
            $stockAvailable=$inputToCart['stock'];
            if($stockAvailable>=$inputToCart['quantity']){
                $inputToCart['user_id']=Auth::id();
                $count_duplicateItems=Cart::where('product_id',$inputToCart['product_id'])->where('user_id',$inputToCart['user_id'])->where('status','notyet')->count();
                if($count_duplicateItems>0){
                    return back()->with('message','This Item Added already');
                }else{
                    
                    
                    // return($cart);
                    return back()->with('success','Add To Cart Already');
                }
            }else{
                return back()->with('message','Stock is not Available!');
            }
        // }
    }

    public function checkout(Request $request)
    {

        $keranjang = Cart::content();
    	

        foreach ($keranjang as $carts) {
    		$inputToCart['user_id']=Auth::id();
            $cart = new Carts;
            $cart->user_id = $inputToCart["user_id"];
            $cart->product_id = $carts->id;
            $cart->qty = $carts->qty;
            $cart->status = 'notyet';
            $cart->save();
    	}
        
    	return view('cart.checkout');
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
        $inputToCart['user_id']=Auth::id();
        $cart = new Carts;
        $cart->user_id = $inputToCart["user_id"];
        $cart->product_id = $id;
        $cart->product_id = $request->qty;
        $cart->created_at = date('Y-m-d H:i:s');
        $cart->updated_at = date('Y-m-d H:i:s');
        $cart->status = 'notyet';
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
