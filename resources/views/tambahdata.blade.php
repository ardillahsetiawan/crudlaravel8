@extends('layout.admin')

@section('content')
<body>
  <br><br>
  <h1 class="text-center mb-4 mt-5">Tambah Data Pegawai</h1>

  <div class="container mb-5">
      <div class="row justify-content-center">
        <div class="col-8">
          <a href="/pegawai" class="btn btn-success mb-3">Kembali</a>
          <div class="card">
            <div class="card-body">
              <form action="/insertdata" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Nama Lengkap</label>
                  <input type="text" name="nama" class="form-control" id="nama" value="{{ old('nama') }}" required>
                  @error('nama')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Tanggal Lahir</label>
                  <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                  @error('tanggal_lahir')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Jenis Kelamin</label>
                <select class="form-select" name="jeniskelamin" value="{{ old('jeniskelamin') }}" required>
                  <option selected>-Pilih Jenis Kelamin-</option>
                  <option value="Laki-Laki">Laki-Laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Agama</label>
                  <select class="form-select" name="id_religions" value="{{ old('id_religions') }}" required>
                    <option selected>-Pilih Agama-</option>
                    @foreach ($dataagama as $data)
                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                    @endforeach
                  </select>
                  </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">No. Telpon</label>
                  <input type="number" name="notelpon" class="form-control" id="notelpon" value="{{ old('notelpon') }}" required>
                  @error('notelpon')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Foto</label>
                  <input type="file" name="foto" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
  </div>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  -->
</body>
@endsection