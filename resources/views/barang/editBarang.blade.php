@extends('layoutsAdmin.master')

@section('content')

<div class="box box-primary">
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" method="POST" action="/barang/{{ $barang->id }}" enctype="multipart/form-data">
      @csrf
      @method("PUT")
      <div class="box-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Nama Barang</label>
          <input type="text" name="nama" value="{{ $barang->product_name }}" class="form-control" id="exampleInputEmail1">
          @if ($errors->has('nama'))
                        <span class="help-block">
                            <strong style="color: red;">{{ $errors->first('nama') }}</strong>
                        </span>
                    @endif
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">deskripsi</label>
          <textarea name="deskripsi" class="form-control" id="editor1" rows="10">{{ $barang->description }}</textarea>
          @if ($errors->has('keterangan'))
                        <span class="help-block">
                            <strong style="color: red;">{{ $errors->first('keterangan') }}</strong>
                        </span>
                    @endif
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Kategori</label>
          <div class="form-group">
                  <div class="checkbox">
                  @foreach($category as $cat)
                    <label>
                      <input type="checkbox" id="kategori_id" name="kategori_id[]" value="{{ $cat->id }}"
                      {{ count($categoryDetail->where('category_id', $cat->id)) ? 'checked' : '' }}>
                      {{ $cat->category_name }}
                    </label>
                  @endforeach
                  </div>
          	
          </select>
          @if ($errors->has('kategori_id'))
                        <span class="help-block">
                            <strong style="color: red;">{{ $errors->first('kategori_id') }}</strong>
                        </span>
                    @endif
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Harga Barang</label>
          <input type="number" name="harga" value="{{ $barang->price }}" class="form-control">
          @if ($errors->has('harga'))
                        <span class="help-block">
                            <strong style="color: red;">{{ $errors->first('harga') }}</strong>
                        </span>
                    @endif
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Stock</label>
          <input type="number" name="stock" value="{{ $barang->stock }}" class="form-control">
          @if ($errors->has('stock'))
                        <span class="help-block">
                            <strong style="color: red;">{{ $errors->first('stock') }}</strong>
                        </span>
                    @endif
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Discount</label>
          <input type="number" name="diskon" value="{{ $barang->discount }}" class="form-control">
          @if ($errors->has('diskon'))
                        <span class="help-block">
                            <strong style="color: red;">{{ $errors->first('diskon') }}</strong>
                        </span>
                    @endif
        </div>
      </div>
      <!-- /.box-body -->

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