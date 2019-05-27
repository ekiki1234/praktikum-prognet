<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;
use App\Discounts;
use App\Couriers;
use App\User;
use App\Carts;
use Agungjk\Rajaongkir\RajaOngkirFacade as RajaOngkir;

class CheckOutController extends Controller
{

    public function checkshipping(Request $request){
        $client = new \GuzzleHttp\Client();
        try{
          $response = $client->get('https://api.rajaongkir.com/starter/city',
            array(
              'headers' => array(
                'key' => '975ef45d236f69facf11162db60688c8'
              )
            )
          );
        }catch(RequestException $e){
          var_dump($e->getResponse()->getBody()->getContent());
        }
        $json = $response->getBody()->getContents();
        $array_result = json_decode($json,true);
        $hai = $array_result["rajaongkir"]["results"];  
        $jum = count($hai);
        $countries=$hai;
        $postal= $request->kota;
        for ($i=0; $i < $jum ; $i++) { 
          if ($countries[$i]["postal_code"] == $postal) {
            $kota = $countries[$i]["city_name"];
            $province_id = $countries[$i]["province_id"];
          }
        }
        

        $client = new \GuzzleHttp\Client();
        try{
          $response = $client->get('https://api.rajaongkir.com/starter/province',
            array(
              'headers' => array(
                'key' => '975ef45d236f69facf11162db60688c8'
              )
            )
          );
        }catch(RequestException $e){
          var_dump($e->getResponse()->getBody()->getContent());
        }
        $json = $response->getBody()->getContents();
        $array_result = json_decode($json,true);
        $list_province = $array_result["rajaongkir"]["results"];
        
        $count_province = count($list_province);
        for ($i=0; $i <$count_province ; $i++) { 
          if ($list_province[$i]["province_id"]==$province_id) {
              $provinsi = $list_province[$i]["province"];
            }  
        }
        

        $cart_datas=Carts::select('carts.id','user_id','product_id','stock','qty','status','price','percentage')
            ->join('products','carts.product_id','=','products.id')
            ->leftjoin('discounts','products.id','=','discounts.id_product')
            ->where('user_id',Auth::id())
            ->where('status','notyet')
            ->groupBy('carts.id')
            ->get();
      $total_price=0;
        // return($cart_datas);
      foreach ($cart_datas as $cart_data){
          $diskon = Discounts::where('id_product',$cart_data->product_id)->where('start','<=',CARBON::NOW())->where('end','>=',CARBON::NOW())->get()->first();
          if (!empty($diskon)) {
              $cart_data->price = ((100-$diskon->percentage)*$cart_data->price/100);      
          }
          $total_price+=$cart_data->price*$cart_data->qty;
        }
        // return($total_price);

        $client = new \GuzzleHttp\Client();
        try{
          $response = $client->request('POST','https://api.rajaongkir.com/starter/cost',
            [
              'body' => "origin=80227&destination=".$request->kota."&weight=1000&courier=".$request->kurir,
              // 'body' => "origin=Denpasar&destination=Cirebon".$request->tujuan."&weight=1000&courier=".$request->courier,
              'headers' => [
                
                'key' => '975ef45d236f69facf11162db60688c8',
                'content-type' => 'application/x-www-form-urlencoded',
              ]
            ]
          );
        }catch(RequestException $e){
          var_dump($e->getResponse()->getBody()->getContent());
        }
        $json = $response->getBody()->getContents();
        $array_result = json_decode($json,true);
        $service = ($array_result["rajaongkir"]["results"]["0"]["costs"]);

        $user_login=User::where('id',Auth::id())->first();
        $courier=couriers::get();
        $nama = $request->nama;
        $kurir=$request->kurir;
        $alamat = $request->alamat;
        $telpon = $request->telpon;
        // return($service);
        return view("checkout.index",compact("service",'countries','user_login','courier','kurir','total_price','kota','provinsi','alamat','nama','telpon'));

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = new \GuzzleHttp\Client();
        try{
          $response = $client->get('https://api.rajaongkir.com/starter/city',
            array(
              'headers' => array(
                'key' => '975ef45d236f69facf11162db60688c8',
              )
            )
          );
        }catch(RequestException $e){
          var_dump($e->getResponse()->getBody()->getContent());
        }
  
        $session_id=Session::get('session_id');
        $json = $response->getBody()->getContents();
        $array_result = json_decode($json,true);
        $hai = $array_result["rajaongkir"]["results"];  
        $jum = count($hai);
        $countries=$hai;
        $user_login=User::where('id',Auth::id())->first();
        $courier=couriers::get();
  
        // return($countries);
  
        $cart_datas=Carts::select('carts.id','user_id','product_id','stock','qty','status','price','percentage')
              ->join('products','carts.product_id','=','products.id')
              ->leftjoin('discounts','products.id','=','discounts.id_product')
              ->where('user_id',Auth::id())
              ->where('status','notyet')
              ->groupBy('carts.id')
              ->get();
        $total_price=0;
          // return($cart_datas);
        foreach ($cart_datas as $cart_data){
            $diskon = Discounts::where('id_product',$cart_data->product_id)->where('start','<=',CARBON::NOW())->where('end','>=',CARBON::NOW())->get()->first();
            if (!empty($diskon)) {
                $cart_data->price = ((100-$diskon->percentage)*$cart_data->price/100);      
            }
            $total_price+=$cart_data->price*$cart_data->qty;
          }
  
        return view('checkout.index',compact('countries','user_login','courier','total_price'));
      
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
