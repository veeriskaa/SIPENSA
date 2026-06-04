<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>@yield('title','Dashboard Siswa')</title>

<link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Suez+One&display=swap" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<style>

/* =========================================================
   ROOT
========================================================= */

:root{
    --green:#0a7f2e;
    --green-dark:#064e1d;

    --bg:#f5f7fa;
    --surface:#ffffff;

    --border:#e9edf2;

    --text:#1f2937;
    --text-soft:#6b7280;

    --shadow:
    0 1px 2px rgba(15,23,42,.03),
    0 8px 24px rgba(15,23,42,.04);

    --sidebar-width: 260px;
    --navbar-height: 70px;
}

/* =========================================================
   RESET
========================================================= */

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

html,
body{
    height:100%;
    overflow:hidden;
}

/* =========================================================
   BODY
========================================================= */

body{
    font-family:'Segoe UI',sans-serif;
    background:var(--bg);
    color:var(--text);
}

/* =========================================================
   NAVBAR
========================================================= */

.brand-font{
    font-family:'Suez One',serif;
    font-size:22px;
}

.navbar{
    height:var(--navbar-height);

    background:var(--green);

    position:fixed;
    top:0;
    left:0;
    right:0;

    z-index:1100;

    padding:0 10px;

    box-shadow:
    0 2px 10px rgba(0,0,0,.08);
}

.navbar a{
    color:white !important;
}

/* Logo / brand sebagai toggle button */
.navbar-brand{
    display:flex;
    align-items:center;
    gap:10px;

    cursor:pointer;

    user-select:none;
}

.navbar-brand span{
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* =========================================================
   SIDEBAR
========================================================= */

.sidebar{
    width:var(--sidebar-width);

    position:fixed;

    top:var(--navbar-height);
    left:0;
    bottom:0;

    background:
    linear-gradient(
        180deg,
        #0a7f2e,
        #064e1d
    );

    color:white;

    padding:22px 18px;

    overflow-y:auto;

    transition: left .3s ease, transform .3s ease;

    z-index:1050;
}

/* Desktop — default terbuka */
@media(min-width:1025px){
    .sidebar{
        left:0;
    }

    /* Saat ditutup di desktop */
    .sidebar.collapsed{
        left: calc(-1 * var(--sidebar-width));
    }
}

/* SCROLLBAR */

.sidebar::-webkit-scrollbar{
    width:6px;
}

.sidebar::-webkit-scrollbar-thumb{
    background:rgba(255,255,255,.2);
    border-radius:20px;
}

/* =========================================================
   MENU
========================================================= */

.menu-section{
    margin-top:18px;
}

.menu-title{
    font-size:11px;

    opacity:.7;

    margin-bottom:12px;

    letter-spacing:1px;
}

.menu-item{
    display:flex;
    align-items:center;
    gap:12px;

    text-decoration:none;

    color:white;

    padding:13px 14px;

    border-radius:14px;

    margin-bottom:8px;

    transition:.25s;

    font-size:14px;
    font-weight:500;
}

.menu-item i{
    font-size:18px;
    flex-shrink: 0;
}

.menu-item:hover{
    background:rgba(255,255,255,.12);

    color:white;

    transform:translateX(3px);
}

.menu-item.active{
    background:white;

    color:var(--green);

    font-weight:600;
}

/* =========================================================
   FOOTER SIDEBAR
========================================================= */

.sidebar-footer{
    margin-top:65px;

    padding-top:18px;

    border-top:
    1px solid rgba(255,255,255,.15);
}

.footer-user{
    display:flex;
    align-items:center;
    gap:12px;
}

.footer-avatar{
    width:44px;
    height:44px;

    border-radius:50%;

    background:#22c55e;

    display:flex;
    align-items:center;
    justify-content:center;

    font-weight:700;

    flex-shrink: 0;
}

.footer-name{
    font-size:14px;
    font-weight:600;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* =========================================================
   CONTENT
========================================================= */

.content{
    position:fixed;

    top:var(--navbar-height);
    left:var(--sidebar-width);
    right:0;
    bottom:0;

    overflow-y:auto;
    overflow-x:hidden;

    padding:22px;

    background:#f5f7fa;

    transition: left .3s ease;
}

/* Desktop — sidebar collapsed → content full width */
@media(min-width:1025px){
    .content.expanded{
        left:0;
    }
}

/* SCROLLBAR */

.content::-webkit-scrollbar{
    width:8px;
}

.content::-webkit-scrollbar-thumb{
    background:#d1d5db;
    border-radius:20px;
}

.content > *:last-child{
    margin-bottom:40px;
}

/* =========================================================
   GLOBAL CARD
========================================================= */

.card-box,
.form-box,
.laporan-wrapper,
.dashboard-header,
.stat-card,
.chat-box{
    background:white;

    border-radius:16px;

    border:1px solid var(--border);

    box-shadow:var(--shadow);
}

/* =========================================================
   CARD PADDING
========================================================= */

.card-box,
.form-box,
.laporan-wrapper,
.chat-box{
    padding:22px;
}

/* =========================================================
   FIXED DASHBOARD HEADER
========================================================= */

.dashboard-header{
    position:sticky;
    top:0;

    z-index:100;

    background:white;

    border:1px solid #e9edf2;

    backdrop-filter:blur(10px);

    -webkit-backdrop-filter:blur(10px);
}

/* =========================================================
   STAT CARD
========================================================= */

.stat-card{
    padding:20px;

    transition:.2s;
}

.stat-card:hover{
    transform:translateY(-2px);
}

.stat-number{
    font-size:34px;
    font-weight:700;
}

/* =========================================================
   BUTTON
========================================================= */

.btn-green{
    background:var(--green);

    color:white;

    border:none;

    border-radius:10px;

    padding:10px 18px;

    font-size:14px;
    font-weight:500;

    text-decoration:none;

    transition:.2s;

    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.btn-green:hover{
    background:#066621;
    color:white;
}

/* =========================================================
   FORM
========================================================= */

.form-control,
.form-select{
    border-radius:12px;

    min-height:50px;

    border:1px solid #e5e7eb;

    box-shadow:none !important;
}

.form-control:focus,
.form-select:focus{
    border-color:#bfd7ca;
}

textarea.form-control{
    min-height:130px;
}

/* =========================================================
   LAPORAN
========================================================= */

.laporan-top{
    display:flex;
    justify-content:space-between;
    align-items:center;

    gap:12px;

    margin-bottom:20px;

    flex-wrap:wrap;
}

.filter-status{
    border:1px solid #d1d5db;

    border-radius:10px;

    padding:10px 15px;
}

.laporan-card{
    background:#f8fafc;

    border:1px solid #edf2f7;

    border-radius:14px;

    padding:18px;

    margin-bottom:16px;

    transition:.2s;
}

.laporan-card:hover{
    transform:translateY(-2px);

    box-shadow:
    0 6px 18px rgba(0,0,0,.04);
}

.laporan-footer{
    display:flex;
    justify-content:space-between;
    align-items:center;

    margin-top:18px;

    font-size:13px;

    color:var(--text-soft);

    flex-wrap:wrap;
    gap:10px;
}

/* =========================================================
   STATUS
========================================================= */

.status-proses,
.status-selesai,
.status-pending{
    padding:6px 13px;

    border-radius:30px;

    font-size:11px;
    font-weight:600;
}

.status-proses{
    background:#fef3c7;
    color:#b45309;
}

.status-selesai{
    background:#dcfce7;
    color:#15803d;
}

.status-pending{
    background:#fee2e2;
    color:#dc2626;
}

/* =========================================================
   PROFILE
========================================================= */

.profile-img{
    width:110px;
    height:110px;

    border-radius:50%;

    object-fit:cover;

    border:4px solid #dcfce7;
}

/* =========================================================
   CHATBOT
========================================================= */

.chat-box{
    height:450px;

    overflow-y:auto;
}

.chat-user,
.chat-bot{
    margin-bottom:14px;
}

.chat-user{
    text-align:right;
}

.chat-bot{
    text-align:left;
}

.bubble-user{
    display:inline-block;

    background:var(--green);

    color:white;

    padding:12px 16px;

    border-radius:18px 18px 0 18px;

    max-width:80%;
}

.bubble-bot{
    display:inline-block;

    background:#f3f4f6;

    padding:12px 16px;

    border-radius:18px 18px 18px 0;

    max-width:80%;
}

/* =========================================================
   CHATBOT FLOAT BUTTON
========================================================= */

.chatbot-btn{
    position:fixed;

    right:20px;
    bottom:20px;

    width:58px;
    height:58px;

    border-radius:50%;

    background:var(--green);

    color:white;

    display:flex;
    align-items:center;
    justify-content:center;

    text-decoration:none;

    font-size:26px;

    box-shadow:
    0 10px 25px rgba(0,0,0,.2);

    z-index:1000;
}

/* =========================================================
   OVERLAY (Mobile & Tablet)
========================================================= */

.sidebar-overlay{
    display:none;

    position:fixed;

    inset:0;

    background:rgba(0,0,0,.4);

    z-index:1040;
}

.sidebar-overlay.show{
    display:block;
}

/* =========================================================
   RESPONSIVE — TABLET (769px – 1024px)
========================================================= */

@media(min-width:769px) and (max-width:1024px){

    :root{
        --sidebar-width: 220px;
    }

    /* Sidebar tersembunyi by default di tablet */
    .sidebar{
        left:-100%;
    }

    .sidebar.show{
        left:0;
    }

    /* Content full width di tablet */
    .content{
        left:0;
        padding:16px;
    }

    .brand-font{
        font-size:18px;
    }

    .navbar-brand img{
        width:34px;
    }

    .menu-item{
        font-size:13px;
        padding:11px 12px;
    }

    .menu-item i{
        font-size:16px;
    }

    .menu-title{
        font-size:10px;
    }

    .footer-name{
        font-size:13px;
    }

    .footer-avatar{
        width:38px;
        height:38px;
        font-size:14px;
    }

    .stat-number{
        font-size:28px;
    }

    .card-box,
    .form-box,
    .laporan-wrapper,
    .chat-box{
        padding:18px;
    }

    h2,h3{
        font-size:20px !important;
    }

    h4,h5{
        font-size:17px !important;
    }

    .chat-box{
        height:380px;
    }

    .profile-img{
        width:90px;
        height:90px;
    }

}

/* =========================================================
   RESPONSIVE — MOBILE (≤ 768px)
========================================================= */

@media(max-width:768px){

    /* Sidebar tersembunyi by default */
    .sidebar{
        left:-100%;
        width:240px;
    }

    .sidebar.show{
        left:0;
    }

    /* Content full width */
    .content{
        left:0;
        padding:14px;
    }

    /* Brand font lebih kecil */
    .brand-font{
        font-size:15px;
    }

    .navbar-brand img{
        width:30px;
    }

    /* Sembunyikan toggle hint di mobile (icon cukup kecil) */
    .navbar-brand .toggle-hint{
        width:24px;
        height:24px;
        font-size:14px;
    }

    /* Dashboard header stack vertikal */
    .dashboard-header{
        flex-direction:column;
        align-items:flex-start;
        gap:10px;
    }

    /* Laporan top stack vertikal */
    .laporan-top{
        flex-direction:column;
        align-items:stretch;
    }

    .filter-status{
        width:100%;
    }

    /* Laporan footer stack vertikal */
    .laporan-footer{
        flex-direction:column;
        align-items:flex-start;
    }

    /* Angka stat lebih kecil */
    .stat-number{
        font-size:26px;
    }

    /* Heading lebih kecil */
    h2,h3,h4,h5{
        font-size:18px !important;
    }

    /* Card padding lebih kecil */
    .card-box,
    .form-box,
    .laporan-wrapper,
    .chat-box{
        padding:14px;
    }

    /* Form field */
    .form-control,
    .form-select{
        min-height:44px;
        font-size:14px;
    }

    /* Chatbot */
    .chat-box{
        height:320px;
    }

    /* Profil */
    .profile-img{
        width:80px;
        height:80px;
    }

    /* Bubble */
    .bubble-user,
    .bubble-bot{
        max-width:90%;
    }

    /* Chatbot float */
    .chatbot-btn{
        width:50px;
        height:50px;
        font-size:22px;
        right:14px;
        bottom:14px;
    }

    .btn-green.w-100-mobile{
        width:100%;
        justify-content:center;
    }

}

/* =========================================================
   RESPONSIVE — SMALL MOBILE (≤ 400px)
========================================================= */

@media(max-width:400px){

    .brand-font{
        font-size:13px;
    }

    .navbar-brand img{
        width:26px;
    }

    .navbar-brand .toggle-hint{
        display:none;
    }

    .content{
        padding:10px;
    }

    .stat-number{
        font-size:22px;
    }

}

</style>

</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg">

    <div class="container-fluid px-3">

        {{-- Logo sekaligus toggle sidebar --}}
        <div class="navbar-brand text-white brand-font" id="navbarToggle" role="button" aria-label="Toggle sidebar">

            <img src="/logo.png" width="40" alt="Logo">

            <span>SIPENSA</span>

        </div>

    </div>

</nav>

<!-- OVERLAY (Mobile & Tablet) -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- SIDEBAR -->
<div class="sidebar" id="sidebar">

    <!-- MENU UTAMA -->
    <div class="menu-section">

        <p class="menu-title">UTAMA</p>

        <a href="/siswa"
           class="menu-item {{ request()->is('siswa') ? 'active' : '' }}">

            <i class="bi bi-grid"></i>
            Dashboard

        </a>

        <a href="/buat-laporan"
           class="menu-item {{ request()->is('buat-laporan') ? 'active' : '' }}">

            <i class="bi bi-plus-circle"></i>
            Buat Laporan

        </a>

        <a href="/laporan_saya"
           class="menu-item {{ request()->is('laporan_saya') ? 'active' : '' }}">

            <i class="bi bi-journal-text"></i>
            Laporan Saya

        </a>

        <a href="/panduan-konseling"
           class="menu-item {{ request()->is('panduan-konseling') ? 'active' : '' }}">

            <i class="bi bi-book"></i>
            Panduan Konseling

        </a>

    </div>

    <!-- MENU AKUN -->
    <div class="menu-section">

        <p class="menu-title">AKUN</p>

        <a href="/siswa/profil"
           class="menu-item {{ request()->is('siswa/profil') ? 'active' : '' }}">

            <i class="bi bi-person"></i>
            Profil

        </a>

        <a href="/chatbot"
           class="menu-item {{ request()->is('chatbot') ? 'active' : '' }}">

            <i class="bi bi-robot"></i>
            Chatbot AI

        </a>

    </div>

    <!-- FOOTER SIDEBAR -->
    <div class="sidebar-footer">

        <div class="footer-user">

            <div class="footer-avatar">
                {{ strtoupper(substr(auth()->user()->name,0,1)) }}
            </div>

            <div style="min-width:0;">

                <div class="footer-name">
                    {{ auth()->user()->name }}
                </div>

                <small style="opacity:.75;">Siswa</small>

            </div>

        </div>

    </div>

</div>

<!-- CONTENT -->
<div class="content" id="mainContent">

    @yield('content')

</div>

<script>

/* =========================================================
   ELEMEN
========================================================= */

const sidebar       = document.getElementById('sidebar');
const overlay       = document.getElementById('sidebarOverlay');
const navbarToggle  = document.getElementById('navbarToggle');
const mainContent   = document.getElementById('mainContent');

/* =========================================================
   CEK UKURAN LAYAR
========================================================= */

function isDesktop(){
    return window.innerWidth > 1024;
}

/* =========================================================
   STATE SIDEBAR
   Desktop: default terbuka (true)
   Mobile/Tablet: default tertutup (false)
========================================================= */

let sidebarOpen = isDesktop();

/* Terapkan state awal */
applyState();

/* =========================================================
   TOGGLE SIDEBAR — klik logo/brand
========================================================= */

navbarToggle.addEventListener('click', () => {
    sidebarOpen = !sidebarOpen;
    applyState();
});

/* Tutup lewat overlay (mobile/tablet) */
overlay.addEventListener('click', () => {
    sidebarOpen = false;
    applyState();
});

/* Tutup saat klik menu item di mobile/tablet */
document.querySelectorAll('.menu-item').forEach(item => {
    item.addEventListener('click', () => {
        if(!isDesktop()){
            sidebarOpen = false;
            applyState();
        }
    });
});

/* =========================================================
   APPLY STATE
========================================================= */

function applyState(){

    if(isDesktop()){

        /* Desktop — sidebar geser ke kiri, content melebar */
        overlay.classList.remove('show');

        if(sidebarOpen){
            sidebar.classList.remove('collapsed');
            mainContent.classList.remove('expanded');
        } else {
            sidebar.classList.add('collapsed');
            mainContent.classList.add('expanded');
        }

    } else {

        /* Mobile / Tablet — sidebar overlay */
        sidebar.classList.remove('collapsed');
        mainContent.classList.remove('expanded');

        if(sidebarOpen){
            sidebar.classList.add('show');
            overlay.classList.add('show');
        } else {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
        }

    }

    /* Update body class */
    document.body.classList.toggle('sidebar-open', sidebarOpen);
}

/* =========================================================
   HANDLE RESIZE
========================================================= */

window.addEventListener('resize', () => {
    /* Reset state saat pindah breakpoint */
    sidebarOpen = isDesktop();
    applyState();
});

</script>

</body>
</html>