@extends('layoutsAdmin.master')

@section('content')

<div class="box box-primary">
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" action="{{ url('/kurir') }}" method="POST">
    {{csrf_field()}}
      <div class="box-body">
        
        <div class="form-group">
          <label for="exampleInputEmail1">Nama kurir</label>
          <input type="text" name="nama" class="form-control" id="exampleInputEmail1" value="{{ old('nama') }}">
        </div>

      </div>

      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        <span class="submitLoading" style="display: none;"><img src="{{ asset('loading.gif') }}"></span>
      </div>
    </form>

  </div>

@endsection

@section('scripts')

<script type="text/javascript">
	$(document).ready(function(){
		$("button[type='submit']").click(function(){
			$('.submitLoading').show();
		});
	});
</script>

@endsection