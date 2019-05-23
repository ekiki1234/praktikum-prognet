@extends('layoutsAdmin.master')

@section('content')

<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover" id="example1">
              <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Deskripsi</th>
                    <th>Kategori</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr></thead>

                <tbody>

                @for ($i = 1; $i <= sizeof($barang); $i++)
                  <?php 
                      $warna = 'black';
                      $stock = $barang[$i-1]->stock;
                      if($stock == 0){
                        $warna = 'red';
                      }
                  ?>
                  <tr style="color: {{ $warna }}">
                    <td>{{ $i }}</td>
                    <td>{{ $barang[$i-1]->product_name }}</td>
                    <td>{{ $barang[$i-1]->price }}</td>
                    <td>{!! $barang[$i-1]->description !!}</td>
                    <td>@foreach($productsJoin as $category)
                          @if($category->product_id == $barang[$i-1]->id)
                            - {{ $category->category_name }}
                            <br>
                          @endif
                        @endforeach</td>
                    <td>{{ $barang[$i-1]->stock }}</td>
                    <td>{{ $barang[$i-1]->status }}</td>
                    <td>
                      <a href='/barang/{{$barang[$i-1]->id}}/edit'><i class="fa fa-fw fa-edit"></i></a>
                      <a href=""  class="hapusBarang" barang-id="{{ $barang[$i-1]->id }}"><i class="fa fa-fw fa-trash"></i></a>
                      <a href='/barang/{{$barang[$i-1]->id}}'><i class="fa fa-fw fa-search"></i></a>
                    </td>
                  </tr>
                @endfor

                
              </tbody>
            </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>

       <!-- /.modal -->

        <div class="modal modal-danger fade" id="modal-danger">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Confirm Delete</h4>
              </div>
              <div class="modal-body">
                <p>Yakin Ingin Menghapus Barang Ini?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <a href="" class="btn btn-outline confirmDelete">Ya, Hapus</a>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

@endsection

@section('scripts')

<script type="text/javascript" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script>
  $(document).ready(function(){
    var flash = "{{ Session::has('pesan') }}";
    if(flash){
      var pesan = "{{ Session::get('pesan') }}";
      swal('success', pesan, 'success');
    }

    // Ketika hapus barang
    $('body').on('click', '.hapusBarang', function(e){
      e.preventDefault();
      var id = $(this).attr('barang-id');
      var url = "{{ url('barang/delete') }}"+'/'+id;
      $('.confirmDelete').attr('href', url);
      
      $('#modal-danger').modal();
    });

  });
</script>

@endsection