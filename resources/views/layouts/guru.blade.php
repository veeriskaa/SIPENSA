<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('title','Dashboard Guru BK')</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Suez+One&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<style>

/* =========================================================
   ROOT
========================================================= */

:root{
    --green: #0b6b27;
    --green-dark: #064d14;
    --green-mid: #0b6b1c;
    --navbar-height: 72px;
    --sidebar-width: 245px;
}

/* =========================================================
   RESET
========================================================= */

*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html, body{
    height: 100%;
    overflow: hidden;
}

/* =========================================================
   BODY
========================================================= */

body{
    background: #f4f7fb;
    font-family: 'Inter', sans-serif;
    color: #111827;
}

/* =========================================================
   NAVBAR
========================================================= */

.navbar{
    height: var(--navbar-height);

    background: linear-gradient(135deg, #0b6b27, #0f7a2d);

    position: fixed;
    top: 0;
    left: 0;
    width: 100%;

    z-index: 1100;

    display: flex;
    align-items: center;

    box-shadow: 0 2px 15px rgba(0,0,0,.06);

    padding: 0 16px;
}

.navbar-brand{
    display: flex;
    align-items: center;
    gap: 12px;

    color: white !important;

    font-family: 'Suez One', serif;
    font-size: 20px;

    text-decoration: none;

    cursor: pointer;
    user-select: none;
}

.navbar-brand img{
    width: 42px;
    flex-shrink: 0;
}

.navbar-brand span{
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* =========================================================
   OVERLAY
========================================================= */

.sidebar-overlay{
    display: none;

    position: fixed;
    inset: 0;

    background: rgba(0,0,0,.45);

    z-index: 1080;
}

.sidebar-overlay.show{
    display: block;
}

/* =========================================================
   SIDEBAR
========================================================= */

.sidebar{
    width: var(--sidebar-width);

    position: fixed;

    top: var(--navbar-height);
    left: 0;
    bottom: 0;

    background: linear-gradient(180deg, var(--green-mid), var(--green-dark));

    display: flex;
    flex-direction: column;

    z-index: 1095;

    transition: left .3s ease, width .3s ease;
}

/* Desktop collapsed */
.sidebar.collapsed{
    left: calc(-1 * var(--sidebar-width));
}

/* SCROLLBAR */

.sidebar-menu{
    flex: 1;
    overflow-y: auto;
    padding: 18px 14px;
}

.sidebar-menu::-webkit-scrollbar{
    width: 4px;
}

.sidebar-menu::-webkit-scrollbar-thumb{
    background: rgba(255,255,255,.15);
    border-radius: 20px;
}

/* =========================================================
   SIDEBAR TITLE
========================================================= */

.sidebar-title{
    font-size: 11px;
    color: rgba(255,255,255,.5);
    font-weight: 700;
    letter-spacing: .8px;
    margin: 6px 12px 12px;
    text-transform: uppercase;
}

/* =========================================================
   SIDEBAR LINK
========================================================= */

.sidebar a{
    display: flex;
    align-items: center;
    justify-content: space-between;

    text-decoration: none;

    padding: 11px 13px;
    border-radius: 14px;
    margin-bottom: 6px;

    transition: .25s;

    color: rgba(255,255,255,.9);

    font-size: 13.5px;
    font-weight: 500;
}

.sidebar .left{
    display: flex;
    align-items: center;
    gap: 11px;
}

.sidebar i{
    font-size: 16px;
    flex-shrink: 0;
}

.sidebar a:hover{
    background: rgba(255,255,255,.08);
    color: white;
    transform: translateX(2px);
}

.sidebar a.active{
    background: white;
    color: var(--green);
    font-weight: 600;
    box-shadow: 0 10px 20px rgba(0,0,0,.08);
}

/* =========================================================
   BADGE
========================================================= */

.menu-badge{
    background: #84cc16;
    color: #111827;
    font-size: 10px;
    font-weight: 700;
    padding: 3px 8px;
    border-radius: 30px;
    flex-shrink: 0;
}

/* =========================================================
   SIDEBAR FOOTER
========================================================= */

.sidebar-footer{
    padding: 14px;
    border-top: 1px solid rgba(255,255,255,.08);
    background: rgba(0,0,0,.05);
}

.footer-user{
    display: flex;
    align-items: center;
    gap: 12px;
}

.footer-avatar{
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background: #22c55e;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: 15px;
    flex-shrink: 0;
}

.avatar-img{
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
}

.footer-name{
    color: white;
    font-size: 13px;
    font-weight: 600;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.footer-user small{
    color: rgba(255,255,255,.75);
    font-size: 12px;
    display: block;
    margin-top: 2px;
}

/* =========================================================
   CONTENT
========================================================= */

.content{
    position: fixed;

    top: var(--navbar-height);
    left: var(--sidebar-width);
    right: 0;
    bottom: 0;

    overflow-y: auto;
    overflow-x: hidden;

    padding: 24px;

    background: #f4f7fb;

    transition: left .3s ease;
}

/* Desktop collapsed */
.content.expanded{
    left: 0;
}

/* SCROLLBAR */

.content::-webkit-scrollbar{
    width: 6px;
}

.content::-webkit-scrollbar-thumb{
    background: #d1d5db;
    border-radius: 20px;
}

.content > *:last-child{
    margin-bottom: 40px;
}

/* =========================================================
   CARDS
========================================================= */

.dashboard-header,
.card-box{
    background: white;
    border-radius: 24px;
    border: 1px solid #edf0f2;
    box-shadow: 0 5px 18px rgba(15,23,42,.04);
}

.dashboard-header{
    padding: 24px;
    margin-bottom: 22px;
}

.card-box{
    padding: 24px;
    margin-bottom: 18px;
}

/* =========================================================
   MISC
========================================================= */

h1,h2,h3,h4,h5{
    color: #111827;
}

p{
    margin-bottom: 0;
}

.profile-img{
    width: 110px;
    height: 110px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #dcfce7;
}

/* =========================================================
   RESPONSIVE — TABLET (769px – 1024px)
========================================================= */

@media(min-width:769px) and (max-width:1024px){

    :root{
        --sidebar-width: 210px;
    }

    .navbar-brand{
        font-size: 17px;
    }

    .navbar-brand img{
        width: 36px;
    }

    .sidebar a{
        font-size: 13px;
        padding: 10px 12px;
    }

    .sidebar-title{
        font-size: 10px;
    }

    .footer-avatar{
        width: 36px;
        height: 36px;
        font-size: 13px;
    }

    .footer-name{
        font-size: 12px;
    }

    .content{
        padding: 18px;
    }

    .dashboard-header,
    .card-box{
        padding: 18px;
        border-radius: 20px;
    }

    h2,h3,h4{
        font-size: 18px !important;
    }

    /* Tablet: sidebar tersembunyi, toggle via logo */
    .sidebar{
        left: calc(-1 * var(--sidebar-width));
    }

    .sidebar.show{
        left: 0;
    }

    .content{
        left: 0;
    }

}

/* =========================================================
   RESPONSIVE — MOBILE (≤ 768px)
========================================================= */

@media(max-width:768px){

    .navbar-brand{
        font-size: 15px;
    }

    .navbar-brand img{
        width: 32px;
    }

    /* Sidebar tersembunyi */
    .sidebar{
        left: -100%;
        width: 230px;
    }

    .sidebar.show{
        left: 0;
    }

    /* Content full width */
    .content{
        left: 0;
        padding: 14px;
    }

    .dashboard-header,
    .card-box{
        border-radius: 16px;
        padding: 16px;
    }

    h2,h3,h4{
        font-size: 18px !important;
    }

    h5{
        font-size: 16px !important;
    }

    .profile-img{
        width: 80px;
        height: 80px;
    }

    /* Tabel scroll horizontal */
    .table-responsive{
        border-radius: 12px;
    }

}

/* =========================================================
   RESPONSIVE — SMALL MOBILE (≤ 400px)
========================================================= */

@media(max-width:400px){

    .navbar-brand{
        font-size: 13px;
    }

    .navbar-brand img{
        width: 28px;
    }

    .content{
        padding: 10px;
    }

    .dashboard-header,
    .card-box{
        padding: 14px;
        border-radius: 14px;
    }

    h2,h3,h4,h5{
        font-size: 16px !important;
    }

}

</style>

</head>

<body>

<!-- NAVBAR — logo = toggle sidebar -->
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid px-3">

        <div class="navbar-brand" id="navbarToggle" role="button" aria-label="Toggle sidebar">
            <img src="/logo.png" alt="Logo">
            <span>eLapor SMKN 2 Marabahan</span>
        </div>

    </div>
</nav>

<!-- OVERLAY -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- SIDEBAR -->
<div class="sidebar" id="sidebar">

    <!-- MENU -->
    <div class="sidebar-menu">

        <div class="sidebar-title">Utama</div>

        <a href="/guru"
           class="{{ request()->is('guru') ? 'active' : '' }}">
            <div class="left">
                <i class="bi bi-grid"></i>
                Dashboard
            </div>
        </a>

        <a href="{{ route('guru.laporan') }}"
           class="{{ request()->is('guru/laporan') ? 'active' : '' }}">
            <div class="left">
                <i class="bi bi-journal-text"></i>
                Kelola Laporan
            </div>
        </a>

        <a href="/respon-saya"
           class="{{ request()->is('respon-saya') ? 'active' : '' }}">
            <div class="left">
                <i class="bi bi-chat-left-text"></i>
                Respon Saya
            </div>
            <span class="menu-badge">
                {{ \App\Models\Pengaduan::whereNotNull('tanggapan')->count() }}
            </span>
        </a>

        <div class="sidebar-title mt-3">Data</div>

        <a href="/analisis"
           class="{{ request()->is('analisis') ? 'active' : '' }}">
            <div class="left">
                <i class="bi bi-bar-chart"></i>
                Analisis
            </div>
        </a>

        <a href="/kelola-user"
           class="{{ request()->is('kelola-user') ? 'active' : '' }}">
            <div class="left">
                <i class="bi bi-people"></i>
                Kelola User
            </div>
        </a>

        <a href="{{ route('kategori.index') }}"
           class="{{ request()->routeIs('kategori.*') ? 'active' : '' }}">
            <div class="left">
                <i class="bi bi-folder2-open"></i>
                Kelola Kategori
            </div>
        </a>

        <a href="/guru/profil"
           class="{{ request()->is('guru/profil') ? 'active' : '' }}">
            <div class="left">
                <i class="bi bi-person"></i>
                Profil
            </div>
        </a>

    </div>

    <!-- FOOTER SIDEBAR -->
    <div class="sidebar-footer">
        <div class="footer-user">

            <div class="footer-avatar">
                @if(auth()->user()->foto)
                    <img src="{{ asset('storage/' . auth()->user()->foto) }}"
                         alt="Foto Profil"
                         class="avatar-img">
                @else
                    {{ strtoupper(substr(auth()->user()->name,0,1)) }}
                @endif
            </div>

            <div style="min-width:0;">
                <div class="footer-name">{{ auth()->user()->name }}</div>
                <small>{{ auth()->user()->role }}</small>
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

const sidebar      = document.getElementById('sidebar');
const overlay      = document.getElementById('sidebarOverlay');
const navbarToggle = document.getElementById('navbarToggle');
const mainContent  = document.getElementById('mainContent');

/* =========================================================
   HELPER
========================================================= */

function isDesktop(){
    return window.innerWidth > 1024;
}

/* State: desktop default terbuka, mobile/tablet tertutup */
let sidebarOpen = isDesktop();

applyState();

/* =========================================================
   TOGGLE — klik logo
========================================================= */

navbarToggle.addEventListener('click', () => {
    sidebarOpen = !sidebarOpen;
    applyState();
});

/* Tutup via overlay */
overlay.addEventListener('click', () => {
    sidebarOpen = false;
    applyState();
});

/* Tutup saat klik menu (mobile/tablet) */
document.querySelectorAll('.sidebar a').forEach(link => {
    link.addEventListener('click', () => {
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

        overlay.classList.remove('show');
        sidebar.classList.remove('show');

        if(sidebarOpen){
            sidebar.classList.remove('collapsed');
            mainContent.classList.remove('expanded');
        } else {
            sidebar.classList.add('collapsed');
            mainContent.classList.add('expanded');
        }

    } else {

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
}

/* Reset saat resize */
window.addEventListener('resize', () => {
    sidebarOpen = isDesktop();
    applyState();
});

</script>

</body>
</html>