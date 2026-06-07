<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('title','Dashboard Guru BK')</title>

<link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Suez+One&display=swap" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<style>

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

*, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

html, body { height: 100%; overflow: hidden; }

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
    background: linear-gradient(135deg, #0b6b27, #0f7a2d);
    position: fixed;
    top: 0; left: 0; right: 0;
    z-index: 1100;
    padding: 0 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,.08);
    display: flex;
    align-items: center;
}

.navbar-brand {
    display: flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
    user-select: none;
    color: white !important;
    text-decoration: none !important;
    -webkit-tap-highlight-color: transparent;
    outline: none;
}

.navbar-brand:hover,
.navbar-brand:focus,
.navbar-brand:active,
.navbar-brand:visited {
    color: white !important;
    text-decoration: none !important;
    background: none !important;
}

.navbar-brand span { color: white !important; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.navbar a { color: white !important; }

/* =========================================================
   LAYOUT
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
========================================================= */
.sidebar {
    width: var(--sidebar-width);
    flex-shrink: 0;
    background: linear-gradient(180deg, #0a7f2e, #064e1d);
    color: white;
    padding: 22px 18px;
    overflow-y: auto;
    transition: width .3s ease;
    z-index: 10;
    display: flex;
    flex-direction: column;
}

.sidebar.collapsed { width: 0; padding: 0; overflow: hidden; }

.sidebar::-webkit-scrollbar { width: 6px; }
.sidebar::-webkit-scrollbar-thumb { background: rgba(255,255,255,.2); border-radius: 20px; }

/* =========================================================
   CONTENT
========================================================= */
.content {
    flex: 1;
    overflow-y: auto;
    overflow-x: hidden;
    padding: 22px;
    background: var(--bg);
    min-width: 0;
}

.content::-webkit-scrollbar { width: 8px; }
.content::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 20px; }
.content > *:last-child { margin-bottom: 40px; }

/* FIX: Overlay selalu hidden */
.sidebar-overlay { display: none !important; }

/* =========================================================
   MOBILE & TABLET
========================================================= */
@media(max-width:1024px){

    .sidebar {
        position: fixed;
        top: var(--navbar-height);
        left: 0; bottom: 0;
        width: var(--sidebar-width);
        z-index: 1095;
        padding: 22px 18px;
        overflow-y: auto;
        transform: translateX(-100%);
        transition: transform .3s ease;
    }

    .sidebar.show { transform: translateX(0); }

    .sidebar.collapsed {
        width: var(--sidebar-width);
        padding: 22px 18px;
        overflow-y: auto;
    }

    .content { padding: 16px; }
}

/* =========================================================
   SIDEBAR INNER
========================================================= */
.sidebar-menu-wrap { flex: 1; overflow-y: auto; }

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
    justify-content: space-between;
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
    -webkit-tap-highlight-color: transparent;
}

.menu-item-left {
    display: flex;
    align-items: center;
    gap: 11px;
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

.menu-badge {
    background: #84cc16;
    color: #111827;
    font-size: 10px;
    font-weight: 700;
    padding: 3px 8px;
    border-radius: 30px;
    flex-shrink: 0;
}

.sidebar.collapsed .menu-item span,
.sidebar.collapsed .menu-title,
.sidebar.collapsed .sidebar-footer { display: none; }

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
    width: 38px; height: 38px;
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
    overflow: hidden;
}

.footer-name { font-size: 13px; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; color: white; }
.footer-role { font-size: 11px; color: rgba(255,255,255,.55); margin-top: 1px; }

.avatar-img { width: 100%; height: 100%; object-fit: cover; border-radius: 8px; }

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
   GLOBAL CARDS
========================================================= */
.card-box,
.dashboard-header {
    background: white;
    border-radius: 16px;
    border: 1px solid var(--border);
    box-shadow: var(--shadow);
    padding: 22px;
    margin-bottom: 18px;
}

.dashboard-header {
    position: sticky;
    top: 0;
    z-index: 100;
    background: white;
    backdrop-filter: blur(10px);
}

/* =========================================================
   MISC
========================================================= */
h1,h2,h3,h4,h5 { color: #111827; }
p { margin-bottom: 0; }

.profile-img { width: 110px; height: 110px; border-radius: 50%; object-fit: cover; border: 4px solid #dcfce7; }

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

.form-control, .form-select {
    border-radius: 12px;
    min-height: 50px;
    border: 1px solid #e5e7eb;
    box-shadow: none !important;
}

.form-control:focus, .form-select:focus { border-color: #bfd7ca; }
textarea.form-control { min-height: 130px; }

/* Status */
.status-proses  { padding: 6px 13px; border-radius: 30px; font-size: 11px; font-weight: 600; background: #fef3c7; color: #b45309; }
.status-selesai { padding: 6px 13px; border-radius: 30px; font-size: 11px; font-weight: 600; background: #dcfce7; color: #15803d; }
.status-pending { padding: 6px 13px; border-radius: 30px; font-size: 11px; font-weight: 600; background: #fee2e2; color: #dc2626; }



/* =========================================================
   RESPONSIVE — TABLET
========================================================= */
@media(min-width:769px) and (max-width:1024px){
    .brand-font { font-size: 18px; }
    .navbar-brand img { width: 34px; }
    .menu-item { font-size: 13px; padding: 11px 12px; }
    .menu-item i { font-size: 16px; }
    .footer-name { font-size: 13px; }
    .footer-avatar { width: 38px; height: 38px; font-size: 14px; }
    .card-box, .dashboard-header { padding: 18px; }
    h2,h3 { font-size: 20px !important; }
    h4,h5 { font-size: 17px !important; }
    .profile-img { width: 90px; height: 90px; }
}

/* =========================================================
   RESPONSIVE — MOBILE
========================================================= */
@media(max-width:768px){
    .brand-font { font-size: 15px; }
    .navbar-brand img { width: 30px; }
    .content { padding: 14px; }
    h2,h3,h4,h5 { font-size: 18px !important; }
    .card-box, .dashboard-header { padding: 14px; border-radius: 14px; }
    .form-control, .form-select { min-height: 44px; font-size: 14px; }
    .profile-img { width: 80px; height: 80px; }
}

@media(max-width:400px){
    .brand-font { font-size: 13px; }
    .navbar-brand img { width: 26px; }
    .content { padding: 10px; }
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

<!-- Overlay selalu hidden -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- LAYOUT -->
<div class="layout-body">

    <!-- SIDEBAR -->
    <div class="sidebar" id="sidebar">

        <div class="sidebar-menu-wrap">

            <div class="menu-section">
                <p class="menu-title">Utama</p>

                <a href="/guru" class="menu-item {{ request()->is('guru') ? 'active' : '' }}">
                    <div class="menu-item-left">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </div>
                </a>

                <a href="{{ route('guru.laporan') }}" class="menu-item {{ request()->is('guru/laporan') ? 'active' : '' }}">
                    <div class="menu-item-left">
                        <i class="bi bi-journal-text"></i>
                        <span>Kelola Laporan</span>
                    </div>
                </a>

                <a href="/respon-saya" class="menu-item {{ request()->is('respon-saya') ? 'active' : '' }}">
                    <div class="menu-item-left">
                        <i class="bi bi-chat-left-text"></i>
                        <span>Respon Saya</span>
                    </div>
                    <span class="menu-badge">
                        {{ \App\Models\Pengaduan::whereNotNull('tanggapan')->count() }}
                    </span>
                </a>

            </div>

            <div class="menu-section">
                <p class="menu-title">Data</p>

                <a href="/analisis" class="menu-item {{ request()->is('analisis') ? 'active' : '' }}">
                    <div class="menu-item-left">
                        <i class="bi bi-bar-chart"></i>
                        <span>Analisis</span>
                    </div>
                </a>

                <a href="/kelola-user" class="menu-item {{ request()->is('kelola-user') ? 'active' : '' }}">
                    <div class="menu-item-left">
                        <i class="bi bi-people"></i>
                        <span>Kelola User</span>
                    </div>
                </a>

                <a href="{{ route('kategori.index') }}" class="menu-item {{ request()->routeIs('kategori.*') ? 'active' : '' }}">
                    <div class="menu-item-left">
                        <i class="bi bi-folder2-open"></i>
                        <span>Kelola Kategori</span>
                    </div>
                </a>

            </div>

            <div class="menu-section">
                <p class="menu-title">Akun</p>

                <a href="/guru/profil" class="menu-item {{ request()->is('guru/profil') ? 'active' : '' }}">
                    <div class="menu-item-left">
                        <i class="bi bi-person"></i>
                        <span>Profil</span>
                    </div>
                </a>

            </div>

        </div>

        <!-- FOOTER -->
        <div class="sidebar-footer">
            <div class="footer-user">
                <div class="footer-avatar">
                    @if(auth()->user()->foto)
                        <img src="{{ asset('storage/' . auth()->user()->foto) }}"
                             alt="Foto" class="avatar-img">
                    @else
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    @endif
                </div>
                <div style="min-width:0;">
                    <div class="footer-name">{{ auth()->user()->name }}</div>
                    <div class="footer-role">Guru BK</div>
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

let sidebarOpen = isDesktop();
applyState();

navbarToggle.addEventListener('click', () => {
    sidebarOpen = !sidebarOpen;
    applyState();
});

overlay.addEventListener('click', () => {
    sidebarOpen = false;
    applyState();
});

document.querySelectorAll('.menu-item').forEach(item => {
    item.addEventListener('click', () => {
        if (!isDesktop()) {
            sidebarOpen = false;
            applyState();
        }
    });
});

function applyState(){
    if (isDesktop()) {
        overlay.classList.remove('show');
        sidebar.classList.remove('show');
        sidebarOpen
            ? sidebar.classList.remove('collapsed')
            : sidebar.classList.add('collapsed');
    } else {
        sidebar.classList.remove('collapsed');
        sidebarOpen
            ? sidebar.classList.add('show')
            : sidebar.classList.remove('show');
        /* Tidak tambah overlay.show → tidak ada gelap */
    }
}

let lastBreakpoint = isDesktop();
window.addEventListener('resize', () => {
    const nowDesktop = isDesktop();
    if (nowDesktop !== lastBreakpoint) {
        lastBreakpoint = nowDesktop;
        sidebarOpen = nowDesktop;
        applyState();
    }
});

</script>

</body>
</html>