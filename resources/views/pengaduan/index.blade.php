<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Pengaduan</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2 class="mb-4 text-center">Data Pengaduan Siswa</h2>

    <!-- Notifikasi -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tombol Tambah -->
    <div class="mb-3">
        <a href="/pengaduan/create" class="btn btn-primary">+ Tambah Pengaduan</a>
    </div>

    <!-- Tabel -->
    <table class="table table-bordered table-striped">
        <thead class="table-dark text-center">
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Kategori</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Bukti</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>

        @forelse($data as $index => $d)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>

                <td>{{ $d->user->nama ?? '-' }}</td>

                <td>{{ $d->kategori->nama_kategori ?? '-' }}</td>

                <td>{{ $d->judul }}</td>

                <td>{{ $d->deskripsi }}</td>

                <td class="text-center">
                    @if($d->bukti)
                        <a href="{{ asset('storage/'.$d->bukti) }}" target="_blank" class="btn btn-sm btn-info">Lihat</a>
                    @else
                        -
                    @endif
                </td>

                <td class="text-center">
                    @if($d->status == 'proses')
                        <span class="badge bg-warning text-dark">Proses</span>
                    @elseif($d->status == 'selesai')
                        <span class="badge bg-success">Selesai</span>
                    @else
                        <span class="badge bg-secondary">{{ $d->status }}</span>
                    @endif
                </td>

                <td class="text-center">
                    <a href="/pengaduan/{{ $d->id_pengaduan }}/edit" class="btn btn-sm btn-warning">Edit</a>

                    <form action="/pengaduan/{{ $d->id_pengaduan }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin hapus?')" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center">Belum ada data pengaduan</td>
            </tr>
        @endforelse

        </tbody>
    </table>

</div>

</body>
</html>