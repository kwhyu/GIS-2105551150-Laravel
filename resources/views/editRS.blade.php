<!-- resources/views/edit.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Rumah Sakit</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <div class="container">
        <h1>Edit Data Rumah Sakit</h1>
        <form method="POST" action="{{ route('data.update', ['id_rs' => $data->id_rs]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
              <label for="nama_rs" class="form-label">Nama Rumah Sakit</label>
              <input type="text" class="form-control" id="nama_rs" name="nama_rs" value="{{ old('nama_rs', $data->nama_rs) }}">
            </div>

            <div class="mb-3">
              <label for="latlng_rs" class="form-label">Latitude,Longitude</label>
              <input type="text" class="form-control" id="latlng_rs" name="latlng_rs" value="{{ old('latlng_rs', $data->latlng_rs) }}">
            </div>

            <div class="mb-3">
              <label for="tipe_rs" class="form-label">Tipe Rumah Sakit</label>
              <input type="text" class="form-control" id="tipe_rs" name="tipe_rs" value="{{ old('tipe_rs', $data->tipe_rs) }}">
            </div>

            <div class="mb-3">
              <label for="alamat_rs" class="form-label">Alamat Rumah Sakit</label>
              <input type="text" class="form-control" id="alamat_rs" name="alamat_rs" value="{{ old('alamat_rs', $data->alamat_rs) }}">
            </div>

            <div class="mb-3">
              <label for="gambar_rs" class="form-label">Gambar Rumah Sakit</label>
              <input type="file" class="form-control" id="gambar_rs" name="gambar_rs" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary btn-sm" title="Update Data">Simpan Perubahan</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
