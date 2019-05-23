@extends('layoutsAdmin.master')

@section('content')

<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-header">
              <a href="{{ url('kategori/create') }}" class="btn btn-info">Tambah Kategori</a>
            </div>
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover" id="example1">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Action</th>
                  </tr></thead>
                <tbody>
                @for ($i = 1; $i <= sizeof($kategori); $i++)
                <tr>
                  <td>{{ $i }}</td>
                  <td>{{ $kategori[$i-1]->category_name }}</td>
                  <td>
                    <a href='/kategori/{{$kategori[$i-1]->id}}/edit'><i class="fa fa-fw fa-edit"></i></a>
                    <a href="" class="hapusBarang" kategori-id="{{ $kategori[$i-1]->id }}"><i class="fa fa-fw fa-trash"></i></a>
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
                <p>Yakin Ingin Menghapus Kategori Ini? Menghapus kategori sama dengan menghapus semua barang yang memiliki kategori ini..</p>
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
      var barang_id = $(this).attr('kategori-id');
      var url = "{{ url('kategori/delete') }}"+'/'+id;
      $('.confirmDelete').attr('href', url);
      
      $('#modal-danger').modal();
    });

  });
</script>

@endsection