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
    --green: #0a7f2e;
    --green-dark: #064e1d;
    --bg: #f5f7fa;
    --surface: #ffffff;
    --border: #e9edf2;
    --text: #1f2937;
    --text-soft: #6b7280;
    --shadow: 0 1px 2px rgba(15,23,42,.03), 0 8px 24px rgba(15,23,42,.04);

    --sidebar-width: 260px;
    --navbar-height: 70px;
}

/* =========================================================
   RESET
========================================================= */

*, *::before, *::after {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html, body {
    height: 100%;
    overflow: hidden;
}

body {
    font-family: 'Segoe UI', sans-serif;
    background: var(--bg);
    color: var(--text);
}

/* =========================================================
   NAVBAR
========================================================= */

.brand-font {
    font-family: 'Suez One', serif;
    font-size: 22px;
}

.navbar {
    height: var(--navbar-height);
    background: var(--green);
    position: fixed;
    top: 0; left: 0; right: 0;
    z-index: 1100;
    padding: 0 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,.08);
    display: flex;
    align-items: center;
}

.navbar a { color: white !important; }

.navbar-brand {
    display: flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
    user-select: none;
    color: white;
    text-decoration: none;
}

.navbar-brand span {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* =========================================================
   LAYOUT WRAPPER
   Semua layout pakai flex row di bawah navbar
========================================================= */

.layout-body {
    position: fixed;
    top: var(--navbar-height);
    left: 0; right: 0; bottom: 0;
    display: flex;
    overflow: hidden;
}

/* =========================================================
   SIDEBAR
   Desktop: bagian dari flex row → mendorong konten
   Mobile/Tablet: fixed overlay → tidak menimpa konten
========================================================= */

.sidebar {
    width: var(--sidebar-width);
    flex-shrink: 0;

    background: linear-gradient(180deg, #0a7f2e, #064e1d);
    color: white;
    padding: 22px 18px;
    overflow-y: auto;

    /* Animasi buka/tutup */
    transition: width .3s ease, margin-left .3s ease;

    /* Di atas overlay tapi di bawah navbar */
    z-index: 10;
}

/* Desktop: sidebar tertutup → width 0 */
.sidebar.collapsed {
    width: 0;
    padding: 0;
    overflow: hidden;
}

/* SCROLLBAR */
.sidebar::-webkit-scrollbar { width: 6px; }
.sidebar::-webkit-scrollbar-thumb {
    background: rgba(255,255,255,.2);
    border-radius: 20px;
}

/* =========================================================
   CONTENT
   Otomatis mengisi sisa lebar setelah sidebar
========================================================= */

.content {
    flex: 1;
    overflow-y: auto;
    overflow-x: hidden;
    padding: 22px;
    background: var(--bg);
    min-width: 0; /* penting agar flex tidak overflow */
}

.content::-webkit-scrollbar { width: 8px; }
.content::-webkit-scrollbar-thumb {
    background: #d1d5db;
    border-radius: 20px;
}

.content > *:last-child { margin-bottom: 40px; }

/* =========================================================
   OVERLAY — hanya muncul di mobile/tablet
========================================================= */

.sidebar-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.45);
    z-index: 1085; /* di atas konten, di bawah sidebar mobile */
}

.sidebar-overlay.show { display: block; }

/* =========================================================
   MOBILE & TABLET — sidebar jadi overlay (fixed)
========================================================= */

@media(max-width:1024px){

    /* Sidebar keluar dari flex flow, jadi fixed overlay */
    .sidebar {
        position: fixed;
        top: var(--navbar-height);
        left: 0; bottom: 0;
        width: var(--sidebar-width);
        z-index: 1095;
        padding: 22px 18px;
        overflow-y: auto;

        /* Default tersembunyi di kiri */
        transform: translateX(-100%);
        transition: transform .3s ease;
    }

    /* Saat terbuka */
    .sidebar.show {
        transform: translateX(0);
    }

    /* Batalkan collapsed (tidak berlaku di mobile) */
    .sidebar.collapsed {
        width: var(--sidebar-width);
        padding: 22px 18px;
        overflow-y: auto;
    }

    /* Content tetap full width karena sidebar sudah di luar flex */
    .content {
        padding: 16px;
    }

}

/* =========================================================
   SIDEBAR INNER
========================================================= */

.sidebar {
    display: flex;
    flex-direction: column;
}

.sidebar-menu-wrap {
    flex: 1;
    overflow-y: auto;
}

/* =========================================================
   MENU
========================================================= */

.menu-section { margin-top: 14px; }

.menu-title {
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 1.2px;
    text-transform: uppercase;
    opacity: .5;
    margin-bottom: 8px;
    padding-left: 4px;
}

.menu-item {
    display: flex;
    align-items: center;
    gap: 11px;
    text-decoration: none;
    color: rgba(255,255,255,.88);
    padding: 11px 13px;
    border-radius: 12px;
    margin-bottom: 4px;
    transition: background .2s, padding-left .2s;
    font-size: 14px;
    font-weight: 500;
    white-space: nowrap;
    overflow: hidden;
}

.menu-item i {
    font-size: 17px;
    flex-shrink: 0;
    width: 20px;
    text-align: center;
}

.menu-item:hover {
    background: rgba(255,255,255,.1);
    color: white;
    padding-left: 17px;
}

.menu-item.active {
    background: rgba(255,255,255,.15);
    color: white;
    font-weight: 600;
    border-left: 3px solid rgba(255,255,255,.8);
    padding-left: 10px;
}

/* Sembunyikan teks saat collapsed (desktop) */
.sidebar.collapsed .menu-item span,
.sidebar.collapsed .menu-title,
.sidebar.collapsed .sidebar-footer {
    display: none;
}

/* =========================================================
   FOOTER SIDEBAR
========================================================= */

.sidebar-footer {
    flex-shrink: 0;
    padding: 12px 0 0;
    margin-top: 8px;
    border-top: 1px solid rgba(255,255,255,.12);
}

.footer-user {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 12px;
    border-radius: 12px;
    background: rgba(0,0,0,.15);
}

.footer-avatar {
    width: 38px;
    height: 38px;
    border-radius: 10px;
    background: rgba(255,255,255,.15);
    border: 1.5px solid rgba(255,255,255,.25);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 15px;
    color: white;
    flex-shrink: 0;
}

.footer-name {
    font-size: 13px;
    font-weight: 600;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    color: white;
}

.footer-role {
    font-size: 11px;
    color: rgba(255,255,255,.55);
    margin-top: 1px;
}

.footer-avatar .avatar-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 8px;
}

/* Mobile/Tablet: footer sticky di bawah sidebar */
@media(max-width:1024px){
    .sidebar-footer {
        position: sticky;
        bottom: 0;
        background: #064e1d;
        margin: 8px -18px -22px;
        padding: 12px 18px;
        border-top: 1px solid rgba(255,255,255,.1);
        border-radius: 0;
    }
}

/* =========================================================
   GLOBAL CARD
========================================================= */

.card-box,
.form-box,
.laporan-wrapper,
.dashboard-header,
.stat-card,
.chat-box {
    background: white;
    border-radius: 16px;
    border: 1px solid var(--border);
    box-shadow: var(--shadow);
}

.card-box,
.form-box,
.laporan-wrapper,
.chat-box { padding: 22px; }

.dashboard-header {
    position: sticky;
    top: 0;
    z-index: 100;
    background: white;
    border: 1px solid #e9edf2;
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
}

/* =========================================================
   STAT CARD
========================================================= */

.stat-card { padding: 20px; transition: .2s; }
.stat-card:hover { transform: translateY(-2px); }
.stat-number { font-size: 34px; font-weight: 700; }

/* =========================================================
   BUTTON
========================================================= */

.btn-green {
    background: var(--green);
    color: white;
    border: none;
    border-radius: 10px;
    padding: 10px 18px;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    transition: .2s;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.btn-green:hover { background: #066621; color: white; }

/* =========================================================
   FORM
========================================================= */

.form-control,
.form-select {
    border-radius: 12px;
    min-height: 50px;
    border: 1px solid #e5e7eb;
    box-shadow: none !important;
}

.form-control:focus,
.form-select:focus { border-color: #bfd7ca; }

textarea.form-control { min-height: 130px; }

/* =========================================================
   LAPORAN
========================================================= */

.laporan-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}

.filter-status {
    border: 1px solid #d1d5db;
    border-radius: 10px;
    padding: 10px 15px;
}

.laporan-card {
    background: #f8fafc;
    border: 1px solid #edf2f7;
    border-radius: 14px;
    padding: 18px;
    margin-bottom: 16px;
    transition: .2s;
}

.laporan-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(0,0,0,.04);
}

.laporan-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 18px;
    font-size: 13px;
    color: var(--text-soft);
    flex-wrap: wrap;
    gap: 10px;
}

/* =========================================================
   STATUS
========================================================= */

.status-proses, .status-selesai, .status-pending {
    padding: 6px 13px;
    border-radius: 30px;
    font-size: 11px;
    font-weight: 600;
}

.status-proses  { background: #fef3c7; color: #b45309; }
.status-selesai { background: #dcfce7; color: #15803d; }
.status-pending { background: #fee2e2; color: #dc2626; }

/* =========================================================
   PROFILE
========================================================= */

.profile-img {
    width: 110px; height: 110px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #dcfce7;
}

/* =========================================================
   CHATBOT FLOAT
========================================================= */

.chatbot-btn {
    position: fixed;
    right: 20px; bottom: 20px;
    width: 58px; height: 58px;
    border-radius: 50%;
    background: var(--green);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    font-size: 26px;
    box-shadow: 0 10px 25px rgba(0,0,0,.2);
    z-index: 1000;
}

/* =========================================================
   RESPONSIVE — TABLET
========================================================= */

@media(min-width:769px) and (max-width:1024px){

    .brand-font { font-size: 18px; }
    .navbar-brand img { width: 34px; }

    .menu-item { font-size: 13px; padding: 11px 12px; }
    .menu-item i { font-size: 16px; }
    .menu-title { font-size: 10px; }
    .footer-name { font-size: 13px; }
    .footer-avatar { width: 38px; height: 38px; font-size: 14px; }

    .stat-number { font-size: 28px; }

    .card-box, .form-box, .laporan-wrapper, .chat-box { padding: 18px; }

    h2, h3 { font-size: 20px !important; }
    h4, h5 { font-size: 17px !important; }

    .profile-img { width: 90px; height: 90px; }

}

/* =========================================================
   RESPONSIVE — MOBILE
========================================================= */

@media(max-width:768px){

    .brand-font { font-size: 15px; }
    .navbar-brand img { width: 30px; }

    .content { padding: 14px; }

    .dashboard-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }

    .laporan-top {
        flex-direction: column;
        align-items: stretch;
    }

    .filter-status { width: 100%; }

    .laporan-footer {
        flex-direction: column;
        align-items: flex-start;
    }

    .stat-number { font-size: 26px; }

    h2, h3, h4, h5 { font-size: 18px !important; }

    .card-box, .form-box, .laporan-wrapper, .chat-box { padding: 14px; }

    .form-control, .form-select { min-height: 44px; font-size: 14px; }

    .profile-img { width: 80px; height: 80px; }

    .bubble-user, .bubble-bot { max-width: 90%; }

    .chatbot-btn {
        width: 50px; height: 50px;
        font-size: 22px;
        right: 14px; bottom: 14px;
    }

    .btn-green.w-100-mobile {
        width: 100%;
        justify-content: center;
    }

}

/* =========================================================
   RESPONSIVE — SMALL MOBILE
========================================================= */

@media(max-width:400px){
    .brand-font { font-size: 13px; }
    .navbar-brand img { width: 26px; }
    .content { padding: 10px; }
    .stat-number { font-size: 22px; }
}

</style>

</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid px-3">

        <div class="navbar-brand brand-font" id="navbarToggle" role="button" aria-label="Toggle sidebar">
            <img src="{{ asset('images/logo.png') }}" width="40" alt="Logo">
            <span>SIPENSA</span>
        </div>

    </div>
</nav>

<!-- OVERLAY — hanya aktif di mobile/tablet -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- LAYOUT BODY -->
<div class="layout-body">

    <!-- SIDEBAR -->
    <div class="sidebar" id="sidebar">

        <!-- MENU WRAP -->
        <div class="sidebar-menu-wrap">

            <div class="menu-section">
                <p class="menu-title">Utama</p>

                <a href="/siswa" class="menu-item {{ request()->is('siswa') ? 'active' : '' }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>

                <a href="/buat-laporan" class="menu-item {{ request()->is('buat-laporan') ? 'active' : '' }}">
                    <i class="bi bi-plus-circle"></i>
                    <span>Buat Laporan</span>
                </a>

                <a href="/laporan_saya" class="menu-item {{ request()->is('laporan_saya') ? 'active' : '' }}">
                    <i class="bi bi-journal-text"></i>
                    <span>Laporan Saya</span>
                </a>

                <a href="/panduan-konseling" class="menu-item {{ request()->is('panduan-konseling') ? 'active' : '' }}">
                    <i class="bi bi-book"></i>
                    <span>Panduan Konseling</span>
                </a>
            </div>

            <div class="menu-section">
                <p class="menu-title">Akun</p>

                <a href="/siswa/profil" class="menu-item {{ request()->is('siswa/profil') ? 'active' : '' }}">
                    <i class="bi bi-person"></i>
                    <span>Profil</span>
                </a>

                <a href="/chatbot" class="menu-item {{ request()->is('chatbot') ? 'active' : '' }}">
                    <i class="bi bi-robot"></i>
                    <span>Chatbot AI</span>
                </a>
            </div>

        </div>

        <!-- FOOTER PROFIL -->
        <div class="sidebar-footer">
            <div class="footer-user">
                <div class="footer-avatar">
                    @if(auth()->user()->foto)
                        <img src="{{ asset('storage/' . auth()->user()->foto) }}"
                             alt="Foto"
                             class="avatar-img">
                    @else
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    @endif
                </div>
                <div style="min-width:0;">
                    <div class="footer-name">{{ auth()->user()->name }}</div>
                    <div class="footer-role">Siswa</div>
                </div>
            </div>
        </div>

    </div>

    <!-- CONTENT -->
    <div class="content" id="mainContent">
        @yield('content')
    </div>

</div>

<script>

const sidebar      = document.getElementById('sidebar');
const overlay      = document.getElementById('sidebarOverlay');
const navbarToggle = document.getElementById('navbarToggle');

function isDesktop(){ return window.innerWidth > 1024; }

/* State:
   Desktop  → default terbuka
   Mobile/Tablet → default tertutup
*/
let sidebarOpen = isDesktop();
applyState();

/* Klik logo */
navbarToggle.addEventListener('click', () => {
    sidebarOpen = !sidebarOpen;
    applyState();
});

/* Klik overlay */
overlay.addEventListener('click', () => {
    sidebarOpen = false;
    applyState();
});

/* Klik menu item → tutup di mobile/tablet */
document.querySelectorAll('.menu-item').forEach(item => {
    item.addEventListener('click', () => {
        if(!isDesktop()){
            sidebarOpen = false;
            applyState();
        }
    });
});

function applyState(){
    if(isDesktop()){
        /* Desktop: sidebar dalam flex row → collapsed = width 0 */
        overlay.classList.remove('show');
        sidebar.classList.remove('show');  /* hapus class mobile */

        if(sidebarOpen){
            sidebar.classList.remove('collapsed');
        } else {
            sidebar.classList.add('collapsed');
        }

    } else {
        /* Mobile/Tablet: sidebar fixed overlay → pakai transform */
        sidebar.classList.remove('collapsed'); /* hapus class desktop */

        if(sidebarOpen){
            sidebar.classList.add('show');
            overlay.classList.add('show');
        } else {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
        }
    }
}

/* Reset saat resize melewati breakpoint */
let lastBreakpoint = isDesktop();
window.addEventListener('resize', () => {
    const nowDesktop = isDesktop();
    if(nowDesktop !== lastBreakpoint){
        lastBreakpoint = nowDesktop;
        sidebarOpen = nowDesktop;
        applyState();
    }
});

</script>

</body>
</html>