<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use App\ProductCategories;
use App\CategoryDetail;
use App\ProductImage;
use DB;
use Carbon\Carbon;
use File;

class BarangController extends Controller
{
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productsJoin = DB::table('product_category_details')
        ->join('products','product_category_details.product_id','=','products.id')
        ->join('product_categories','product_category_details.category_id','=','product_categories.id')
        ->get();
        $barang = Products::get();
        return view('barang.indexBarang', compact('barang','productsJoin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = ProductCategories::get();
        return view('barang.addBarang', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
            'kategori_id' => 'required',
            'image' => 'required',
            'stock' => 'required',
            'diskon' => 'required',
        ]);

        $barang = new Products;
        $barang->product_name = $request->nama;
        $barang->price = $request->harga;
        $barang->description = $request->deskripsi;
        $barang->product_rate = 0;
        $barang->created_at = date('Y-m-d H:i:s');
        $barang->updated_at = date('Y-m-d H:i:s');
        $barang->stock = $request->stock;
        $barang->discount = $request->diskon;
        $barang->status = 1;
        $barang->save();

        $get_id_product = Products::select('id')
        ->orderBy('id','DESC')
        ->first();
        foreach($request->kategori_id as $category){
            $category_details = new CategoryDetail;
            $category_details->product_id = $get_id_product->id;
            $category_details->category_id = $category;
            $category_details->created_at = date('Y-m-d H:i:s');
            $category_details->updated_at = date('Y-m-d H:i:s');
            $category_details->save();
        }

        if($request->hasfile('image'))
        {
            $current_timestamp = Carbon::now()->timestamp;
            $i = 1;
            foreach($request->file('image') as $file)
            {
                
                    $name=$file->getClientOriginalName();
                    $path = $name;
                    if(File::exists($path)) {
                        $name = $current_timestamp.$file->getClientOriginalName();
                        $path = $name;
                    }
                    
                    $file->move(public_path().'/image', $name);

                    $image = new ProductImage;
                    $image->product_id = $get_id_product->id;
                    $image->image_name=$path;
                    $image->save();
                $i++;    
            }
            
        }


        $productsJoin = DB::table('product_category_details')
        ->join('products','product_category_details.product_id','=','products.id')
        ->join('product_categories','product_category_details.category_id','=','product_categories.id')
        ->get();
        $barang = Products::get();
        return view('barang.indexBarang', compact('barang','productsJoin'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $barang = Products::find($id);
        $image = ProductImage::where('product_id', $id)->get();
        return view('barang.detailBarang', compact('barang','image'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $barang = Products::find($id);
        $productsJoin = DB::table('product_category_details')
        ->join('products','product_category_details.product_id','=','products.id')
        ->join('product_categories','product_category_details.category_id','=','product_categories.id')
        ->get();
        $category = ProductCategories::get();
        $categoryDetail = CategoryDetail::where('product_category_details.product_id',$id)->get();
        return view('barang.editBarang', compact('barang','productsJoin','categoryDetail', 'category'));
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

        $this->validate($request, [
            'nama' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
            'kategori_id' => 'required',
            'photo' => 'required',
            'stock' => 'required',
            'diskon' => 'required',
        ]);


        $barang = Products::find($id);
        $barang->product_name = $request->nama;
        $barang->price = $request->harga;
        $barang->description = $request->deskripsi;
        $barang->product_rate = 0;
        $barang->created_at = date('Y-m-d H:i:s');
        $barang->updated_at = date('Y-m-d H:i:s');
        $barang->stock = $request->stock;
        $barang->discount = $request->diskon;
        $barang->status = 1;
        $barang->save();

        
        foreach($request->kategori_id as $category){
            $category_details = CategoryDetail::where('product_id',$id);
            $category_details->delete();
        }

        foreach($request->kategori_id as $category){
            $category_details = new CategoryDetail;
            $category_details->product_id = $id;
            $category_details->category_id = $category;
            $category_details->created_at = date('Y-m-d H:i:s');
            $category_details->updated_at = date('Y-m-d H:i:s');
            $category_details->save();
        }

        $productsJoin = DB::table('product_category_details')
        ->join('products','product_category_details.product_id','=','products.id')
        ->join('product_categories','product_category_details.category_id','=','product_categories.id')
        ->get();
        $barang = Products::get();
        return view('barang.indexBarang', compact('barang','productsJoin'));


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products = Products::find($id);
        $products->status = 0;
        $products->save();

        $productsJoin = DB::table('product_category_details')
        ->join('products','product_category_details.product_id','=','products.id')
        ->join('product_categories','product_category_details.category_id','=','product_categories.id')
        ->get();
        $barang = Products::get();
        return view('barang.indexBarang', compact('barang','productsJoin'));
    }
}
