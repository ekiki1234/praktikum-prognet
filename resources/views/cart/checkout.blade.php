@extends('layoutsUser.master')

@section('content')

<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active">Registration</li>
    </ul>
	<h3> Checkout</h3>	
	<div class="well">
	<!--
	<div class="alert alert-info fade in">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<strong>Lorem Ipsum is simply dummy</strong> text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
	 </div>
	<div class="alert fade in">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<strong>Lorem Ipsum is simply dummy</strong> text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
	 </div>
	 <div class="alert alert-block alert-error fade in">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<strong>Lorem Ipsum is simply</strong> dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
	 </div> -->
	<form class="form-horizontal" action="{{ url('shopping-cart/bayar') }}" method="POST">
		{{ csrf_field() }}

		<div class="control-group">
			<label class="control-label" for="inputFname">Nama Penerima <sup>*</sup></label>
			<div class="controls">
			  <input type="text" name="nama_penerima" id="inputFname" placeholder="Nama Penerima">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="aditionalInfo">Alamat Lengkap</label>
			<div class="controls">
			  <textarea name="alamat" id="aditionalInfo" cols="26" rows="5"></textarea>
			</div>
		</div>
	
	<div class="control-group">
			<div class="controls">
				<input type="hidden" name="email_create" value="1">
				<input type="hidden" name="is_new_customer" value="1">
				<input class="btn btn-large btn-success" type="submit" value="Bayar">
			</div>
		</div>		
	</form>
</div>

</div>

@endsection