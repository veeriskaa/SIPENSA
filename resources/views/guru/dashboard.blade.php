@extends('layouts.guru')

@section('title','Dashboard Guru BK')

@section('content')

<style>

@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

:root{
    --g1: #0a7f2e;
    --g2: #16a34a;
    --g3: #22c55e;
    --border: #e8edf0;
    --text: #111827;
    --soft: #6b7280;
    --surface: #ffffff;
    --bg: #f4f7f5;
}

.db * { box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }

.db {
    height: 100%;
    display: flex;
    flex-direction: column;
    gap: 14px;
    animation: dbFade .35s ease both;
}

@keyframes dbFade {
    from { opacity:0; transform:translateY(8px); }
    to   { opacity:1; transform:translateY(0); }
}

/* =============================================
   TOPBAR
============================================= */
.db-topbar {
    flex-shrink: 0;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 18px;
    padding: 16px 22px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 14px;
    box-shadow: 0 2px 10px rgba(15,23,42,.04);
    flex-wrap: wrap;
}

.topbar-left h2 { font-size: 19px; font-weight: 800; color: var(--text); margin: 0 0 2px; letter-spacing: -.3px; }
.topbar-left p  { font-size: 12px; color: var(--soft); margin: 0; }
.topbar-right   { display: flex; align-items: center; gap: 10px; }

.date-chip {
    display: flex; align-items: center; gap: 7px;
    background: #f4f7f5; border: 1px solid var(--border);
    border-radius: 10px; padding: 8px 13px;
    font-size: 12px; color: #4b5563; font-weight: 500; white-space: nowrap;
}
.date-chip i { color: var(--g2); }

.notif-btn {
    width: 40px; height: 40px; border-radius: 11px;
    border: 1px solid var(--border); background: var(--surface);
    display: flex; align-items: center; justify-content: center;
    color: #374151; text-decoration: none; position: relative;
    transition: .2s; font-size: 16px; cursor: pointer;
}
.notif-btn:hover { background: #f4f7f5; color: var(--g1); }

.notif-count {
    position: absolute; top: -4px; right: -4px;
    width: 17px; height: 17px; border-radius: 50%;
    background: #ef4444; color: white;
    font-size: 9px; font-weight: 700;
    display: flex; align-items: center; justify-content: center;
    border: 2px solid white;
}

.notif-dropdown {
    width: 300px; border-radius: 16px;
    border: 1px solid var(--border);
    box-shadow: 0 10px 30px rgba(15,23,42,.1);
    padding: 8px 0; overflow: hidden;
}

.profile-img {
    width: 40px; height: 40px; border-radius: 11px;
    object-fit: cover; border: 2px solid var(--border);
    transition: .2s; cursor: pointer;
}
.profile-img:hover { border-color: var(--g2); transform: scale(1.05); }

/* =============================================
   SCROLL
============================================= */
.db-scroll {
    flex: 1; overflow-y: auto; overflow-x: hidden;
    min-height: 0; display: flex; flex-direction: column;
    gap: 14px; padding-bottom: 24px;
    scrollbar-width: thin; scrollbar-color: #e5e7eb transparent;
}
.db-scroll::-webkit-scrollbar { width: 5px; }
.db-scroll::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 20px; }

/* =============================================
   HERO
============================================= */
.db-hero {
    background: linear-gradient(135deg, #0b6b27 0%, var(--g2) 55%, var(--g3) 100%);
    border-radius: 18px; padding: 22px 26px; color: white;
    display: flex; justify-content: space-between; align-items: center;
    gap: 16px; position: relative; overflow: hidden;
}
.db-hero::before { content:''; position:absolute; width:200px; height:200px; border-radius:50%; background:rgba(255,255,255,.06); top:-70px; right:-30px; }
.db-hero::after  { content:''; position:absolute; width:120px; height:120px; border-radius:50%; background:rgba(255,255,255,.05); bottom:-40px; right:120px; }
.hero-text { position:relative; z-index:1; }
.hero-text h3 { font-size:17px; font-weight:800; margin:0 0 4px; }
.hero-text p  { font-size:12.5px; opacity:.85; margin:0; }
.hero-action  { position:relative; z-index:1; flex-shrink:0; }
.btn-hero {
    display:inline-flex; align-items:center; gap:7px;
    padding:10px 18px; border-radius:12px; background:white;
    color:var(--g1); font-size:13px; font-weight:700;
    text-decoration:none; transition:.2s;
    box-shadow:0 4px 14px rgba(0,0,0,.12);
}
.btn-hero:hover { transform:translateY(-2px); color:var(--g1); }

/* =============================================
   QUICK ACTIONS
============================================= */
.quick-actions {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 10px;
}

.qa-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 16px;
    background: white;
    border: 1px solid var(--border);
    border-radius: 14px;
    text-decoration: none;
    transition: .2s;
    box-shadow: 0 2px 6px rgba(15,23,42,.03);
}

.qa-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(15,23,42,.07);
    border-color: #bbf7d0;
}

.qa-icon {
    width: 38px; height: 38px;
    border-radius: 11px;
    display: flex; align-items: center; justify-content: center;
    font-size: 17px; flex-shrink: 0;
}

.qa-green  { background: #dcfce7; color: var(--g1); }
.qa-amber  { background: #fef3c7; color: #b45309; }
.qa-blue   { background: #dbeafe; color: #1d4ed8; }
.qa-purple { background: #f3e8ff; color: #7c3aed; }

.qa-label { font-size: 12.5px; font-weight: 700; color: var(--text); margin: 0 0 1px; }
.qa-sub   { font-size: 11px; color: var(--soft); margin: 0; }

/* =============================================
   METRICS
============================================= */
.metrics-row { display: grid; grid-template-columns: repeat(4,1fr); gap: 12px; }

.metric-card {
    background: var(--surface); border: 1px solid var(--border);
    border-radius: 16px; padding: 18px; transition: .2s;
    box-shadow: 0 2px 8px rgba(15,23,42,.03);
    position: relative; overflow: hidden;
}
.metric-card::before {
    content:''; position:absolute; top:0; left:0;
    width:4px; height:100%; border-radius:4px 0 0 4px;
}
.metric-card.mc-green::before { background:var(--g2); }
.metric-card.mc-red::before   { background:#ef4444; }
.metric-card.mc-amber::before { background:#f59e0b; }
.metric-card.mc-blue::before  { background:#3b82f6; }
.metric-card:hover { transform:translateY(-3px); box-shadow:0 10px 24px rgba(15,23,42,.07); }

.metric-top { display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:12px; }
.metric-icon { width:40px; height:40px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:17px; flex-shrink:0; }
.ic-green  { background:#dcfce7; color:var(--g1); }
.ic-red    { background:#fee2e2; color:#dc2626; }
.ic-amber  { background:#fef3c7; color:#b45309; }
.ic-blue   { background:#dbeafe; color:#1d4ed8; }

.metric-num   { font-size:28px; font-weight:800; line-height:1; margin-bottom:3px; color:var(--text); }
.metric-label { font-size:12px; color:var(--soft); font-weight:500; }

/* =============================================
   PROGRESS + PENDING
============================================= */
.mid-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }

.prog-card, .pending-card {
    background: white; border: 1px solid var(--border);
    border-radius: 16px; padding: 20px;
    box-shadow: 0 2px 8px rgba(15,23,42,.03);
}

.card-title-row {
    display: flex; justify-content: space-between; align-items: center;
    margin-bottom: 16px; padding-bottom: 12px;
    border-bottom: 1px solid #f3f4f6;
}
.card-title { font-size: 14px; font-weight: 700; color: var(--text); display: flex; align-items: center; gap: 7px; }
.card-title i { color: var(--g2); }
.card-badge { font-size: 12px; font-weight: 700; color: var(--g1); }

/* Progress bars */
.prog-list { display: flex; flex-direction: column; gap: 12px; }

.prog-item-label {
    display: flex; justify-content: space-between; align-items: center;
    margin-bottom: 5px;
}
.prog-item-label span:first-child { font-size: 12.5px; font-weight: 600; color: var(--text); }
.prog-item-label span:last-child  { font-size: 11px; font-weight: 700; }

.prog-bar-bg { height: 7px; background: #f3f4f6; border-radius: 99px; overflow: hidden; }
.prog-bar-fill { height: 100%; border-radius: 99px; transition: width .8s ease; }

/* Pending list */
.pending-list { display: flex; flex-direction: column; gap: 8px; }

.pending-item {
    display: flex; align-items: center; gap: 10px;
    padding: 10px 12px; border-radius: 12px;
    background: #fef2f2; border: 1px solid #fecaca;
    transition: .2s;
}
.pending-item:hover { background: #fee2e2; }

.pending-dot {
    width: 8px; height: 8px; border-radius: 50%;
    background: #ef4444; flex-shrink: 0;
    animation: pendingPulse 2s infinite;
}
@keyframes pendingPulse { 0%,100%{opacity:1;}50%{opacity:.4;} }

.pending-info { flex: 1; min-width: 0; }
.pending-judul { font-size: 12.5px; font-weight: 700; color: #991b1b; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
.pending-meta  { font-size: 11px; color: #b91c1c; margin-top: 1px; }

.pending-link {
    font-size: 11px; font-weight: 600; color: #dc2626;
    text-decoration: none; white-space: nowrap;
    padding: 4px 8px; border-radius: 7px;
    background: rgba(220,38,38,.1);
    transition: .2s;
}
.pending-link:hover { background: #dc2626; color: white; }

.empty-pending {
    text-align: center; padding: 20px; color: #9ca3af; font-size: 13px;
}
.empty-pending i { font-size: 24px; display: block; margin-bottom: 6px; color: #d1d5db; }

/* =============================================
   CHART GRID
============================================= */
.chart-grid { display: grid; grid-template-columns: 1.4fr 1fr; gap: 14px; }

.chart-card {
    background: var(--surface); border: 1px solid var(--border);
    border-radius: 16px; padding: 20px;
    box-shadow: 0 2px 8px rgba(15,23,42,.03); overflow: hidden;
}
.chart-card-head { margin-bottom: 14px; padding-bottom: 12px; border-bottom: 1px solid #f3f4f6; }
.chart-card-head h5 { font-size: 14px; font-weight: 700; color: var(--text); margin: 0 0 2px; }
.chart-card-head p  { font-size: 11.5px; color: var(--soft); margin: 0; }

.chart-wrap { position: relative; width: 100%; height: 200px; }
.chart-wrap canvas { width: 100% !important; height: 100% !important; }

/* =============================================
   BOTTOM ROW: TABLE + ACTIVITY
============================================= */
.bottom-row { display: grid; grid-template-columns: 1fr 340px; gap: 14px; align-items: start; }

/* TABLE */
.table-card {
    background: var(--surface); border: 1px solid var(--border);
    border-radius: 16px; overflow: hidden;
    box-shadow: 0 2px 8px rgba(15,23,42,.03);
}
.table-head {
    display: flex; justify-content: space-between; align-items: center;
    padding: 16px 20px; border-bottom: 1px solid #f3f4f6;
}
.table-head h5 { font-size: 14px; font-weight: 700; color: var(--text); margin: 0; }
.table-head small { font-size: 11.5px; color: var(--soft); }

.btn-see-all {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 7px 14px; border-radius: 10px;
    border: 1.5px solid var(--g2); color: var(--g2);
    background: white; font-size: 12px; font-weight: 600;
    text-decoration: none; transition: .2s;
}
.btn-see-all:hover { background: var(--g2); color: white; }

.table { margin: 0; }
.table thead th {
    background: #f9fafb; border: none;
    font-size: 11px; font-weight: 700; color: #9ca3af;
    text-transform: uppercase; letter-spacing: .5px;
    padding: 11px 14px; white-space: nowrap;
}
.table tbody td {
    padding: 12px 14px; border-top: 1px solid #f3f4f6;
    font-size: 13px; vertical-align: middle; color: var(--text);
}
.table tbody tr:hover { background: #fafcfa; }
.judul-cell { font-weight: 600; max-width: 160px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
.kategori-pill {
    display: inline-flex; align-items: center; gap: 4px;
    background: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0;
    padding: 3px 9px; border-radius: 30px; font-size: 10.5px; font-weight: 500;
}
.s-badge { padding: 4px 10px; border-radius: 20px; font-size: 10.5px; font-weight: 700; }
.s-pending { background: #fee2e2; color: #dc2626; }
.s-proses  { background: #fef3c7; color: #b45309; }
.s-selesai { background: #dcfce7; color: #15803d; }
.btn-action {
    display: inline-flex; align-items: center; justify-content: center;
    width: 28px; height: 28px; border-radius: 8px;
    border: 1px solid var(--border); background: white;
    color: var(--g1); text-decoration: none; font-size: 12px; transition: .2s;
}
.btn-action:hover { background: var(--g1); color: white; border-color: var(--g1); }

/* ACTIVITY FEED */
.activity-card {
    background: white; border: 1px solid var(--border);
    border-radius: 16px; overflow: hidden;
    box-shadow: 0 2px 8px rgba(15,23,42,.03);
}
.activity-head {
    display: flex; justify-content: space-between; align-items: center;
    padding: 16px 18px; border-bottom: 1px solid #f3f4f6;
}
.activity-head h5 { font-size: 14px; font-weight: 700; color: var(--text); margin: 0; }
.activity-head small { font-size: 11px; color: var(--soft); }

.activity-body { padding: 12px 16px; }

.activity-item {
    display: flex; gap: 10px; align-items: flex-start;
    padding: 10px 0; border-bottom: 1px solid #f9fafb;
    animation: fadeUp .3s ease both;
}
.activity-item:last-child { border-bottom: none; }

@keyframes fadeUp { from{opacity:0;transform:translateY(4px);} to{opacity:1;transform:translateY(0);} }

.act-avatar {
    width: 32px; height: 32px; border-radius: 10px;
    background: linear-gradient(135deg, var(--g1), var(--g2));
    color: white; display: flex; align-items: center;
    justify-content: center; font-size: 13px; font-weight: 700;
    flex-shrink: 0;
}

.act-info { flex: 1; min-width: 0; }
.act-name { font-size: 12.5px; font-weight: 700; color: var(--text); margin: 0 0 2px; }
.act-desc { font-size: 11.5px; color: var(--soft); margin: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
.act-time { font-size: 10.5px; color: #9ca3af; margin-top: 2px; }

.act-badge {
    padding: 3px 8px; border-radius: 20px; font-size: 10px; font-weight: 700;
    flex-shrink: 0; margin-top: 2px;
}
.act-pending { background: #fee2e2; color: #dc2626; }
.act-proses  { background: #fef3c7; color: #b45309; }
.act-selesai { background: #dcfce7; color: #15803d; }

.empty-activity { text-align: center; padding: 28px 16px; color: #9ca3af; font-size: 13px; }
.empty-activity i { font-size: 26px; display: block; margin-bottom: 8px; color: #e5e7eb; }

/* =============================================
   RESPONSIVE
============================================= */
@media (max-width: 1200px) {
    .bottom-row { grid-template-columns: 1fr; }
    .quick-actions { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 1100px) {
    .metrics-row { grid-template-columns: repeat(2,1fr); }
    .chart-grid  { grid-template-columns: 1fr; }
    .mid-row     { grid-template-columns: 1fr; }
}

@media (max-width: 768px) {
    .db { gap: 12px; }
    .db-topbar { padding: 12px 16px; border-radius: 14px; }
    .topbar-left h2 { font-size: 16px; }
    .date-chip { display: none; }
    .db-hero { padding: 16px 18px; border-radius: 14px; }
    .db-hero::before, .db-hero::after { display: none; }
    .hero-text h3 { font-size: 14px; }
    .hero-action { display: none; }
    .quick-actions { grid-template-columns: repeat(2,1fr); gap: 8px; }
    .qa-item { padding: 12px; }
    .qa-icon { width: 32px; height: 32px; font-size: 15px; }
    .metrics-row { grid-template-columns: repeat(2,1fr); gap: 8px; }
    .metric-card { padding: 14px 12px; }
    .metric-num { font-size: 22px; }
    .chart-wrap { height: 170px; }
    .bottom-row { grid-template-columns: 1fr; }
}

</style>

<div class="db">

    {{-- TOPBAR FIX --}}
    <div class="db-topbar">
        <div class="topbar-left">
            <h2>Dashboard Guru BK</h2>
            <p>Ringkasan laporan siswa & aktivitas terbaru</p>
        </div>
        <div class="topbar-right">
            <div class="date-chip">
                <i class="bi bi-calendar3"></i>
                {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
            </div>

            <div class="dropdown">
                <a href="#" class="notif-btn" data-bs-toggle="dropdown"
                   aria-expanded="false" onclick="markNotifRead()">
                    <i class="bi bi-bell"></i>
                    <span id="notif-count" class="notif-count" style="display:none;">0</span>
                </a>
                <ul id="notif-list" class="dropdown-menu dropdown-menu-end notif-dropdown">
                    <li><span class="dropdown-item-text text-muted" style="font-size:13px;">Memuat...</span></li>
                </ul>
            </div>

            <a href="/guru/profil">
                <img src="{{ auth()->user()->foto
                    ? asset('storage/' . auth()->user()->foto)
                    : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}"
                    class="profile-img" alt="Profil">
            </a>
        </div>
    </div>

    {{-- SCROLL --}}
    <div class="db-scroll">

        {{-- HERO --}}
        <div class="db-hero">
            <div class="hero-text">
                <h3>Selamat datang, {{ auth()->user()->name }} 👋</h3>
                <p>Pantau dan tangani laporan siswa dengan cepat & tepat</p>
            </div>
            <div class="hero-action">
                <a href="/guru/laporan" class="btn-hero">
                    <i class="bi bi-journal-text"></i>
                    Kelola Laporan
                </a>
            </div>
        </div>

        {{-- QUICK ACTIONS --}}
        <div class="quick-actions">
            <a href="/guru/laporan" class="qa-item">
                <div class="qa-icon qa-green"><i class="bi bi-journal-text"></i></div>
                <div>
                    <p class="qa-label">Kelola Laporan</p>
                    <p class="qa-sub">Semua laporan masuk</p>
                </div>
            </a>
            <a href="/respon-saya" class="qa-item">
                <div class="qa-icon qa-amber"><i class="bi bi-chat-left-text"></i></div>
                <div>
                    <p class="qa-label">Respon Saya</p>
                    <p class="qa-sub">Laporan yang direspon</p>
                </div>
            </a>
            <a href="/analisis" class="qa-item">
                <div class="qa-icon qa-blue"><i class="bi bi-bar-chart"></i></div>
                <div>
                    <p class="qa-label">Analisis</p>
                    <p class="qa-sub">Statistik & grafik</p>
                </div>
            </a>
            <a href="/kelola-user" class="qa-item">
                <div class="qa-icon qa-purple"><i class="bi bi-people"></i></div>
                <div>
                    <p class="qa-label">Kelola User</p>
                    <p class="qa-sub">Manajemen pengguna</p>
                </div>
            </a>
        </div>

        {{-- METRICS --}}
        <div class="metrics-row">
            <div class="metric-card mc-green">
                <div class="metric-top">
                    <div class="metric-icon ic-green"><i class="bi bi-journal-text"></i></div>
                </div>
                <div class="metric-num" id="total-laporan">0</div>
                <div class="metric-label">Total Laporan</div>
            </div>
            <div class="metric-card mc-red">
                <div class="metric-top">
                    <div class="metric-icon ic-red"><i class="bi bi-exclamation-circle"></i></div>
                </div>
                <div class="metric-num" id="perlu-ditanggapi">0</div>
                <div class="metric-label">Pending</div>
            </div>
            <div class="metric-card mc-amber">
                <div class="metric-top">
                    <div class="metric-icon ic-amber"><i class="bi bi-clock-history"></i></div>
                </div>
                <div class="metric-num" id="laporan-proses">0</div>
                <div class="metric-label">Diproses</div>
            </div>
            <div class="metric-card mc-blue">
                <div class="metric-top">
                    <div class="metric-icon ic-blue"><i class="bi bi-check-circle"></i></div>
                </div>
                <div class="metric-num" id="laporan-selesai">0</div>
                <div class="metric-label">Selesai</div>
            </div>
        </div>

        {{-- PROGRESS + PENDING --}}
        <div class="mid-row">

            {{-- PROGRESS --}}
            <div class="prog-card">
                <div class="card-title-row">
                    <span class="card-title"><i class="bi bi-graph-up-arrow"></i> Progress Penyelesaian</span>
                    <span class="card-badge" id="pct-label">0%</span>
                </div>
                <div class="prog-list">
                    <div>
                        <div class="prog-item-label">
                            <span>Selesai</span>
                            <span style="color:#16a34a" id="pct-selesai">0%</span>
                        </div>
                        <div class="prog-bar-bg">
                            <div class="prog-bar-fill" id="bar-selesai" style="width:0%;background:#16a34a"></div>
                        </div>
                    </div>
                    <div>
                        <div class="prog-item-label">
                            <span>Diproses</span>
                            <span style="color:#d97706" id="pct-proses">0%</span>
                        </div>
                        <div class="prog-bar-bg">
                            <div class="prog-bar-fill" id="bar-proses" style="width:0%;background:#d97706"></div>
                        </div>
                    </div>
                    <div>
                        <div class="prog-item-label">
                            <span>Pending</span>
                            <span style="color:#dc2626" id="pct-pending">0%</span>
                        </div>
                        <div class="prog-bar-bg">
                            <div class="prog-bar-fill" id="bar-pending" style="width:0%;background:#ef4444"></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- LAPORAN PERLU PERHATIAN --}}
            <div class="pending-card">
                <div class="card-title-row">
                    <span class="card-title"><i class="bi bi-exclamation-triangle"></i> Perlu Perhatian</span>
                    <span class="card-badge" id="pending-count-label" style="color:#dc2626">0 pending</span>
                </div>
                <div class="pending-list" id="pending-list">
                    <div class="empty-pending">
                        <i class="bi bi-hourglass-split"></i>
                        Memuat...
                    </div>
                </div>
            </div>

        </div>

        {{-- CHARTS --}}
        <div class="chart-grid">
            <div class="chart-card">
                <div class="chart-card-head">
                    <h5>Statistik Mingguan</h5>
                    <p>Jumlah laporan masuk per hari</p>
                </div>
                <div class="chart-wrap"><canvas id="lineChart"></canvas></div>
            </div>
            <div class="chart-card">
                <div class="chart-card-head">
                    <h5>Kategori Laporan</h5>
                    <p>Distribusi per kategori</p>
                </div>
                <div class="chart-wrap"><canvas id="barChart"></canvas></div>
            </div>
        </div>

        {{-- BOTTOM: TABLE + ACTIVITY --}}
        <div class="bottom-row">

            {{-- TABLE --}}
            <div class="table-card">
                <div class="table-head">
                    <div>
                        <h5>Laporan Terbaru</h5>
                        <small>Laporan yang baru masuk dari siswa</small>
                    </div>
                    <a href="/guru/laporan" class="btn-see-all">
                        Lihat Semua <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Pelapor</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="laporan-table">
                            <tr><td colspan="7" class="text-center text-muted py-4">Memuat...</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- ACTIVITY FEED --}}
            <div class="activity-card">
                <div class="activity-head">
                    <h5>Aktivitas Terbaru</h5>
                    <small>Update real-time</small>
                </div>
                <div class="activity-body" id="activity-feed">
                    <div class="empty-activity">
                        <i class="bi bi-hourglass-split"></i>
                        Memuat aktivitas...
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

const CSRF = document.querySelector('meta[name="csrf-token"]')?.content || '';
let unreadCount = 0;

/* =============================================
   NOTIF
============================================= */
function loadNotif() {
    fetch('/notif')
    .then(r => r.json())
    .then(data => {
        const badge = document.getElementById('notif-count');
        unreadCount = data.jumlah || 0;
        if (unreadCount > 0) { badge.innerText = unreadCount; badge.style.display = 'flex'; }
        else { badge.style.display = 'none'; }

        let html = `<li><h6 class="dropdown-header" style="font-size:12px;font-weight:700;">Notifikasi</h6></li>`;
        if (!data.data || data.data.length === 0) {
            html += `<li><span class="dropdown-item-text" style="font-size:13px;color:#9ca3af;">Tidak ada notifikasi</span></li>`;
        } else {
            data.data.forEach(n => {
                html += `<li><a class="dropdown-item" href="#" style="font-size:13px;">${n.pesan}</a></li>`;
            });
        }
        document.getElementById('notif-list').innerHTML = html;
    }).catch(()=>{});
}

function markNotifRead() {
    if (unreadCount === 0) return;
    fetch('/notif-read', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF }
    }).then(() => {
        unreadCount = 0;
        document.getElementById('notif-count').style.display = 'none';
    }).catch(()=>{});
}

/* =============================================
   CHARTS
============================================= */
const lineChart = new Chart(document.getElementById('lineChart'), {
    type: 'line',
    data: {
        labels: ['Sen','Sel','Rab','Kam','Jum','Sab','Min'],
        datasets: [{
            data: [0,0,0,0,0,0,0],
            borderColor: '#16a34a',
            backgroundColor: 'rgba(22,163,74,0.07)',
            tension: 0.4, fill: true,
            pointRadius: 4, pointBackgroundColor: '#16a34a', borderWidth: 2,
        }]
    },
    options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            y: { grid: { color: '#f3f4f6' }, ticks: { stepSize: 5, font: { size: 11 } } },
            x: { grid: { display: false }, ticks: { font: { size: 11 } } }
        }
    }
});

const barChart = new Chart(document.getElementById('barChart'), {
    type: 'bar',
    data: {
        labels: ['Bullying','Fasilitas','Akademik','Kekerasan','Lainnya'],
        datasets: [{
            data: [0,0,0,0,0], borderRadius: 8,
            backgroundColor: ['#fee2e2','#dbeafe','#fef3c7','#f3e8ff','#f0fdf4'],
            borderColor:     ['#dc2626','#2563eb','#d97706','#7c3aed','#16a34a'],
            borderWidth: 1.5,
        }]
    },
    options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true, ticks: { precision: 0, font: { size: 11 } }, grid: { color: '#f3f4f6' } },
            x: { grid: { display: false }, ticks: { font: { size: 11 } } }
        }
    }
});

/* =============================================
   LOAD DASHBOARD
============================================= */
function loadDashboard() {
    fetch('/guru/realtime')
    .then(r => r.json())
    .then(data => {

        // Metrics
        const total   = data.total   || 0;
        const pending = data.pending || 0;
        const proses  = data.proses  || 0;
        const selesai = data.selesai || 0;

        document.getElementById('total-laporan').innerText    = total;
        document.getElementById('perlu-ditanggapi').innerText = pending;
        document.getElementById('laporan-proses').innerText   = proses;
        document.getElementById('laporan-selesai').innerText  = selesai;

        // Progress bars
        const pSelesai = total > 0 ? Math.round((selesai / total) * 100) : 0;
        const pProses  = total > 0 ? Math.round((proses  / total) * 100) : 0;
        const pPending = total > 0 ? Math.round((pending / total) * 100) : 0;

        document.getElementById('pct-label').textContent    = pSelesai + '% selesai';
        document.getElementById('pct-selesai').textContent  = pSelesai + '%';
        document.getElementById('pct-proses').textContent   = pProses  + '%';
        document.getElementById('pct-pending').textContent  = pPending + '%';

        document.getElementById('bar-selesai').style.width = pSelesai + '%';
        document.getElementById('bar-proses').style.width  = pProses  + '%';
        document.getElementById('bar-pending').style.width = pPending + '%';

        // Pending perlu perhatian
        document.getElementById('pending-count-label').textContent = pending + ' pending';
        const pendingEl = document.getElementById('pending-list');
        if (!data.laporan_pending || data.laporan_pending.length === 0) {
            pendingEl.innerHTML = `<div class="empty-pending"><i class="bi bi-check-circle"></i>Tidak ada laporan pending 🎉</div>`;
        } else {
            pendingEl.innerHTML = data.laporan_pending.slice(0,4).map(l => `
                <div class="pending-item">
                    <div class="pending-dot"></div>
                    <div class="pending-info">
                        <div class="pending-judul">${l.judul}</div>
                        <div class="pending-meta">${l.user?.name ?? '-'} · ${l.created_at}</div>
                    </div>
                    <a href="/guru/respon/${l.id}" class="pending-link">Respon</a>
                </div>
            `).join('');
        }

        // Charts
        lineChart.data.datasets[0].data = data.mingguan || [0,0,0,0,0,0,0];
        lineChart.update();

        barChart.data.datasets[0].data = [
            data.bullying  ?? 0, data.fasilitas ?? 0,
            data.akademik  ?? 0, data.kekerasan ?? 0, data.lainnya ?? 0,
        ];
        barChart.update();

        // Table laporan terbaru
        let html = '';
        if (!data.laporan || data.laporan.length === 0) {
            html = `<tr><td colspan="7" class="text-center text-muted py-4">Belum ada laporan</td></tr>`;
        } else {
            data.laporan.forEach((item, i) => {
                const badge =
                    item.status === 'pending' ? `<span class="s-badge s-pending">Pending</span>` :
                    item.status === 'proses'  ? `<span class="s-badge s-proses">Diproses</span>` :
                                               `<span class="s-badge s-selesai">Selesai</span>`;
                html += `
                    <tr>
                        <td style="color:#9ca3af;font-size:12px;">${i+1}</td>
                        <td><div class="judul-cell">${item.judul}</div></td>
                        <td><span class="kategori-pill">${item.kategori ?? '-'}</span></td>
                        <td style="font-size:12px;">${item.user?.name ?? '-'}</td>
                        <td style="font-size:11.5px;color:#9ca3af;">${item.created_at}</td>
                        <td>${badge}</td>
                        <td><a href="/guru/respon/${item.id}" class="btn-action"><i class="bi bi-eye"></i></a></td>
                    </tr>`;
            });
        }
        document.getElementById('laporan-table').innerHTML = html;

        // Activity feed
        const actEl = document.getElementById('activity-feed');
        if (!data.laporan || data.laporan.length === 0) {
            actEl.innerHTML = `<div class="empty-activity"><i class="bi bi-inbox"></i>Belum ada aktivitas</div>`;
        } else {
            actEl.innerHTML = data.laporan.slice(0,6).map(l => {
                const initial = (l.user?.name ?? 'S').charAt(0).toUpperCase();
                const badge =
                    l.status === 'pending' ? `<span class="act-badge act-pending">Pending</span>` :
                    l.status === 'proses'  ? `<span class="act-badge act-proses">Proses</span>` :
                                            `<span class="act-badge act-selesai">Selesai</span>`;
                return `
                    <div class="activity-item">
                        <div class="act-avatar">${initial}</div>
                        <div class="act-info">
                            <p class="act-name">${l.user?.name ?? 'Siswa'}</p>
                            <p class="act-desc">${l.judul}</p>
                            <p class="act-time">${l.created_at}</p>
                        </div>
                        ${badge}
                    </div>`;
            }).join('');
        }
    }).catch(()=>{});
}

loadDashboard();
loadNotif();
setInterval(loadDashboard, 5000);
setInterval(loadNotif,     5000);

</script>

@endsection