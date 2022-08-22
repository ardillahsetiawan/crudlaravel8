@extends('layout.admin')
@push('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Data Pegawai</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Data Pegawai</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <div class="container">
    <a href="/tambahpegawai" class="btn btn-success mb-3 mt-2">Tambah Data</a>
    <div class="row g-3 align-items-center">
      <div class="col-auto">
        <form action="/pegawai" action="GET">
        <input type="search" id="inputPassword6" name="search" class="form-control" aria-describedby="passwordHelpInline">
        </form>
      </div>
      <div class="col-auto">
        <a href="/exportpdf" class="btn btn-primary">PDF</a>
        <a href="/exportexcel" class="btn btn-primary">Excel</a>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
          Import Excel
        </button>
      </div>
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Import Data Excel</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/importexcel" method="POST" enctype="multipart/form-data">
              @csrf
            <div class="modal-body">
              <div class="form-group">
                <input type="file" name="file" required>
              </div>
            </div>
            
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </form>
        </div>
      </div>
  
    </div>
    <div class="row">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Foto</th>
                <th scope="col">Tanggal Lahir</th>
                <th scope="col">Agama</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">No Telpon</th>
                <th scope="col">Dibuat</th>
                <th scope="col">Aksi</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($data as $index => $row)
                <tr>
                    <th scope="row">{{ $index + $data->firstItem() }}</th>
                    <td>{{ $row->nama }}</td>
                    <td>
                      <img src="{{ asset('fotopegawai/'.$row->foto) }}" alt="" style="width: 100px">
                    </td>
                    <td>{{ $row->tanggal_lahir->format('d M Y')}}</td>
                    <td>{{ $row->religions->nama }}</td>
                    <td>{{ $row->jeniskelamin }}</td>
                    <td>{{ $row->notelpon }}</td>
                    <td>{{ $row->created_at->format('d M Y')}}</td>
                    <td>
                        <a href="/tampildata/{{ $row->id }}" class="btn btn-primary">Edit</a>
                        <a href="#" class="btn btn-danger delete" data-id="{{ $row->id }}">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
          {{ $data->links() }}
    </div>
  </div>
</div>

 

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
-->
</body>

<script>

$('.delete').click(function(){
  var pegawaiid = $(this).attr('data-id');
        swal({
    title: "Apakah anda yakin?",
    text: "Ketika dihapus file tidak akan kembali!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      window.location = "/delete/"+pegawaiid+""
      swal("Data telah dihapus!", {
        icon: "success",
      });
    }
  });
});
  
</script>

<script>
@if (Session::has('success'))
toastr.success("{{ Session::get('success') }}")
@endif
</script>
@endpush