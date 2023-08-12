<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    @if (session()->has('success'))
    <div class="alert alert-success col-lg-8" role="alert">
      {{ session('success') }}
    </div>
    @endif
    <form action="/" method="post">
        @csrf
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="nama">
          </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nickname</label>
            <input type="text" class="form-control" id="nickname" name="nickname" placeholder="nickname">
          </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nomor Telephone</label>
            <input type="number" class="form-control" id="no_tlpn" name="no_tlpn" placeholder="no_tlpn">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
          </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Tanggal Mulai Kerja</label>
            <input type="date" class="form-control" id="tgl_mulai_kerja" name="tgl_mulai_kerja" placeholder="tgl_mulai_kerja">
        </div>
        <div class="mb-3">
            <select name="branch_company_id" class="form-select" aria-label="Default select example">
                <option >Branch</option>
                <option value="1">Malang</option>
                <option value="2">Pasuruan</option>
              </select>
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Divisi</label>
            <select class="form-select" name="divisi_id">
                <option selected>---Pilih---</option>
                @foreach ($divisi as $c)
                    @if (old('divisi_id') == $c->id)
                        <option value="{{ $c->id }}">{{ $c->nama_divisi }}</option>
                    @else
                        <option value="{{ $c->id }}">{{ $c->nama_divisi }}</option>
                    @endif
                @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Jabatan</label>
            <select class="form-select" name="jabatan_id">
                <option selected>---Pilih---</option>
                @foreach ($jobTitle as $c)
                    @if (old('jabatan_id') == $c->id)
                        <option value="{{ $c->id }}">{{ $c->nama_jabatan }}</option>
                    @else
                        <option value="{{ $c->id }}">{{ $c->nama_jabatan }}</option>
                    @endif
                @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Status Level</label>
            <select class="form-select" name="status_level_id">
                <option selected>---Pilih---</option>
                @foreach ($statusLevel as $c)
                    @if (old('status_level_id') == $c->id)
                        <option value="{{ $c->id }}">{{ $c->nama_level }}</option>
                    @else
                        <option value="{{ $c->id }}">{{ $c->nama_level }}</option>
                    @endif
                @endforeach
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
