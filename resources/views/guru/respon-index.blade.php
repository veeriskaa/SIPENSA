@extends('layouts.guru')

@section('title','Respon Saya')

@section('content')

<div class="respon-page">

    <!-- HEADER -->
    <div class="respon-header-box">

        <div>
            <h4 class="header-title mb-1">
                Respon Saya
            </h4>

            <p class="header-subtitle mb-0">
                Daftar laporan siswa yang telah mendapatkan tanggapan dari Guru BK
            </p>
        </div>

        <div class="header-icon">
            <i class="bi bi-chat-dots-fill"></i>
        </div>

    </div>

    <!-- LIST -->
    <div class="respon-scroll">

        <div class="row g-3">

            @forelse($laporan as $item)

            <div class="col-xl-4 col-lg-6 col-md-6">

                <div class="respon-card">

                    <!-- TOP -->
                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <span class="kategori-badge">
                            {{ $item->kategori }}
                        </span>

                        <span class="
                            status-badge
                            @if($item->status == 'pending') status-pending
                            @elseif($item->status == 'proses') status-proses
                            @else status-selesai
                            @endif
                        ">
                            {{ ucfirst($item->status) }}
                        </span>

                    </div>

                    <!-- JUDUL -->
                    <h5 class="judul-laporan">
                        {{ $item->judul }}
                    </h5>

                    <!-- DESKRIPSI -->
                    <p class="deskripsi-laporan">
                        {{ $item->deskripsi }}
                    </p>

                    <!-- TANGGAPAN -->
                    <div class="tanggapan-box">

                        <div class="d-flex align-items-center gap-2 mb-2">

                            <i class="bi bi-chat-left-text"></i>

                            <span>
                                Tanggapan Guru BK
                            </span>

                        </div>

                        <p>
                            {{ $item->tanggapan }}
                        </p>

                    </div>

                    <!-- FOOTER -->
                    <div class="card-footer-custom">

                        <div class="guru-info">
                            <i class="bi bi-person-circle"></i>
                            Guru BK
                        </div>

                        <div class="d-flex gap-2">

                            <!-- EDIT -->
                            <a href="{{ route('laporan.edit', $item->id) }}"
                               class="btn-edit">

                                <i class="bi bi-pencil-square"></i>

                            </a>

                            <!-- DETAIL -->
                            <a href="/pengaduan/{{ $item->id }}"
                               class="btn-detail">

                                <i class="bi bi-eye-fill"></i>
                                Detail

                            </a>

                        </div>

                    </div>

                </div>

            </div>

            @empty

            <div class="col-12">

                <div class="empty-box">

                    <i class="bi bi-chat-square-text"></i>

                    <h5>
                        Belum Ada Respon
                    </h5>

                    <p>
                        Tanggapan dari Guru BK akan muncul di halaman ini
                    </p>

                </div>

            </div>

            @endforelse

        </div>

    </div>

</div>

<style>

/* =========================================================
   GLOBAL FIX
========================================================= */

html,
body{
    height:100%;
    overflow:hidden;
    background:#f5f7fa;
}

/* CONTENT LAYOUT */
.content{
    height:calc(100vh - 70px);
    overflow:hidden;
}

/* =========================================================
   PAGE
========================================================= */

.respon-page{
    height:calc(100vh - 95px);

    display:flex;
    flex-direction:column;

    overflow:hidden;
}

/* =========================================================
   HEADER
========================================================= */

.respon-header-box{
    background:white;

    border-radius:16px;

    padding:18px 22px;

    display:flex;
    justify-content:space-between;
    align-items:center;

    border:1px solid #e9edf2;

    box-shadow:
    0 1px 2px rgba(15,23,42,.03),
    0 8px 20px rgba(15,23,42,.03);

    flex-shrink:0;

    position:sticky;
    top:0;

    z-index:20;
}

.header-title{
    font-size:22px;
    font-weight:600;
    color:#111827;
}

.header-subtitle{
    color:#6b7280;
    font-size:13px;
}

.header-icon{
    width:50px;
    height:50px;

    border-radius:14px;

    background:#edf5f1;

    display:flex;
    align-items:center;
    justify-content:center;

    color:#2f6f57;
    font-size:20px;
}

/* =========================================================
   SCROLL AREA
========================================================= */

.respon-scroll{
    flex:1;

    overflow-y:auto;
    overflow-x:hidden;

    padding-top:4px;
    padding-right:4px;
    padding-bottom:20px;

    margin-top:2px;
}

/* SCROLLBAR */
.respon-scroll::-webkit-scrollbar{
    width:7px;
}

.respon-scroll::-webkit-scrollbar-thumb{
    background:#d1d5db;
    border-radius:20px;
}

/* =========================================================
   CARD
========================================================= */

.respon-card{
    background:white;

    border-radius:16px;

    padding:16px;

    border:1px solid #edf0f2;

    box-shadow:
    0 1px 2px rgba(15,23,42,.03),
    0 8px 20px rgba(15,23,42,.03);

    transition:0.25s;

    position:relative;

    overflow:hidden;

    display:flex;
    flex-direction:column;

    min-height:260px;
}

.respon-card::before{
    content:'';

    position:absolute;

    top:0;
    left:0;

    width:100%;
    height:4px;

    background:#16a34a;
}

.respon-card:hover{
    transform:translateY(-2px);

    box-shadow:
    0 8px 24px rgba(15,23,42,.08);
}

/* =========================================================
   BADGE
========================================================= */

.kategori-badge{
    background:#e8f7ee;
    color:#198754;

    padding:6px 12px;

    border-radius:30px;

    font-size:11px;
    font-weight:600;
}

.status-badge{
    padding:6px 12px;

    border-radius:30px;

    font-size:11px;
    font-weight:600;
}

.status-pending{
    background:#fde8e8;
    color:#dc2626;
}

.status-proses{
    background:#fef3c7;
    color:#b45309;
}

.status-selesai{
    background:#dcfce7;
    color:#15803d;
}

/* =========================================================
   TEXT
========================================================= */

.judul-laporan{
    font-size:16px;
    font-weight:600;
    color:#111827;

    line-height:1.5;

    margin-bottom:8px;

    min-height:48px;
}

.deskripsi-laporan{
    color:#6b7280;

    font-size:13px;

    line-height:1.7;

    height:44px;

    overflow:hidden;

    margin-bottom:14px;
}

/* =========================================================
   TANGGAPAN
========================================================= */

.tanggapan-box{
    background:#f8fafc;

    border:1px solid #edf2f7;

    border-radius:14px;

    padding:12px;

    margin-bottom:16px;
}

.tanggapan-box span{
    color:#15803d;

    font-weight:600;

    font-size:13px;
}

.tanggapan-box i{
    color:#16a34a;
}

.tanggapan-box p{
    margin:0;

    color:#4b5563;

    font-size:13px;

    line-height:1.7;

    max-height:44px;

    overflow:hidden;
}

/* =========================================================
   FOOTER
========================================================= */

.card-footer-custom{
    display:flex;
    justify-content:space-between;
    align-items:center;

    margin-top:auto;
}

.guru-info{
    color:#6b7280;

    font-size:12px;

    display:flex;
    align-items:center;

    gap:6px;
}

/* =========================================================
   BUTTON
========================================================= */

.btn-detail,
.btn-edit{
    text-decoration:none;

    display:flex;
    align-items:center;
    justify-content:center;

    transition:.25s;
}

.btn-detail{
    background:#16a34a;
    color:white;

    padding:8px 14px;

    border-radius:10px;

    font-size:12px;
    font-weight:500;

    gap:6px;
}

.btn-detail:hover{
    background:#15803d;
    color:white;
}

.btn-edit{
    width:36px;
    height:36px;

    border-radius:10px;

    background:#eef2ff;
    color:#4f46e5;

    font-size:14px;
}

.btn-edit:hover{
    background:#e0e7ff;
    color:#4338ca;
}

/* =========================================================
   EMPTY
========================================================= */

.empty-box{
    background:white;

    border-radius:18px;

    padding:60px 24px;

    text-align:center;

    border:1px dashed #d1d5db;
}

.empty-box i{
    font-size:50px;
    color:#9ca3af;
}

.empty-box h5{
    margin-top:14px;

    font-size:18px;
    font-weight:600;

    color:#374151;
}

.empty-box p{
    color:#6b7280;

    margin-top:6px;

    font-size:13px;
}

/* =========================================================
   RESPONSIVE
========================================================= */

@media(max-width:768px){

    html,
    body{
        overflow:auto;
    }

    .content{
        height:auto;
        overflow:visible;
    }

    .respon-page{
        height:auto;
    }

    .respon-header-box{
        flex-direction:column;
        align-items:flex-start;
        gap:14px;
    }

    .header-title{
        font-size:20px;
    }

    .header-icon{
        width:48px;
        height:48px;
        font-size:18px;
    }

    .respon-scroll{
        overflow:visible;
        padding-bottom:30px;
    }

}

</style>

@endsection