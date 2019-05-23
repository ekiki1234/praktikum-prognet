@extends('layoutsAdmin.master')

@section('content')

<div class="box box-primary">
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" method="POST" action="{{ url('/barang') }}" enctype="multipart/form-data">
    	{{csrf_field()}}
      <div class="box-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Nama Barang</label>
          <input type="text" name="nama" value="{{ old('nama') }}" class="form-control" id="exampleInputEmail1">
          @if ($errors->has('nama'))
                        <span class="help-block">
                            <strong style="color: red;">{{ $errors->first('nama') }}</strong>
                        </span>
                    @endif
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">deskripsi</label>
          <textarea name="deskripsi" class="form-control" id="editor1" rows="10">{{ old('keterangan') }}</textarea>
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
                      <input type="checkbox" id="kategori_id" name="kategori_id[]" value="{{ $cat->id }}">
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
          <input type="number" name="harga" value="{{ old('harga') }}" class="form-control">
          @if ($errors->has('harga'))
                        <span class="help-block">
                            <strong style="color: red;">{{ $errors->first('harga') }}</strong>
                        </span>
                    @endif
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Stock</label>
          <input type="number" name="stock" value="{{ old('stock') }}" class="form-control">
          @if ($errors->has('stock'))
                        <span class="help-block">
                            <strong style="color: red;">{{ $errors->first('stock') }}</strong>
                        </span>
                    @endif
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Discount</label>
          <input type="number" name="diskon" value="{{ old('diskon') }}" class="form-control">
          @if ($errors->has('diskon'))
                        <span class="help-block">
                            <strong style="color: red;">{{ $errors->first('diskon') }}</strong>
                        </span>
                    @endif
        </div>

        <div class="form-group">
          <label for="exampleInputFile">File input</label>
          <input type="file" name="image[]" id="image" onchange="readURL(this);">
          <img id="blah" src="#" />

          <p class="help-block">Example block-level help text here.</p>
          @if ($errors->has('photo'))
                <span class="help-block">
                    <strong style="color: red;">{{ $errors->first('photo') }}</strong>
                </span>
            @endif
        </div>
      </div>
      <!-- /.box-body -->

      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Tambah</button>
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

<script type="text/javascript">
				function readURL(input) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();

					reader.onload = function (e) {
						$('#blah')
							.attr('src', e.target.result)
							.width(150)
							.height(150);
					};

					reader.readAsDataURL(input.files[0]);
				}
			}

			</script>

@endsection