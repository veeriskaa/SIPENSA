<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Analisis</title>

    <style>

        body{
            font-family: sans-serif;
            color:#111827;
        }

        h2{
            margin-bottom:5px;
        }

        p{
            color:#6b7280;
            margin-top:0;
        }

        .card{
            border:1px solid #e5e7eb;
            padding:14px;
            border-radius:10px;
            margin-bottom:14px;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:10px;
        }

        table th,
        table td{
            border:1px solid #d1d5db;
            padding:10px;
            font-size:13px;
        }

        table th{
            background:#f3f4f6;
        }

    </style>

</head>
<body>

    <h2>Dashboard Analisis Pengaduan</h2>

    <p>Laporan statistik pengaduan siswa</p>

    <div class="card">
        <strong>Total Laporan:</strong>
        {{ $totalLaporan }}
    </div>

    <div class="card">
        <strong>Selesai:</strong>
        {{ $selesai }}
    </div>

    <div class="card">
        <strong>Diproses:</strong>
        {{ $diproses }}
    </div>

    <div class="card">
        <strong>Pending:</strong>
        {{ $pending }}
    </div>

    <div class="card">
        <strong>Kategori Terbanyak:</strong>
        {{ $kategoriTerbanyak->nama_kategori ?? '-' }}
    </div>

    <h3>Laporan Terbaru</h3>

    <table>

        <thead>
            <tr>
                <th>Judul</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>

        <tbody>

            @foreach($laporanTerbaru as $item)

                <tr>

                    <td>{{ $item->judul }}</td>

                    <td>{{ $item->status }}</td>

                    <td>{{ $item->created_at }}</td>

                </tr>

            @endforeach

        </tbody>

    </table>

</body>
</html>