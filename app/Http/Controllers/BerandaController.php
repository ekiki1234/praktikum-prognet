<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use App\ProductImage;
use App\Carts;

class BerandaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $image = ProductImage::all();
        $barangs = Products::orderBy('id', 'asc')->where('status', 1)->get();
        return view('userHome', compact('barangs', 'image'));
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
        $detail_product=Products::select('products.id', 'product_name','product_rate','description','stock','price','image_name','product_category_details.category_id')
        	->join('product_images','products.id','=','product_images.product_id')
        	->join('product_category_details','products.id','=','product_category_details.product_id')
        	->groupBy('products.id')->where('products.id',$id)
        	->get()->first();
        $image = ProductImage::all();
        $images = ProductImage::where('product_id', $id)->get();
        $barangs = Products::orderBy('id', 'asc')->where('status', 1)->get();
        $barang = Products::find($id);
        return view('barang.detailBarangUser', compact('barangs', 'image', 'barang', 'images','detail_product'));
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
