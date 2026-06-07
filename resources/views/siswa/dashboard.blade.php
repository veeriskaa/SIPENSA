@extends('layouts.siswa')

@section('title','Dashboard')

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
    gap: 16px;
    animation: dbFade .35s ease both;
}

@keyframes dbFade {
    from { opacity:0; transform:translateY(8px); }
    to   { opacity:1; transform:translateY(0); }
}

/* =========================================================
   TOPBAR
========================================================= */
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
}

.topbar-left h2 {
    font-size: 20px;
    font-weight: 800;
    color: var(--text);
    margin: 0 0 2px;
    letter-spacing: -.3px;
}

.topbar-left p { font-size: 12.5px; color: var(--soft); margin: 0; }

.topbar-right { display: flex; align-items: center; gap: 10px; }

.date-chip {
    display: flex;
    align-items: center;
    gap: 7px;
    background: #f4f7f5;
    border: 1px solid var(--border);
    border-radius: 10px;
    padding: 8px 13px;
    font-size: 12px;
    color: #4b5563;
    font-weight: 500;
    white-space: nowrap;
}

.date-chip i { color: var(--g2); }

/* NOTIF BUTTON */
.notif-btn {
    width: 40px; height: 40px;
    border-radius: 11px;
    border: 1px solid var(--border);
    background: var(--surface);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #374151;
    text-decoration: none;
    position: relative;
    transition: .2s;
    font-size: 16px;
    cursor: pointer;
}

.notif-btn:hover { background: #f4f7f5; color: var(--g1); }

.notif-dot {
    position: absolute;
    top: -4px; right: -4px;
    width: 17px; height: 17px;
    border-radius: 50%;
    background: #ef4444;
    color: white;
    font-size: 9px;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid white;
}

.profile-img {
    width: 40px; height: 40px;
    border-radius: 11px;
    object-fit: cover;
    border: 2px solid var(--border);
    transition: .2s;
}

.profile-img:hover { border-color: var(--g2); transform: scale(1.05); }

.notif-dropdown {
    width: 300px;
    border-radius: 16px;
    border: 1px solid var(--border);
    box-shadow: 0 10px 30px rgba(15,23,42,.1);
    padding: 8px 0;
    overflow: hidden;
}

/* =========================================================
   SCROLL
========================================================= */
.db-scroll {
    flex: 1;
    overflow-y: auto;
    overflow-x: hidden;
    display: flex;
    flex-direction: column;
    gap: 16px;
    padding-right: 2px;
    min-height: 0;
}

.db-scroll::-webkit-scrollbar { width: 5px; }
.db-scroll::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 20px; }

/* =========================================================
   HERO
========================================================= */
.db-hero {
    background: linear-gradient(135deg, var(--g1) 0%, var(--g2) 55%, var(--g3) 100%);
    border-radius: 18px;
    padding: 22px 26px;
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 16px;
    position: relative;
    overflow: hidden;
}

.db-hero::before {
    content: '';
    position: absolute;
    width: 200px; height: 200px;
    border-radius: 50%;
    background: rgba(255,255,255,.06);
    top: -70px; right: -30px;
}

.db-hero::after {
    content: '';
    position: absolute;
    width: 120px; height: 120px;
    border-radius: 50%;
    background: rgba(255,255,255,.05);
    bottom: -40px; right: 120px;
}

.hero-text { position: relative; z-index: 1; }
.hero-text h3 { font-size: 17px; font-weight: 800; margin: 0 0 4px; letter-spacing: -.2px; }
.hero-text p  { font-size: 12.5px; opacity: .85; margin: 0; }

.hero-action { position: relative; z-index: 1; flex-shrink: 0; }

.btn-lapor {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 10px 18px;
    border-radius: 12px;
    background: white;
    color: var(--g1);
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    transition: .2s;
    box-shadow: 0 4px 14px rgba(0,0,0,.12);
}

.btn-lapor:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(0,0,0,.15); color: var(--g1); }

/* =========================================================
   METRICS
========================================================= */
.metrics-row { display: grid; grid-template-columns: repeat(3,1fr); gap: 12px; }

.metric-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 18px;
    transition: .2s;
    box-shadow: 0 2px 8px rgba(15,23,42,.03);
}

.metric-card:hover { transform: translateY(-3px); box-shadow: 0 10px 24px rgba(15,23,42,.07); }

.metric-top { display: flex; justify-content: space-between; align-items: flex-start; gap: 10px; margin-bottom: 12px; }

.metric-icon { width: 42px; height: 42px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0; }

.ic-green { background: #dcfce7; color: var(--g1); }
.ic-amber { background: #fef3c7; color: #b45309; }
.ic-blue  { background: #dbeafe; color: #1d4ed8; }
.ic-purple { background: #f3e8ff; color: #7c3aed; }

.metric-label { font-size: 11.5px; color: var(--soft); font-weight: 500; margin-bottom: 4px; }
.metric-num   { font-size: 30px; font-weight: 800; line-height: 1; margin-bottom: 4px; }
.metric-sub   { font-size: 11px; color: #9ca3af; }

.mn-green  { color: var(--g1); }
.mn-amber  { color: #d97706; }
.mn-blue   { color: #2563eb; }

/* =========================================================
   PROGRESS
========================================================= */
.db-progress {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 18px 20px;
    box-shadow: 0 2px 8px rgba(15,23,42,.03);
}

.prog-head { display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; }
.prog-label { font-size: 13px; font-weight: 600; color: var(--text); display: flex; align-items: center; gap: 7px; }
.prog-label i { color: var(--g2); }
.prog-pct { font-size: 13px; font-weight: 700; color: var(--g1); }
.prog-bar-wrap { height: 8px; background: #e8f5eb; border-radius: 99px; overflow: hidden; }
.prog-bar-fill { height: 100%; background: linear-gradient(90deg,var(--g1),var(--g3)); border-radius: 99px; transition: width .8s ease; }

/* =========================================================
   CONTENT GRID
========================================================= */
.db-content { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }

.db-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(15,23,42,.03);
}

.db-card-head {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px 18px;
    border-bottom: 1px solid #f1f5f2;
}

.db-card-head-left h5 { font-size: 14px; font-weight: 700; color: var(--text); margin: 0 0 2px; }
.db-card-head-left small { font-size: 11.5px; color: var(--soft); }

.db-card-icon { width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 16px; flex-shrink: 0; }

.db-card-body { padding: 12px 16px; }

/* =========================================================
   LAPORAN ITEM
========================================================= */
.lap-item {
    padding: 12px;
    border-radius: 12px;
    border: 1px solid #f0f4f1;
    background: #fafcfa;
    margin-bottom: 10px;
    transition: .2s;
}

.lap-item:last-child { margin-bottom: 0; }
.lap-item:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(0,0,0,.05); border-color: #d4e8d8; }

.lap-top { display: flex; justify-content: space-between; align-items: flex-start; gap: 8px; margin-bottom: 5px; }
.lap-judul { font-size: 13px; font-weight: 700; color: var(--text); margin: 0; line-height: 1.4; }
.lap-badge { background: #dcfce7; color: var(--g1); border-radius: 20px; padding: 3px 9px; font-size: 10.5px; font-weight: 600; white-space: nowrap; flex-shrink: 0; }
.lap-desc  { font-size: 12px; color: var(--soft); margin: 0 0 8px; line-height: 1.6; }
.lap-foot  { display: flex; align-items: center; gap: 6px; }

.st { padding: 3px 10px; border-radius: 20px; font-size: 10.5px; font-weight: 700; }
.st-selesai { background: #dcfce7; color: #15803d; }
.st-proses  { background: #fef3c7; color: #b45309; }
.st-pending { background: #fee2e2; color: #dc2626; }

/* =========================================================
   KALENDER BK
========================================================= */
.kal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 14px;
}

.kal-nav {
    display: flex;
    align-items: center;
    gap: 8px;
}

.kal-nav button {
    width: 28px; height: 28px;
    border-radius: 8px;
    border: 1px solid #e5e7eb;
    background: #f9fafb;
    color: #6b7280;
    font-size: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: .2s;
}

.kal-nav button:hover { background: #f0fdf4; color: var(--g1); border-color: #bbf7d0; }

.kal-month {
    font-size: 13px;
    font-weight: 700;
    color: var(--text);
    min-width: 110px;
    text-align: center;
}

.kal-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 3px;
}

.kal-day-name {
    text-align: center;
    font-size: 10px;
    font-weight: 700;
    color: #9ca3af;
    padding: 4px 0;
    text-transform: uppercase;
}

.kal-day {
    aspect-ratio: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 500;
    color: #374151;
    cursor: default;
    transition: .15s;
    position: relative;
}

.kal-day.empty { background: transparent; }
.kal-day.other { color: #d1d5db; }
.kal-day:not(.empty):not(.other):hover { background: #f0fdf4; color: var(--g1); }
.kal-day.today { background: var(--g1); color: white; font-weight: 700; box-shadow: 0 3px 8px rgba(10,127,46,.3); }
.kal-day.has-event { font-weight: 700; }
.kal-day.has-event::after {
    content: '';
    position: absolute;
    bottom: 3px;
    width: 4px; height: 4px;
    border-radius: 50%;
    background: var(--g2);
}
.kal-day.today::after { background: white; }

.kal-events {
    margin-top: 12px;
    padding-top: 12px;
    border-top: 1px solid #f3f4f6;
    display: flex;
    flex-direction: column;
    gap: 7px;
}

.kal-event-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 8px 10px;
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    border-radius: 10px;
    font-size: 12px;
}

.kal-event-dot {
    width: 8px; height: 8px;
    border-radius: 50%;
    background: var(--g2);
    flex-shrink: 0;
}

.kal-event-name { font-weight: 600; color: #15803d; flex: 1; }
.kal-event-time { font-size: 11px; color: #9ca3af; }

.kal-empty-event {
    text-align: center;
    padding: 12px;
    font-size: 12px;
    color: #9ca3af;
}

/* =========================================================
   EMPTY STATE
========================================================= */
.empty-state { text-align: center; padding: 32px 16px; color: #9ca3af; font-size: 13px; }
.empty-state i { font-size: 32px; display: block; margin-bottom: 8px; opacity: .4; }

/* =========================================================
   CHATBOT BTN
========================================================= */
.chatbot-btn {
    position: fixed;
    right: 22px; bottom: 22px;
    width: 54px; height: 54px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--g1), var(--g2));
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    font-size: 22px;
    z-index: 999;
    box-shadow: 0 8px 24px rgba(10,127,46,.3);
    transition: .25s;
}

.chatbot-btn:hover { transform: translateY(-3px) scale(1.06); box-shadow: 0 14px 30px rgba(10,127,46,.35); color: white; }

/* =========================================================
   RESPONSIVE
========================================================= */
@media(min-width:769px) and (max-width:1024px){
    .metrics-row { gap: 10px; }
    .metric-num { font-size: 24px; }
    .db-content { grid-template-columns: 1fr; }
    .db-topbar { padding: 14px 18px; }
    .topbar-left h2 { font-size: 18px; }
    .date-chip { display: none; }
}

@media(max-width:768px){
    .db { gap: 12px; }
    .db-topbar { padding: 12px 16px; border-radius: 14px; }
    .topbar-left h2 { font-size: 17px; }
    .date-chip { display: none; }
    .db-hero { padding: 16px 18px; border-radius: 14px; }
    .db-hero::before, .db-hero::after { display: none; }
    .hero-text h3 { font-size: 14px; }
    .hero-text p { font-size: 11.5px; }
    .btn-lapor { padding: 8px 14px; font-size: 12px; }
    .metrics-row { grid-template-columns: repeat(3,1fr); gap: 8px; }
    .metric-card { padding: 13px 10px; }
    .metric-num { font-size: 22px; }
    .metric-label { font-size: 10.5px; }
    .metric-sub { display: none; }
    .metric-icon { width: 34px; height: 34px; font-size: 15px; border-radius: 9px; }
    .metric-top { margin-bottom: 6px; }
    .db-progress { padding: 14px 16px; }
    .db-content { grid-template-columns: 1fr; }
    .db-card-head { padding: 13px 14px; }
    .db-card-body { padding: 10px 12px; }
    .lap-item { padding: 10px; }
    .lap-judul { font-size: 12.5px; }
    .lap-desc { font-size: 11.5px; }
    .chatbot-btn { width: 48px; height: 48px; font-size: 20px; right: 14px; bottom: 14px; }
}

@media(max-width:400px){
    .metric-num { font-size: 18px; }
    .metric-card { padding: 10px 8px; }
    .hero-action { display: none; }
}

</style>

<div class="db">

    {{-- TOPBAR --}}
    <div class="db-topbar">
        <div class="topbar-left">
            <h2>Dashboard</h2>
            <p>Ringkasan laporan dan jadwal konseling</p>
        </div>
        <div class="topbar-right">
            <div class="date-chip">
                <i class="bi bi-calendar3"></i>
                {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
            </div>

            {{-- NOTIF DROPDOWN --}}
            <div class="dropdown">
                <a href="#"
                   class="notif-btn"
                   data-bs-toggle="dropdown"
                   aria-expanded="false"
                   id="notifBtn"
                   onclick="markNotifRead()">
                    <i class="bi bi-bell"></i>
                    <span id="notif-count" class="notif-dot" style="display:none;">0</span>
                </a>
                <ul id="notif-list" class="dropdown-menu dropdown-menu-end notif-dropdown">
                    <li><span class="dropdown-item-text text-muted" style="font-size:13px;">Memuat...</span></li>
                </ul>
            </div>

            {{-- PROFILE --}}
            <a href="{{ auth()->user()->role == 'guru_bk' ? '/guru/profil' : '/siswa/profil' }}">
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
                <p>Pantau status laporan kamu dan sampaikan permasalahan baru</p>
            </div>
            <div class="hero-action">
                <a href="/buat-laporan" class="btn-lapor">
                    <i class="bi bi-plus-circle-fill"></i>
                    Buat Laporan
                </a>
            </div>
        </div>

        {{-- METRICS --}}
        <div class="metrics-row">
            <div class="metric-card">
                <div class="metric-top">
                    <div class="metric-icon ic-green"><i class="bi bi-journal-text"></i></div>
                </div>
                <div class="metric-label">Total Laporan</div>
                <div class="metric-num mn-green" id="total-laporan">{{ $total ?? 0 }}</div>
                <div class="metric-sub">Semua laporan terkirim</div>
            </div>
            <div class="metric-card">
                <div class="metric-top">
                    <div class="metric-icon ic-amber"><i class="bi bi-clock-history"></i></div>
                </div>
                <div class="metric-label">Dalam Proses</div>
                <div class="metric-num mn-amber" id="laporan-proses">{{ $proses ?? 0 }}</div>
                <div class="metric-sub">Ditangani Guru BK</div>
            </div>
            <div class="metric-card">
                <div class="metric-top">
                    <div class="metric-icon ic-blue"><i class="bi bi-check-circle"></i></div>
                </div>
                <div class="metric-label">Selesai</div>
                <div class="metric-num mn-blue" id="laporan-selesai">{{ $selesai ?? 0 }}</div>
                <div class="metric-sub">Laporan telah selesai</div>
            </div>
        </div>

        {{-- PROGRESS --}}
        @php $pct = ($total ?? 0) > 0 ? round((($selesai ?? 0) / $total) * 100) : 0; @endphp
        <div class="db-progress">
            <div class="prog-head">
                <span class="prog-label"><i class="bi bi-graph-up-arrow"></i> Progress Penyelesaian</span>
                <span class="prog-pct">{{ $pct }}%</span>
            </div>
            <div class="prog-bar-wrap">
                <div class="prog-bar-fill" style="width:{{ $pct }}%"></div>
            </div>
        </div>

        {{-- CONTENT GRID --}}
        <div class="db-content">

            {{-- LAPORAN TERBARU --}}
            <div class="db-card">
                <div class="db-card-head">
                    <div class="db-card-head-left">
                        <h5>Laporan Terbaru</h5>
                        <small>Laporan yang baru dikirim</small>
                    </div>
                    <div class="db-card-icon ic-green">
                        <i class="bi bi-file-earmark-text"></i>
                    </div>
                </div>
                <div class="db-card-body">
                    <div id="laporan-terbaru">
                        <div class="empty-state"><i class="bi bi-hourglass-split"></i>Memuat...</div>
                    </div>
                </div>
            </div>

            {{-- KALENDER JADWAL BK --}}
            <div class="db-card">
                <div class="db-card-head">
                    <div class="db-card-head-left">
                        <h5>Jadwal Konseling BK</h5>
                        <small>Kalender & agenda konseling</small>
                    </div>
                    <div class="db-card-icon ic-purple">
                        <i class="bi bi-calendar3-week"></i>
                    </div>
                </div>
                <div class="db-card-body">
                    <div class="kal-header">
                        <div class="kal-nav">
                            <button onclick="kalPrev()"><i class="bi bi-chevron-left"></i></button>
                            <span class="kal-month" id="kalMonth"></span>
                            <button onclick="kalNext()"><i class="bi bi-chevron-right"></i></button>
                        </div>
                    </div>
                    <div class="kal-grid" id="kalGrid"></div>
                    <div class="kal-events" id="kalEvents"></div>
                </div>
            </div>

        </div>

    </div>

</div>

{{-- CHATBOT FLOAT --}}
<a href="/chatbot" class="chatbot-btn" title="Chatbot AI">
    <i class="bi bi-robot"></i>
</a>

<script>

/* =========================================================
   NOTIF — badge berkurang saat dibuka
========================================================= */
const CSRF = document.querySelector('meta[name="csrf-token"]')?.content || '';
let unreadCount = 0;

function loadNotifDropdown() {
    fetch('/notif')
    .then(r => r.json())
    .then(data => {
        const badge = document.getElementById('notif-count');
        unreadCount = data.jumlah || 0;

        if (unreadCount > 0) {
            badge.innerText = unreadCount;
            badge.style.display = 'flex';
        } else {
            badge.style.display = 'none';
        }

        const list = document.getElementById('notif-list');
        let html = `<li><h6 class="dropdown-header" style="font-size:12px;font-weight:700;">Notifikasi</h6></li>`;

        if (!data.data || data.data.length === 0) {
            html += `<li><span class="dropdown-item-text" style="font-size:13px;color:#9ca3af;">Tidak ada notifikasi</span></li>`;
        } else {
            data.data.forEach(n => {
                html += `<li><a class="dropdown-item" href="#" style="font-size:13px;">${n.pesan}</a></li>`;
            });
        }

        list.innerHTML = html;
    })
    .catch(() => {});
}

/* Saat notif dibuka → tandai sudah dibaca → badge hilang */
function markNotifRead() {
    if (unreadCount === 0) return;

    fetch('/notif-read', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': CSRF,
        }
    })
    .then(() => {
        unreadCount = 0;
        const badge = document.getElementById('notif-count');
        badge.style.display = 'none';
    })
    .catch(() => {});
}

/* =========================================================
   LAPORAN TERBARU
========================================================= */
function loadLaporan() {
    fetch('/laporan-terbaru')
    .then(r => r.json())
    .then(data => {
        const el = document.getElementById('laporan-terbaru');
        if (!data || data.length === 0) {
            el.innerHTML = `<div class="empty-state"><i class="bi bi-inbox"></i>Belum ada laporan</div>`;
            return;
        }
        el.innerHTML = data.map(l => `
            <div class="lap-item">
                <div class="lap-top">
                    <p class="lap-judul">${l.judul}</p>
                    <span class="lap-badge">${l.kategori ?? 'Laporan'}</span>
                </div>
                <p class="lap-desc">${(l.deskripsi ?? '').substring(0,80)}${l.deskripsi && l.deskripsi.length > 80 ? '...' : ''}</p>
                <div class="lap-foot">
                    <span class="st st-${l.status}">${l.status}</span>
                </div>
            </div>
        `).join('');
    })
    .catch(() => {
        document.getElementById('laporan-terbaru').innerHTML =
            `<div class="empty-state"><i class="bi bi-exclamation-circle"></i>Gagal memuat</div>`;
    });
}

/* =========================================================
   REALTIME METRICS
========================================================= */
function loadRealtime() {
    fetch('/dashboard-realtime')
    .then(r => r.json())
    .then(data => {
        document.getElementById('total-laporan').innerText   = data.total;
        document.getElementById('laporan-proses').innerText  = data.proses;
        document.getElementById('laporan-selesai').innerText = data.selesai;
        loadLaporan();
    })
    .catch(() => {});
}

/* =========================================================
   KALENDER JADWAL BK
========================================================= */

// Jadwal konseling BK — bisa disesuaikan
const jadwalBK = [
    { hari: 1, nama: 'Konseling Individu', jam: '08.00 – 10.00' },  // Senin
    { hari: 2, nama: 'Konseling Kelompok', jam: '10.00 – 12.00' },  // Selasa
    { hari: 4, nama: 'Konseling Individu', jam: '13.00 – 15.00' },  // Kamis
    { hari: 5, nama: 'Jam Terbuka BK',     jam: '08.00 – 09.00' },  // Jumat
];

const MONTHS = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
const DAYS   = ['Min','Sen','Sel','Rab','Kam','Jum','Sab'];

let kalDate = new Date();

function renderKal() {
    const year  = kalDate.getFullYear();
    const month = kalDate.getMonth();
    const today = new Date();

    document.getElementById('kalMonth').textContent = `${MONTHS[month]} ${year}`;

    const firstDay  = new Date(year, month, 1).getDay();
    const totalDays = new Date(year, month + 1, 0).getDate();

    let html = DAYS.map(d => `<div class="kal-day-name">${d}</div>`).join('');

    // Kosong sebelum hari pertama
    for (let i = 0; i < firstDay; i++) {
        html += `<div class="kal-day empty"></div>`;
    }

    for (let d = 1; d <= totalDays; d++) {
        const date    = new Date(year, month, d);
        const dayNum  = date.getDay(); // 0=Min ... 6=Sab
        const isToday = today.getFullYear() === year && today.getMonth() === month && today.getDate() === d;
        const hasEv   = jadwalBK.some(j => j.hari === dayNum);

        let cls = 'kal-day';
        if (isToday)  cls += ' today';
        if (hasEv)    cls += ' has-event';

        html += `<div class="${cls}">${d}</div>`;
    }

    document.getElementById('kalGrid').innerHTML = html;
    renderEvents();
}

function renderEvents() {
    const today  = new Date();
    const dayNum = today.getDay();
    const todayEvents = jadwalBK.filter(j => j.hari === dayNum);
    const el = document.getElementById('kalEvents');

    if (todayEvents.length === 0) {
        el.innerHTML = `<div class="kal-empty-event">📅 Tidak ada jadwal konseling hari ini</div>`;
        return;
    }

    el.innerHTML = todayEvents.map(e => `
        <div class="kal-event-item">
            <div class="kal-event-dot"></div>
            <span class="kal-event-name">${e.nama}</span>
            <span class="kal-event-time">${e.jam}</span>
        </div>
    `).join('');
}

function kalPrev() { kalDate.setMonth(kalDate.getMonth() - 1); renderKal(); }
function kalNext() { kalDate.setMonth(kalDate.getMonth() + 1); renderKal(); }

/* =========================================================
   INIT
========================================================= */
loadRealtime();
loadNotifDropdown();
renderKal();

setInterval(loadRealtime,      5000);
setInterval(loadNotifDropdown, 5000);

</script>

@endsection