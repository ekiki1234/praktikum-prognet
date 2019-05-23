<div class="well well-small"><a id="myCart" href="product_summary.html"><img src="{{asset('asset/user/bootshop/themes/images/ico-cart.png')}}" alt="cart">


</a></div>
<ul id="sideManu" class="nav nav-tabs nav-stacked">
	<?php
		$kategoris = \DB::table('product_categories')->orderBy('category_name', 'asc')->get();
	?>
@foreach($kategoris as $kategori)
	<?php
		$jumlah = \DB::table('product_category_details')->where('category_id', $kategori->id)->get();
	?>
	<li><a href="/kategori/{{$kategori->id}}">{{$kategori->category_name}} [{{count($jumlah)}}]</a></li>
@endforeach
</ul>
<br/>
<?php $barangs = \DB::table('products')->orderBy('id', 'desc')->limit(2)->get(); ?>
<?php $images = \DB::table('product_images')->orderBy('product_id', 'desc')->limit(2)->get(); ?>
<h5>Recently Added</h5>
@for($i=1; $i<=sizeof($barangs); $i++)
  <div class="thumbnail">
		<img style="width: 200px;" src="{{ asset('image/'.$images[$i-1]->image_name) }}">
	<div class="caption">
	  <h5>{{ $barangs[$i-1]->product_name }}</h5>
		<h4 style="text-align:center"><a class="btn"  href='/show/{{$barangs[$i-1]->id}}'> <i class="icon-zoom-in"></i></a> <a class="btn" href="{{ url('add-to-cart/') }}">Add to <i class="icon-shopping-cart"></i></a>
			<div>
				<a class="btn btn-primary" href="#">Rp. {{ number_format($barangs[$i-1]->price, 0) }}</a>
			</div>
		</h4>
	</div>
  </div>
 @endfor