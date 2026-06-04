<!DOCTYPE html>
<html>
<head>
    <title>Edit Pengaduan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Edit Pengaduan</h2>

    <form action="/pengaduan/{{ $data->id_pengaduan }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" value="{{ $data->judul }}">
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <select name="id_kategori" class="form-control">
                @foreach($kategori as $k)
                    <option value="{{ $k->id_kategori }}" 
                        {{ $data->id_kategori == $k->id_kategori ? 'selected' : '' }}>
                        {{ $k->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control">{{ $data->deskripsi }}</textarea>
        </div>

        <button class="btn btn-success">Update</button>
        <a href="/pengaduan" class="btn btn-secondary">Kembali</a>
    </form>
</div>

</body>
</html>