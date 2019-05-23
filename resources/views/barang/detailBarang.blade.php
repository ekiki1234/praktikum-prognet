@extends('layoutsAdmin.master')

@section('content')

<div class="box box-primary">
    <!-- /.box-header -->
    <!-- form start -->

    <div class="col-md-12 text-center">
    	<h1>{{ $barang->product_name }}</h1>
    </div>

    @for($i=1; $i<=sizeof($image); $i++)
    <div class="row text-center">
    	<div class="col-md-12">
            <img style="width: 200px;" src="{{ asset('image/'.$image[$i-1]->image_name) }}">
    	</div>
    </div>
    @endfor
    <div class="row text-center">
    	<div class="col-md-12">
    		{!! $barang->description !!}
    	</div>
    </div>

    <div class="row text-center">
    	<div class="col-md-4 col-md-offset-4">
    		<table class="table">
                <tr>
                    <th>Harga</th>
                    <td>:</td>
                    <td>Rp. {{ number_format($barang->price, 2) }}</td>
                </tr>
                <!-- <tr>
                    <th>Discount</th>
                    <td>:</td>
                    <td>{{ $barang->discount }}%</td>
                </tr>
                <tr>
                    <th>Harga Akhir</th>
                    <td>:</td>
                    <?php
                        if($barang->discount != 0)
                        {
                            $discount = ($barang->price * $barang->discount) / 100;
                            $harga = $barang->harga - $discount;
                        }
                        else
                        {
                            $harga = $barang->price;
                        }
                    ?>
                    <td>Rp. {{ number_format($harga, 2) }}</td>
                </tr> -->
            </table>
    	</div>
    </div>

  </div>

@endsection