@extends('layoutsUser.master')

@section('content')

<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active"> SHOPPING CART</li>
    </ul>
	<h3>  SHOPPING CART [ <small>{{ count(Cart::content()) }} Item(s) </small>]<a href="addToCart/destroy" class="btn btn-large pull-right"> Kosongkan Keranjang </a></h3>	
	<hr class="soft"/>
			
	<table class="table table-bordered">
              <thead>
                <tr>
                  <th>Description</th>
                  <th>Quantity/Update</th>
				  <th>Price</th>
                  <th>SubTotal</th>
				</tr>
              </thead>
              <tbody>
              	@foreach($barangs as $barang)
                <tr>
                  <td>{{ $barang->name }}</td>
				  <td>
					<div class="input-append"><input disabled="" class="span1" style="max-width:34px" placeholder="{{ $barang->qty }}" name="qty" id="appendedInputButtons" size="16" type="text"><button rowId="{{ $barang->rowId }}" class="btn kurangi-qty" type="button"><i class="icon-minus"></i></button>
						<a href="{{ $barang->rowId }}" class="btn add-qty"><i class="icon-plus"></i></a>				
					</div>
				  </td>
                  <td>Rp. {{ number_format($barang->price, 0) }}</td>
                  <td>Rp. {{ number_format($barang->subtotal, 0) }}</td>
                </tr>
                @endforeach
                <tr>
                	<th class="text-center" colspan="3">Total</th>
                	<td class="label label-important">{{ Cart::subtotal() }}</td>
                </tr>
				</tbody>
            </table>
			</table>

	<a href="{{ url('/') }}" class="btn btn-large"><i class="icon-arrow-left"></i> Continue Shopping </a>
	@if(count(Cart::content()) != 0)
	<a href="{{ url('shopping-cart/checkout') }}" class="btn btn-large pull-right">Checkout <i class="icon-arrow-right"></i></a>
	@endif
	
</div>

@endsection

@section('scripts')

<script type="text/javascript">
	$(document).ready(function(){
		$('.add-qty').click(function(e){
			e.preventDefault();
			var rowId = $(this).attr('href');
			window.location.href = "{{ url('shopping-cart/update') }}"+'/'+rowId;
		});

		$('.kurangi-qty').click(function(e){
			e.preventDefault();
			var rowId = $(this).attr('rowId');
			window.location.href = "{{ url('shopping-cart/kurangi') }}"+'/'+rowId;
		});
	});
</script>

@endsection

@section('scripts')

<script>
		$(document).ready(function(){
			var flash = "{{ Session::has('pesan') }}";
			if(flash){
				var pesan = "{{ Session::get('pesan') }}";
				swal('success', pesan, 'success');
			}
		});
	</script>

@endsection