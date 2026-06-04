@extends('layouts.siswa')

@section('title','Panduan Konseling')

@section('content')

<div class="panduan-page">

    <!-- FIX HEADER -->
    <div class="panduan-header">

        <div>
            <h3 class="header-title">
                Panduan Konseling
            </h3>

            <p class="header-subtitle">
                Informasi dan panduan penggunaan layanan pengaduan siswa
            </p>
        </div>

        <div class="header-icon">
            <i class="bi bi-book-half"></i>
        </div>

    </div>

    <!-- CONTENT -->
    <div class="panduan-container">

        <div class="row g-4">

            <!-- CARA MEMBUAT LAPORAN -->
            <div class="col-md-6">

                <div class="panduan-card">

                    <div class="card-icon green">
                        <i class="bi bi-pencil-square"></i>
                    </div>

                    <h5>
                        Cara Membuat Laporan
                    </h5>

                    <ul>
                        <li>Pilih menu <b>Buat Laporan</b></li>
                        <li>Pilih kategori masalah</li>
                        <li>Isi judul dan deskripsi laporan</li>
                        <li>Tambahkan lokasi dan waktu kejadian</li>
                        <li>Upload bukti pendukung jika ada</li>
                        <li>Klik tombol <b>Kirim Laporan</b></li>
                    </ul>

                </div>

            </div>

            <!-- JENIS LAPORAN -->
            <div class="col-md-6">

                <div class="panduan-card">

                    <div class="card-icon blue">
                        <i class="bi bi-folder-check"></i>
                    </div>

                    <h5>
                        Jenis Laporan
                    </h5>

                    <ul>
                        <li>Bullying atau perundungan</li>
                        <li>Masalah akademik</li>
                        <li>Kerusakan fasilitas sekolah</li>
                        <li>Permasalahan sosial siswa</li>
                        <li>Konseling pribadi</li>
                        <li>Laporan lainnya terkait sekolah</li>
                    </ul>

                </div>

            </div>

            <!-- PROSES -->
            <div class="col-md-6">

                <div class="panduan-card">

                    <div class="card-icon orange">
                        <i class="bi bi-arrow-repeat"></i>
                    </div>

                    <h5>
                        Proses Penanganan Laporan
                    </h5>

                    <div class="timeline-box">

                        <div class="timeline-item">
                            <span class="timeline-dot pending"></span>

                            <div>
                                <b>Pending</b>

                                <p>
                                    Laporan berhasil dikirim dan menunggu pemeriksaan.
                                </p>
                            </div>

                        </div>

                        <div class="timeline-item">
                            <span class="timeline-dot proses"></span>

                            <div>
                                <b>Proses</b>

                                <p>
                                    Guru BK sedang menindaklanjuti laporan.
                                </p>
                            </div>

                        </div>

                        <div class="timeline-item">
                            <span class="timeline-dot selesai"></span>

                            <div>
                                <b>Selesai</b>

                                <p>
                                    Laporan telah selesai ditangani.
                                </p>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PRIVASI -->
            <div class="col-md-6">

                <div class="panduan-card">

                    <div class="card-icon red">
                        <i class="bi bi-shield-lock"></i>
                    </div>

                    <h5>
                        Privasi dan Keamanan
                    </h5>

                    <p class="desc">
                        Semua laporan siswa akan dijaga kerahasiaannya dan hanya dapat diakses oleh pihak terkait seperti Guru BK atau administrator sekolah.
                    </p>

                    <div class="privacy-box">

                        <i class="bi bi-check-circle-fill"></i>

                        Data laporan aman dan tidak dibagikan ke pihak luar.

                    </div>

                </div>

            </div>

            <!-- KONTAK -->
            <div class="col-12">

                <div class="contact-card">

                    <div class="contact-left">

                        <div class="contact-icon">
                            <i class="bi bi-chat-dots"></i>
                        </div>

                        <div>

                            <h5>
                                Butuh Bantuan?
                            </h5>

                            <p>
                                Hubungi Guru BK apabila mengalami kendala saat menggunakan sistem.
                                081352655551
                            </p>

                        </div>

                    </div>

                    <a href="/chatbot" class="btn-chatbot">

                        <i class="bi bi-robot"></i>

                        Buka Chatbot

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

<style>

/* =========================================================
   PAGE
========================================================= */

.panduan-page{
    width:100%;
    min-height:100%;
}

/* =========================================================
   BODY
========================================================= */

body{
    background:#f4f6f9;
    overflow-x:hidden;
}

/* =========================================================
   FIX HEADER
========================================================= */

.panduan-header{
    position:sticky;
    top:0;

    z-index:50;

    background:rgba(255,255,255,0.96);

    backdrop-filter:blur(12px);
    -webkit-backdrop-filter:blur(12px);

    border-radius:18px;

    padding:24px;

    display:flex;
    justify-content:space-between;
    align-items:center;

    margin-bottom:24px;

    border:1px solid #eceff3;

    box-shadow:
    0 2px 10px rgba(15,23,42,0.04);
}

/* =========================================================
   HEADER TEXT
========================================================= */

.header-title{
    font-size:22px;
    font-weight:600;
    color:#111827;
    margin-bottom:6px;
}

.header-subtitle{
    color:#6b7280;
    font-size:13px;
    margin:0;
    line-height:1.7;
}

/* =========================================================
   HEADER ICON
========================================================= */

.header-icon{
    width:60px;
    height:60px;

    border-radius:18px;

    background:#ecfdf3;
    color:#16a34a;

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:24px;

    flex-shrink:0;
}

/* =========================================================
   CONTENT
========================================================= */

.panduan-container{
    width:100%;
}

/* =========================================================
   CARD
========================================================= */

.panduan-card{
    background:white;

    border-radius:20px;

    padding:24px;

    border:1px solid #eceff3;

    height:100%;

    transition:.25s;

    box-shadow:
    0 2px 12px rgba(15,23,42,0.04);
}

.panduan-card:hover{
    transform:translateY(-3px);

    box-shadow:
    0 10px 24px rgba(15,23,42,0.08);
}

/* =========================================================
   ICON
========================================================= */

.card-icon{
    width:54px;
    height:54px;

    border-radius:16px;

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:22px;

    margin-bottom:18px;
}

.green{
    background:#ecfdf3;
    color:#16a34a;
}

.blue{
    background:#eff6ff;
    color:#2563eb;
}

.orange{
    background:#fff7ed;
    color:#ea580c;
}

.red{
    background:#fef2f2;
    color:#dc2626;
}

/* =========================================================
   TEXT
========================================================= */

.panduan-card h5{
    font-size:18px;
    font-weight:600;

    margin-bottom:16px;

    color:#111827;
}

.panduan-card ul{
    padding-left:18px;
    margin:0;
}

.panduan-card ul li{
    margin-bottom:10px;

    color:#4b5563;

    line-height:1.8;
    font-size:14px;
}

.desc{
    color:#4b5563;

    line-height:1.9;
    font-size:14px;
}

/* =========================================================
   TIMELINE
========================================================= */

.timeline-box{
    margin-top:16px;
}

.timeline-item{
    display:flex;
    gap:12px;

    margin-bottom:20px;
}

.timeline-dot{
    width:12px;
    height:12px;

    border-radius:50%;

    margin-top:7px;

    flex-shrink:0;
}

.pending{
    background:#dc2626;
}

.proses{
    background:#f59e0b;
}

.selesai{
    background:#16a34a;
}

.timeline-item p{
    margin:3px 0 0;

    font-size:13px;
    line-height:1.7;

    color:#6b7280;
}

/* =========================================================
   PRIVACY
========================================================= */

.privacy-box{
    margin-top:18px;

    background:#f9fafb;

    border:1px solid #e5e7eb;

    border-radius:14px;

    padding:14px;

    display:flex;
    align-items:center;
    gap:10px;

    color:#374151;

    font-size:14px;
    line-height:1.7;
}

.privacy-box i{
    color:#16a34a;
}

/* =========================================================
   CONTACT
========================================================= */

.contact-card{
    background:white;

    border-radius:20px;

    padding:24px;

    border:1px solid #eceff3;

    display:flex;
    justify-content:space-between;
    align-items:center;

    flex-wrap:wrap;
    gap:18px;

    box-shadow:
    0 2px 12px rgba(15,23,42,0.04);
}

.contact-left{
    display:flex;
    align-items:center;
    gap:18px;
}

.contact-icon{
    width:60px;
    height:60px;

    border-radius:18px;

    background:#ecfdf3;
    color:#16a34a;

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:24px;

    flex-shrink:0;
}

.contact-card h5{
    margin-bottom:6px;
    font-weight:600;
}

.contact-card p{
    margin:0;

    color:#6b7280;

    font-size:14px;
    line-height:1.8;
}

/* =========================================================
   BUTTON
========================================================= */

.btn-chatbot{
    background:#16a34a;
    color:white;

    text-decoration:none;

    padding:12px 20px;

    border-radius:14px;

    font-size:14px;
    font-weight:500;

    display:flex;
    align-items:center;
    gap:8px;

    transition:.25s;

    flex-shrink:0;
}

.btn-chatbot:hover{
    background:#15803d;

    color:white;

    transform:translateY(-2px);
}

/* =========================================================
   RESPONSIVE
========================================================= */

@media(max-width:768px){

    .panduan-header{
        flex-direction:column;
        align-items:flex-start;

        gap:16px;
    }

    .contact-card{
        flex-direction:column;
        align-items:flex-start;
    }

    .contact-left{
        align-items:flex-start;
    }

    .btn-chatbot{
        width:100%;
        justify-content:center;
    }

}

</style>

@endsection