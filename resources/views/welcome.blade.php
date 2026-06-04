<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SIPENSA</title>

<link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<!-- AOS -->
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

<!-- Font -->
<link href="https://fonts.googleapis.com/css2?family=Suez+One&display=swap" rel="stylesheet">

<style>

/* =========================================================
   ROOT
========================================================= */

:root{
    --green: #0a7f2e;
    --green-dark: #086a25;
    --green-light: #d9f2dc;
    --text: #1f2937;
    --text-soft: #6b7280;
}

/* =========================================================
   BASE
========================================================= */

html{
    scroll-behavior: smooth;
}

body{
    font-family: 'Segoe UI', sans-serif;
    color: var(--text);
    overflow-x: hidden;
}

/* Biar gak ketutup navbar */
section{
    scroll-margin-top: 70px;
}

/* =========================================================
   NAVBAR
========================================================= */

.brand-font{
    font-family: 'Suez One', serif;
    font-size: 20px;
    letter-spacing: 0.5px;
}

.navbar{
    background: var(--green-dark);
    padding: 0 16px;
    height: 64px;
    position: sticky;
    top: 0;
    z-index: 1000;
    box-shadow: 0 2px 12px rgba(0,0,0,.12);
}

.navbar a{
    color: white !important;
}

.navbar-brand{
    display: flex;
    align-items: center;
    gap: 10px;
}

.navbar-brand span{
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* =========================================================
   HERO
========================================================= */

.hero{
    background: var(--green);
    color: white;
    padding: 80px 16px;
    text-align: center;
    position: relative;
    overflow: hidden;
}

/* Dekorasi lingkaran di hero */
.hero::before,
.hero::after{
    content: '';
    position: absolute;
    border-radius: 50%;
    opacity: .08;
    background: white;
    pointer-events: none;
}

.hero::before{
    width: 400px;
    height: 400px;
    top: -120px;
    left: -100px;
}

.hero::after{
    width: 300px;
    height: 300px;
    bottom: -80px;
    right: -80px;
}

.hero h1{
    font-size: 38px;
    font-weight: 800;
    line-height: 1.2;
    margin-bottom: 16px;
}

.hero p.lead{
    max-width: 560px;
    margin: 0 auto 28px;
    font-size: 16px;
    opacity: .9;
    line-height: 1.6;
}

.btn-hero{
    background: white;
    color: var(--green);
    border: none;
    border-radius: 12px;
    padding: 12px 28px;
    font-weight: 600;
    font-size: 15px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: .2s;
    box-shadow: 0 4px 16px rgba(0,0,0,.15);
}

.btn-hero:hover{
    background: #f0fdf4;
    color: var(--green-dark);
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(0,0,0,.18);
}

/* =========================================================
   FITUR
========================================================= */

.fitur-section{
    background: #f5f7fa;
    padding: 64px 16px;
}

.section-title{
    font-size: 26px;
    font-weight: 700;
    margin-bottom: 8px;
}

.section-sub{
    color: var(--text-soft);
    font-size: 15px;
    margin-bottom: 36px;
}

.card-fitur{
    background: white;
    border-radius: 16px;
    padding: 28px 22px;
    text-align: center;
    height: 100%;
    border: 1px solid #e9edf2;
    transition: .25s;
    box-shadow: 0 1px 4px rgba(0,0,0,.04);
}

.card-fitur:hover{
    transform: translateY(-6px);
    box-shadow: 0 10px 28px rgba(10,127,46,.1);
    border-color: #c8e6d0;
}

.icon-wrap{
    background: var(--green-light);
    width: 60px;
    height: 60px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 16px;
    font-size: 26px;
    color: var(--green);
    transition: .25s;
}

.card-fitur:hover .icon-wrap{
    background: var(--green);
    color: white;
}

.card-fitur h5{
    font-size: 16px;
    font-weight: 700;
    margin-bottom: 8px;
    color: var(--text);
}

.card-fitur p{
    font-size: 14px;
    color: var(--text-soft);
    line-height: 1.6;
    margin: 0;
}

/* =========================================================
   TENTANG
========================================================= */

.tentang{
    padding: 64px 16px;
    background: white;
}

.tentang h4{
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 14px;
}

.tentang p{
    color: var(--text-soft);
    line-height: 1.7;
    font-size: 15px;
}

.stat-box{
    text-align: center;
    padding: 20px 12px;
    border-radius: 14px;
    background: #f0fdf4;
    border: 1px solid #c8e6d0;
}

.stat-number{
    font-size: 32px;
    font-weight: 800;
    color: var(--green);
    line-height: 1;
    margin-bottom: 6px;
}

.stat-label{
    font-size: 13px;
    color: var(--text-soft);
}

/* =========================================================
   KONTAK
========================================================= */

.kontak{
    background: var(--green);
    color: white;
    padding: 64px 16px;
    text-align: center;
}

.kontak h4{
    font-size: 26px;
    font-weight: 700;
    margin-bottom: 8px;
}

.kontak .sub{
    opacity: .85;
    font-size: 15px;
    margin-bottom: 40px;
}

.kontak-card{
    background: rgba(255,255,255,.1);
    border-radius: 14px;
    padding: 24px 16px;
    border: 1px solid rgba(255,255,255,.15);
    height: 100%;
    transition: .2s;
}

.kontak-card:hover{
    background: rgba(255,255,255,.18);
    transform: translateY(-3px);
}

.kontak-card i{
    font-size: 28px;
    margin-bottom: 10px;
    display: block;
}

.kontak-card .kontak-label{
    font-weight: 600;
    font-size: 14px;
    margin-bottom: 4px;
    opacity: .75;
    text-transform: uppercase;
    letter-spacing: .5px;
}

.kontak-card .kontak-val{
    font-size: 15px;
    word-break: break-all;
}

/* =========================================================
   FOOTER
========================================================= */

.footer{
    background: var(--green-dark);
    color: rgba(255,255,255,.75);
    text-align: center;
    padding: 18px 16px;
    font-size: 13px;
}

/* =========================================================
   RESPONSIVE — TABLET (769px – 1024px)
========================================================= */

@media(min-width:769px) and (max-width:1024px){

    .hero{
        padding: 70px 24px;
    }

    .hero h1{
        font-size: 32px;
    }

    .fitur-section,
    .tentang,
    .kontak{
        padding: 52px 24px;
    }

    .section-title{
        font-size: 22px;
    }

    .card-fitur{
        padding: 22px 16px;
    }

    .stat-number{
        font-size: 26px;
    }

}

/* =========================================================
   RESPONSIVE — MOBILE (≤ 768px)
========================================================= */

@media(max-width:768px){

    /* Navbar */
    .brand-font{
        font-size: 16px;
    }

    .navbar-brand img{
        width: 32px;
    }

    /* Hero */
    .hero{
        padding: 52px 20px 48px;
    }

    .hero h1{
        font-size: 24px;
        font-weight: 800;
    }

    .hero p.lead{
        font-size: 14px;
        margin-bottom: 24px;
    }

    .btn-hero{
        padding: 11px 22px;
        font-size: 14px;
        width: 100%;
        justify-content: center;
        max-width: 260px;
    }

    /* Fitur */
    .fitur-section{
        padding: 44px 16px;
    }

    .section-title{
        font-size: 20px;
    }

    .section-sub{
        font-size: 14px;
        margin-bottom: 24px;
    }

    /* Grid fitur: 2 kolom di mobile */
    .fitur-section .row .col-md-4{
        flex: 0 0 50%;
        max-width: 50%;
    }

    .card-fitur{
        padding: 18px 14px;
    }

    .icon-wrap{
        width: 50px;
        height: 50px;
        font-size: 22px;
        border-radius: 12px;
    }

    .card-fitur h5{
        font-size: 14px;
    }

    .card-fitur p{
        font-size: 13px;
    }

    /* Tentang */
    .tentang{
        padding: 44px 16px;
    }

    .tentang h4{
        font-size: 20px;
        margin-bottom: 10px;
    }

    .tentang p{
        font-size: 14px;
    }

    /* Stat grid: 3 kolom tetap tapi lebih compact */
    .stat-box{
        padding: 14px 8px;
    }

    .stat-number{
        font-size: 22px;
    }

    .stat-label{
        font-size: 12px;
    }

    /* Kontak */
    .kontak{
        padding: 44px 16px;
    }

    .kontak h4{
        font-size: 20px;
    }

    .kontak .sub{
        font-size: 14px;
        margin-bottom: 28px;
    }

    .kontak-card{
        padding: 18px 14px;
    }

    .kontak-card i{
        font-size: 24px;
    }

    .kontak-card .kontak-val{
        font-size: 13px;
    }

}

/* =========================================================
   RESPONSIVE — SMALL MOBILE (≤ 400px)
========================================================= */

@media(max-width:400px){

    .brand-font{
        font-size: 14px;
    }

    .navbar-brand img{
        width: 28px;
    }

    .hero h1{
        font-size: 20px;
    }

    /* Fitur: 1 kolom di hp kecil */
    .fitur-section .row .col-md-4{
        flex: 0 0 100%;
        max-width: 100%;
    }

    .section-title{
        font-size: 18px;
    }

}

</style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg">
    <div class="container">

        <a class="navbar-brand text-white brand-font" href="/">
            <img src="/logo.png" width="40" alt="Logo">
            <span>SIPENSA</span>
        </a>

    </div>
</nav>

<!-- HERO -->
<section id="beranda" class="hero">
    <div class="container">

        <h1 data-aos="fade-up">
            Sistem Informasi Pengaduan <br>Permasalahan Sekolah
        </h1>

        <p class="lead" data-aos="fade-up" data-aos-delay="150">
            Platform digital untuk melaporkan dan memantau permasalahan sekolah
            dengan sistem multi-level yang terintegrasi
        </p>

        <div data-aos="fade-up" data-aos-delay="300">
            <a href="{{ route('login') }}" class="btn-hero">
                <i class="bi bi-box-arrow-in-right"></i> Masuk ke Sistem
            </a>
        </div>

    </div>
</section>

<!-- FITUR -->
<section id="fitur" class="fitur-section">
    <div class="container text-center">

        <h3 class="section-title" data-aos="fade-up">Fitur Unggulan</h3>
        <p class="section-sub" data-aos="fade-up">Solusi lengkap untuk sistem pengaduan sekolah modern</p>

        <div class="row g-3 g-md-4 justify-content-center">

            <div class="col-md-4" data-aos="zoom-in">
                <div class="card-fitur">
                    <div class="icon-wrap"><i class="bi bi-people"></i></div>
                    <h5>Multi-Level Access</h5>
                    <p>Sistem login untuk Siswa dan Guru BK dengan hak akses yang berbeda</p>
                </div>
            </div>

            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="80">
                <div class="card-fitur">
                    <div class="icon-wrap"><i class="bi bi-pencil-square"></i></div>
                    <h5>Pelaporan Mudah</h5>
                    <p>Interface yang user-friendly untuk melaporkan berbagai jenis permasalahan sekolah</p>
                </div>
            </div>

            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="160">
                <div class="card-fitur">
                    <div class="icon-wrap"><i class="bi bi-bell"></i></div>
                    <h5>Notifikasi Real-time</h5>
                    <p>Update status laporan otomatis dengan sistem notifikasi terintegrasi</p>
                </div>
            </div>

            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="0">
                <div class="card-fitur">
                    <div class="icon-wrap"><i class="bi bi-graph-up"></i></div>
                    <h5>Pemantauan Dashboard</h5>
                    <p>Dashboard komprehensif untuk memantau semua laporan dan statistik</p>
                </div>
            </div>

            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="80">
                <div class="card-fitur">
                    <div class="icon-wrap"><i class="bi bi-chat-dots-fill"></i></div>
                    <h5>Sistem Respon</h5>
                    <p>Fitur komunikasi dua arah antara pelapor dan penanggung jawab</p>
                </div>
            </div>

            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="160">
                <div class="card-fitur">
                    <div class="icon-wrap"><i class="bi bi-robot"></i></div>
                    <h5>Fitur ChatBot</h5>
                    <p>Chatbot interaktif yang memudahkan siswa mendapatkan panduan dan informasi pengaduan</p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- TENTANG -->
<section id="tentang" class="tentang">
    <div class="container">
        <div class="row align-items-center g-4">

            <div class="col-md-6" data-aos="fade-right">
                <h4>Tentang SIPENSA</h4>
                <p>SIPENSA merupakan platform digital yang dirancang untuk memfasilitasi siswa dalam menyampaikan pengaduan, maupun permasalahan yang terjadi di lingkungan sekolah secara mudah, aman, dan terstruktur. Melalui sistem ini, setiap laporan yang dikirimkan dapat dipantau status penanganannya sehingga proses tindak lanjut menjadi lebih transparan dan efektif. 
                    SIPENSA hadir sebagai sarana komunikasi antara siswa dan pihak sekolah untuk menciptakan lingkungan belajar yang nyaman, aman, serta mendukung perkembangan akademik maupun non-akademik. Dengan fitur pelaporan, pemantauan, dan pendampingan, siswa dapat menyampaikan berbagai permasalahan yang dihadapi tanpa harus merasa khawatir atau kesulitan dalam mencari bantuan. 
                    Mari bersama membangun lingkungan sekolah yang lebih baik melalui partisipasi aktif, kepedulian, dan komunikasi yang terbuka melalui SIPENSA.</p>
            </div>

            <div class="col-md-6" data-aos="fade-left">
                <div class="row g-3">
                    <div class="col-4">
                        <div class="stat-box">
                            <div class="stat-number">100+</div>
                            <div class="stat-label">Laporan Terproses</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="stat-box">
                            <div class="stat-number">95%</div>
                            <div class="stat-label">Tingkat Kepuasan</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="stat-box">
                            <div class="stat-number">24/7</div>
                            <div class="stat-label">Akses Sistem</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- KONTAK -->
<section id="kontak" class="kontak">
    <div class="container">

        <h4 data-aos="fade-up">Hubungi Kami</h4>
        <p class="sub" data-aos="fade-up">Ada pertanyaan? Tim kami siap membantu Anda</p>

        <div class="row g-3 justify-content-center">

            <div class="col-sm-6 col-md-4" data-aos="fade-up">
                <div class="kontak-card">
                    <i class="bi bi-envelope"></i>
                    <div class="kontak-label">Email</div>
                    <div class="kontak-val">support@SIPENSA.sch.id</div>
                </div>
            </div>

            <div class="col-sm-6 col-md-4" data-aos="fade-up" data-aos-delay="80">
                <div class="kontak-card">
                    <i class="bi bi-telephone"></i>
                    <div class="kontak-label">Telepon</div>
                    <div class="kontak-val">+62 813-5265-5551</div>
                </div>
            </div>

            <div class="col-sm-6 col-md-4" data-aos="fade-up" data-aos-delay="160">
                <div class="kontak-card">
                    <i class="bi bi-geo-alt"></i>
                    <div class="kontak-label">Alamat</div>
                    <div class="kontak-val">Jl. Trans - Kalimantan No.Km. 23, Beringin Jaya, Kec. Anjir Muara, Kabupaten Barito Kuala, Kalimantan Selatan 70564</div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- FOOTER -->
<div class="footer">
    © 2025 SIPENSA — Sistem Informasi Pengaduan Permasalahan Siswa . All rights reserved.
</div>

<!-- AOS JS -->
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
AOS.init({ duration: 900, once: true });
</script>

</body>
</html>