@extends('layoutsAdmin.master')

@section('content')

<div class="box box-primary">
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" method="POST" action="/kurir/{{ $kurir->id }}">
       @csrf
      @method("PUT")
      <div class="box-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Nama Kurir</label>
          <input type="text" name="nama" class="form-control" id="exampleInputEmail1" value="{{ $kurir->courier }}">
          @if ($errors->has('courier'))
                        <span class="help-block">
                            <strong style="color: red;">{{ $errors->first('courier') }}</strong>
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