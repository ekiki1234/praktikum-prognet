@extends('layoutsUser.master2')

@section('content')
    <style type="text/css">
        #shipping{
            color: black;
        }
    </style>
    <div class="container">
        <div class="step-one">
            <h2 class="heading">Shipping To</h2>
        </div>
        <div class="row">
            <form action="{{url('/cod')}}" method="get" class="form-horizontal">
                
                <div class="col-sm-12">
                    <div class="table-responsive" id="shipping">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Kota</th>
                                <th>Provinsi</th>
                                <th>Telpon</th>
                                <th>Ongkos Kirim</th>
                                <th>Sub Harga</th>
                                <th>Harga Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{$data['nama']}}</td>
                                <td>{{$data['alamat']}}</td>
                                <td>{{$data['kota']}}</td>
                                <td>{{$data['provinsi']}}</td>
                                <td>{{$data['telpon']}}</td>
                                <td>{{$data['service']}}</td>
                                <td>Rp {{ Cart::subtotal() }}</td>
                                <td>Rp {{ Cart::subtotal() }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                   
                        <div class="payment-options">
                            <button type="submit" class="btn btn-primary" style="float: right;">Order Now</button>
                        </div>

                    @foreach($data as $data)
                        <input type="hidden" name="data[]" value="{{$data}}">
                    @endforeach

                </div>
            </form>
        </div>
    </div>
    <div style="margin-bottom: 20px;"></div>
@endsection