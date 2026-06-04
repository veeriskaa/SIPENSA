@extends('layouts.guru')

@section('title','Detail Laporan')

@section('content')

<div class="container-detail">

    <!-- HEADER -->
    <div class="detail-header-box">

        <div>
            <h4 class="header-title">
                Detail Laporan
            </h4>

            <p class="header-subtitle">
                Informasi lengkap laporan siswa dan tanggapan guru BK
            </p>
        </div>

        <span class="
            status-badge
            @if($pengaduan->status == 'pending') status-pending
            @elseif($pengaduan->status == 'proses') status-proses
            @else status-selesai
            @endif
        ">
            {{ ucfirst($pengaduan->status) }}
        </span>

    </div>

    <!-- MAIN GRID -->
    <div class="row g-4">

        <!-- LEFT -->
        <div class="col-lg-8">

            <div class="detail-card">

                <!-- TITLE -->
                <div class="mb-4">

                    <div class="kategori-badge mb-3">
                        {{ $pengaduan->kategori }}
                    </div>

                    <h2 class="laporan-title">
                        {{ $pengaduan->judul }}
                    </h2>

                </div>

                <!-- INFO -->
                <div class="row g-3 mb-4">

                    <div class="col-md-4">

                        <div class="info-box">

                            <small>Pelapor</small>

                            <h6>
                                {{ $pengaduan->user->name ?? '-' }}
                            </h6>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="info-box">

                            <small>Lokasi</small>

                            <h6>
                                {{ $pengaduan->lokasi }}
                            </h6>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="info-box">

                            <small>Tanggal</small>

                            <h6>
                                {{ \Carbon\Carbon::parse($pengaduan->created_at)->translatedFormat('d F Y') }}
                            </h6>

                        </div>

                    </div>

                </div>

                <!-- DESKRIPSI -->
                <div class="content-card">

                    <div class="section-title">
                        <i class="bi bi-file-text"></i>
                        Deskripsi Laporan
                    </div>

                    <p class="content-text">
                        {{ $pengaduan->deskripsi }}
                    </p>

                </div>

                <!-- BUKTI -->
                @if($pengaduan->bukti)

                <div class="content-card mt-4">

                    <div class="section-title">
                        <i class="bi bi-image"></i>
                        Bukti Pendukung
                    </div>

                    <img src="{{ asset('storage/' . $pengaduan->bukti) }}"
                         class="bukti-img">

                </div>

                @endif

            </div>

        </div>

        <!-- RIGHT -->
        <div class="col-lg-4">

            <!-- TANGGAPAN -->
            <div class="side-card">

                <div class="side-header">

                    <div class="icon-box">
                        <i class="bi bi-chat-left-dots"></i>
                    </div>

                    <div>
                        <h6 class="mb-1">
                            Tanggapan Guru BK
                        </h6>

                        <small>
                            Respon terbaru
                        </small>
                    </div>

                </div>

                @if($pengaduan->tanggapan)

                <div class="tanggapan-content">

                    {{ $pengaduan->tanggapan }}

                </div>

                @else

                <div class="empty-box">

                    <i class="bi bi-chat-square-text"></i>

                    <p>
                        Belum ada tanggapan
                    </p>

                </div>

                @endif

                <!-- BUTTON -->
                <div class="action-wrapper">

                    <a href="{{ route('laporan.edit', $pengaduan->id) }}"
                       class="btn-edit">

                        <i class="bi bi-pencil-square"></i>
                        Edit

                    </a>

                    <a href="{{ url()->previous() }}"
                       class="btn-kembali">

                        <i class="bi bi-arrow-left"></i>
                        Kembali

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

<style>

/* =========================================================
   FIX LAYOUT
========================================================= */

html,
body{
    height:100%;
    margin:0;
    overflow:hidden;
    background:#f5f7fa;
    font-family:'Inter',sans-serif;
    color:#1f2937;
}

/* CONTENT GLOBAL */
.content{
    height:calc(100vh - 70px);
    overflow:hidden;
}

/* =========================================================
   SCROLL AREA
========================================================= */

.container-detail{
    height:100%;
    overflow-y:auto;
    overflow-x:hidden;

    padding:2px 4px 25px 4px;

    scrollbar-width:thin;
}

/* =========================================================
   HEADER
========================================================= */

.detail-header-box{
    background:#fff;
    border:1px solid #e9edf2;
    border-radius:12px;
    padding:18px 22px;
    margin-bottom:18px;

    display:flex;
    justify-content:space-between;
    align-items:center;

    box-shadow:
    0 1px 2px rgba(15,23,42,.03),
    0 8px 20px rgba(15,23,42,.03);
}

.header-title{
    font-size:20px;
    font-weight:600;
    color:#111827;
    margin-bottom:2px;
}

.header-subtitle{
    font-size:12px;
    color:#9ca3af;
    margin:0;
}

/* =========================================================
   STATUS
========================================================= */

.status-badge{
    padding:7px 13px;
    border-radius:8px;
    font-size:11px;
    font-weight:500;
}

.status-pending{
    background:#fdf1f1;
    color:#c65b5b;
}

.status-proses{
    background:#fbf6eb;
    color:#c79b46;
}

.status-selesai{
    background:#edf5f1;
    color:#2f6f57;
}

/* =========================================================
   CARD
========================================================= */

.detail-card,
.side-card{
    background:#fff;
    border:1px solid #e9edf2;
    border-radius:12px;
    padding:22px;

    box-shadow:
    0 1px 2px rgba(15,23,42,.03),
    0 8px 20px rgba(15,23,42,.03);
}

/* =========================================================
   BADGE
========================================================= */

.kategori-badge{
    display:inline-flex;
    align-items:center;

    background:#edf5f1;
    color:#2f6f57;

    padding:5px 10px;
    border-radius:8px;

    font-size:11px;
    font-weight:500;
}

/* =========================================================
   TITLE
========================================================= */

.laporan-title{
    font-size:22px;
    font-weight:600;
    line-height:1.5;
    color:#111827;
}

/* =========================================================
   INFO
========================================================= */

.info-box{
    background:#fafbfc;
    border:1px solid #eef2f6;
    border-radius:10px;
    padding:16px;
}

.info-box small{
    font-size:11px;
    color:#9ca3af;
}

.info-box h6{
    margin-top:6px;
    margin-bottom:0;

    font-size:14px;
    font-weight:600;

    color:#1f2937;
}

/* =========================================================
   CONTENT
========================================================= */

.content-card{
    background:#fafbfc;
    border:1px solid #eef2f6;
    border-radius:10px;
    padding:18px;
}

.section-title{
    display:flex;
    align-items:center;
    gap:8px;

    font-size:14px;
    font-weight:600;

    color:#111827;
    margin-bottom:14px;
}

.content-text{
    font-size:13px;
    line-height:1.8;
    color:#4b5563;
    margin:0;
}

/* =========================================================
   IMAGE
========================================================= */

.bukti-img{
    width:100%;
    max-height:320px;

    object-fit:cover;

    border-radius:10px;
    border:1px solid #e5e7eb;
}

/* =========================================================
   SIDE HEADER
========================================================= */

.side-header{
    display:flex;
    align-items:center;
    gap:12px;

    margin-bottom:18px;
}

.icon-box{
    width:42px;
    height:42px;

    border-radius:10px;

    background:#edf5f1;
    color:#2f6f57;

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:18px;
}

.side-header h6{
    font-size:14px;
    font-weight:600;
    margin:0;
}

.side-header small{
    font-size:11px;
    color:#9ca3af;
}

/* =========================================================
   TANGGAPAN
========================================================= */

.tanggapan-content{
    background:#fafbfc;
    border:1px solid #e5e7eb;
    border-left:3px solid #2f6f57;

    border-radius:10px;

    padding:16px;

    color:#374151;
    line-height:1.8;
    font-size:13px;

    max-height:300px;
    overflow-y:auto;
}

/* =========================================================
   EMPTY
========================================================= */

.empty-box{
    text-align:center;

    padding:30px 18px;

    background:#fafafa;

    border-radius:10px;
    border:1px dashed #d1d5db;
}

.empty-box i{
    font-size:28px;
    color:#9ca3af;
}

.empty-box p{
    margin-top:10px;
    margin-bottom:0;

    font-size:13px;
    color:#6b7280;
}

/* =========================================================
   BUTTON
========================================================= */

.action-wrapper{
    display:flex;
    gap:10px;
    margin-top:20px;
    flex-wrap:wrap;
}

.btn-edit,
.btn-kembali{
    flex:1;
    text-decoration:none;
    border-radius:14px;
    padding:11px 18px;
    font-size:14px;
    font-weight:600;

    display:flex;
    align-items:center;
    justify-content:center;
    gap:8px;

    transition:.3s;
}

/* EDIT */
.btn-edit{
    background:white;
    border:1px solid #16a34a;
    color:#16a34a;
}

.btn-edit:hover{
    background:#16a34a;
    color:white;
}

/* KEMBALI */
.btn-kembali{
    background:#16a34a;
    color:white;
    border:1px solid #16a34a;
}

.btn-kembali:hover{
    background:#15803d;
    color:white;
}

/* =========================================================
   RESPONSIVE
========================================================= */

@media(max-width:768px){

    .content{
        height:auto;
        overflow:auto;
    }

    .container-detail{
        height:auto;
        overflow:visible;
        padding-bottom:30px;
    }

    .detail-header-box{
        flex-direction:column;
        align-items:flex-start;
        gap:12px;
    }

    .laporan-title{
        font-size:20px;
    }

    .detail-card,
    .side-card{
        padding:18px;
    }

    .action-wrapper{
        flex-direction:column;
    }

}

</style>

@endsection