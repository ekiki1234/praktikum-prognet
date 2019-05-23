@extends('layoutsAdmin.master')

@section('content')

<div class="box box-primary">
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" method="POST" action="{{ url('kategori/update/'.$kategori->kategori_id) }}">
    	{{csrf_field()}}
      <div class="box-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Nama Kategori</label>
          <input type="text" name="nama" class="form-control" id="exampleInputEmail1" value="{{ $kategori->category_name }}">
          @if ($errors->has('category_name'))
                        <span class="help-block">
                            <strong style="color: red;">{{ $errors->first('category_name') }}</strong>
                        </span>
                    @endif
        </div>

      </div>
      <!-- /.box-body -->

      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Edit</button>
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