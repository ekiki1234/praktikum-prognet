@extends('layoutsUser.master')

@section('content')

<ul class="thumbnails">

<div class="row">
	
	@for($i=1; $i<=sizeof($barangs); $i++)
	<li class="span3">
	  <div class="thumbnail">
			<img style="width: 200px;" src="{{ asset('image/'.$image[$i-1]->image_name) }}">
		<div class="caption">
		  <h5>{{ $barangs[$i-1]->product_name }}</h5>
		 
		  <h4 style="text-align:center"><a class="btn" href='/show/{{$barangs[$i-1]->id}}' > <i class="icon-zoom-in"></i></a> <a class="btn" href="/addToCart/{{$barangs[$i-1]->id}}">Add to <i class="icon-shopping-cart"></i></a>
		  	<div>
		  		<a class="btn btn-primary" href="#">Rp. {{ number_format($barangs[$i-1]->price, 0) }}</a>
		  	</div>
		  </h4>
		</div>
	  </div>
	</li>
	<br>
	@endfor
	
</div>

</ul>


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