@extends('layouts.siswa')

@section('title','Dashboard')

@section('content')

<div class="dashboard-wrapper">

    <!-- HEADER FIX -->
    <div class="dashboard-header">

        <div>
            <h2>Dashboard</h2>
            <p>Ringkasan laporan dan notifikasi terbaru</p>
        </div>

        <div class="header-right">

            <!-- DATE -->
            <div class="date-chip">
                <i class="bi bi-calendar3"></i>

                {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
            </div>

            <!-- NOTIF -->
            <div class="dropdown">

                <a href="#"
                   class="notif-btn"
                   data-bs-toggle="dropdown">

                    <i class="bi bi-bell"></i>

                    <span id="notif-count"
                          class="notif-dot"
                          style="display:none;">

                        0

                    </span>

                </a>

                <ul id="notif-list"
                    class="dropdown-menu dropdown-menu-end notif-dropdown">

                    <li class="dropdown-header">
                        Notifikasi
                    </li>

                </ul>

            </div>

            <!-- PROFILE -->
            <a href="{{ auth()->user()->role == 'guru_bk'
                ? '/guru/profil'
                : '/siswa/profil' }}">

                <img src="{{ auth()->user()->foto
                    ? asset('storage/' . auth()->user()->foto)
                    : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}"
                    class="profile-img">

            </a>

        </div>

    </div>

    <!-- SCROLL AREA -->
    <div class="dashboard-scroll">

        <!-- METRICS -->
        <div class="metrics-grid">

            <!-- TOTAL -->
            <div class="metric-card">

                <div class="metric-top">

                    <div>

                        <div class="metric-title">
                            Total Laporan
                        </div>

                        <div class="metric-number text-success"
                             id="total-laporan">

                            {{ $total ?? 0 }}

                        </div>

                        <div class="metric-desc">
                            Semua laporan yang dikirim
                        </div>

                    </div>

                    <div class="metric-icon green-soft">
                        <i class="bi bi-journal-text"></i>
                    </div>

                </div>

            </div>

            <!-- PROSES -->
            <div class="metric-card">

                <div class="metric-top">

                    <div>

                        <div class="metric-title">
                            Dalam Proses
                        </div>

                        <div class="metric-number text-warning"
                             id="laporan-proses">

                            {{ $proses ?? 0 }}

                        </div>

                        <div class="metric-desc">
                            Sedang ditangani Guru BK
                        </div>

                    </div>

                    <div class="metric-icon orange-soft">
                        <i class="bi bi-clock-history"></i>
                    </div>

                </div>

            </div>

            <!-- SELESAI -->
            <div class="metric-card">

                <div class="metric-top">

                    <div>

                        <div class="metric-title">
                            Selesai
                        </div>

                        <div class="metric-number text-primary"
                             id="laporan-selesai">

                            {{ $selesai ?? 0 }}

                        </div>

                        <div class="metric-desc">
                            Laporan telah selesai
                        </div>

                    </div>

                    <div class="metric-icon blue-soft">
                        <i class="bi bi-check-circle"></i>
                    </div>

                </div>

            </div>

        </div>

        <div class="progress-card">

    <div class="progress-header">

        <span>Progress Penyelesaian</span>

        <span>
            {{ $total > 0 ? round(($selesai / $total) * 100) : 0 }}%
        </span>

    </div>

    <div class="progress mt-2">

        <div
            class="progress-bar bg-success"
            style="
            width:
            {{ $total > 0 ? round(($selesai / $total) * 100) : 0 }}%;
        ">
        </div>

    </div>

</div>

        <!-- CONTENT -->
        <div class="content-grid">

            <!-- LAPORAN -->
            <div class="content-card">

                <div class="card-header-custom">

                    <div>
                        <h5>Laporan Terbaru</h5>
                        <small>Laporan siswa terbaru</small>
                    </div>

                    <div class="card-icon green-soft">
                        <i class="bi bi-file-earmark-text"></i>
                    </div>

                </div>

                <div id="laporan-terbaru">

                    <div class="empty-state">
                        Loading...
                    </div>

                </div>

            </div>

            <!-- NOTIF -->
            <div class="content-card">

                <div class="card-header-custom">

                    <div>
                        <h5>Notifikasi</h5>
                        <small>Update terbaru dari sistem</small>
                    </div>

                    <div class="card-icon blue-soft">
                        <i class="bi bi-bell"></i>
                    </div>

                </div>

                <div id="notif-dashboard">

                    <div class="empty-state">
                        Loading...
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- CHATBOT -->
<a href="/chatbot" class="chatbot-btn">
    <i class="bi bi-robot"></i>
</a>

<script>

// ================= LAPORAN =================
function loadLaporan() {

    fetch('/laporan-terbaru')

    .then(res => res.json())

    .then(data => {

        let html = '';

        if (!data || data.length === 0) {

            html = `
                <div class="empty-state">
                    Belum ada laporan
                </div>
            `;

        } else {

            data.forEach(l => {

                html += `
                <div class="list-card">

                    <div class="list-top">

                        <h6>${l.judul}</h6>

                        <span class="badge-soft">${l.kategori ?? 'Laporan'}
                        </span>

                    </div>

                    <p>
                        ${(l.deskripsi ?? '').substring(0,90)}...
                    </p>

                    <div class="list-footer mt-2">
                        <span class="status status-${l.status}">${l.status}
                        </span>

                    </div>

                </div>
                `;
            });

        }

        document.getElementById('laporan-terbaru').innerHTML = html;

    });

}

// ================= NOTIF =================
function loadNotifDashboard() {

    fetch('/notif-terbaru')

    .then(res => res.json())

    .then(data => {

        let html = '';

        if (!data || data.length === 0) {

            html = `
                <div class="empty-state">
                    Tidak ada notifikasi
                </div>
            `;

        } else {

            data.forEach(n => {

                let badgeClass = 'notif-blue';

                if(n.status === 'selesai'){
                    badgeClass = 'notif-green';
                }

                html += `
                    <div class="${badgeClass}">

                        <div class="notif-title">
                            ${n.pesan}
                        </div>

                    </div>
                `;

            });

        }

        document.getElementById('notif-dashboard').innerHTML = html;

    });

}

// ================= REALTIME =================
function loadRealtimeDashboard() {

    fetch('/dashboard-realtime')

    .then(res => res.json())

    .then(data => {

        document.getElementById('total-laporan').innerText =
            data.total;

        document.getElementById('laporan-proses').innerText =
            data.proses;

        document.getElementById('laporan-selesai').innerText =
            data.selesai;

        loadLaporan();
        loadNotifDashboard();

    });

}

function loadNotifDropdown(){

    fetch('/notif')

    .then(res => res.json())

    .then(data => {

        let html = `
        <li class="dropdown-header">
            Notifikasi
        </li>
        `;

        if(data.data.length === 0){

            html += `
            <li>
                <span class="dropdown-item-text">
                    Tidak ada notifikasi
                </span>
            </li>
            `;

        }else{

            data.data.forEach(n => {

                html += `
                <li>
                    <span class="dropdown-item">
                        ${n.pesan}
                    </span>
                </li>
                `;
            });

        }

        document.getElementById('notif-list').innerHTML = html;

    });

}

// ================= NOTIF COUNT =================
function loadNotifCount() {

    fetch('/notif')

    .then(res => res.json())

    .then(data => {

        const badge =
            document.getElementById('notif-count');

        if(data.jumlah > 0){

            badge.innerText = data.jumlah;
            badge.style.display = 'flex';

        }else{

            badge.style.display = 'none';

        }

    });

}

// ================= AUTO LOAD =================
loadRealtimeDashboard();
loadNotifDropdown();
loadNotifCount();

setInterval(loadRealtimeDashboard,5000);
setInterval(loadNotifDropdown,5000);
setInterval(loadNotifCount,5000);

</script>

<style>

/* =========================================================
   WRAPPER
========================================================= */

.dashboard-wrapper{
    height:100%;
    display:flex;
    flex-direction:column;
    overflow:hidden;
}

/* =========================================================
   HEADER FIX
========================================================= */

.dashboard-header{
    flex-shrink:0;

    position:sticky;
    top:0;

    z-index:100;

    background:#ffffff;

    border:1px solid #e9edf2;
    border-radius:16px;

    padding:20px 22px;

    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:16px;

    margin-bottom:16px;

    box-shadow:
    0 1px 2px rgba(15,23,42,.03),
    0 10px 25px rgba(15,23,42,.04);
}

/* =========================================================
   SCROLL AREA
========================================================= */

.dashboard-scroll{
    flex:1;
    overflow-y:auto;
    overflow-x:hidden;
    padding-right:4px;
}

/* =========================================================
   HEADER TEXT
========================================================= */

.dashboard-header h2{
    font-size:22px;
    font-weight:600;
    margin-bottom:4px;
    color:#111827;
}

.dashboard-header p{
    margin:0;
    font-size:13px;
    color:#9ca3af;
}

.header-right{
    display:flex;
    align-items:center;
    gap:12px;
    flex-wrap:wrap;
}

/* =========================================================
   DATE
========================================================= */

.date-chip{
    background:#fafbfc;
    border:1px solid #e9edf2;
    border-radius:12px;

    padding:9px 14px;

    display:flex;
    align-items:center;
    gap:8px;

    font-size:12px;
    color:#4b5563;
}

/* =========================================================
   NOTIF
========================================================= */

.notif-btn{
    width:42px;
    height:42px;

    border-radius:12px;
    border:1px solid #e9edf2;

    background:#fff;

    display:flex;
    align-items:center;
    justify-content:center;

    position:relative;

    color:#374151;
    text-decoration:none;
}

.notif-dot{
    position:absolute;

    top:-4px;
    right:-4px;

    width:18px;
    height:18px;

    border-radius:50%;

    background:#dc3545;
    color:#fff;

    font-size:10px;

    display:flex;
    align-items:center;
    justify-content:center;
}

/* =========================================================
   PROFILE
========================================================= */

.profile-img{
    width:42px;
    height:42px;

    border-radius:50%;
    object-fit:cover;

    transition:.3s;
}

.profile-img:hover{
    transform:scale(1.05);
}

.progress-card{

    background:#fff;

    border:1px solid #e9edf2;
    border-radius:16px;

    padding:18px;

    margin-bottom:20px;

    box-shadow:
    0 1px 2px rgba(15,23,42,.03),
    0 10px 25px rgba(15,23,42,.03);
}

.progress-header{
    display:flex;
    justify-content:space-between;
    font-size:14px;
    font-weight:600;
}

/* =========================================================
   METRICS
========================================================= */

.metrics-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(240px,1fr));
    gap:16px;
}

.metric-card{
    background:#fff;

    border:1px solid #e9edf2;
    border-radius:16px;

    padding:20px;

    transition:.2s;

    box-shadow:
    0 1px 2px rgba(15,23,42,.03),
    0 10px 25px rgba(15,23,42,.03);
}

.metric-card:hover{
    transform:translateY(-3px);

    box-shadow:
    0 12px 24px rgba(15,23,42,.08);
}

.metric-top{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    gap:14px;
}

.metric-title{
    font-size:13px;
    color:#6b7280;
}

.metric-number{
    font-size:28px;
    font-weight:700;
    margin:8px 0 4px;
}

.metric-desc{
    font-size:12px;
    color:#9ca3af;
}

.metric-icon{
    width:52px;
    height:52px;

    border-radius:14px;

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:20px;
}

.green-soft{
    background:#edf5f1;
    color:#2f6f57;
}

.orange-soft{
    background:#fbf6eb;
    color:#c79b46;
}

.blue-soft{
    background:#eef4f8;
    color:#5d7fa3;
}

/* =========================================================
   CONTENT GRID
========================================================= */

.content-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(320px,1fr));
    gap:16px;
}

/* =========================================================
   CONTENT CARD
========================================================= */

.content-card{
    background:#fff;

    border:1px solid #e9edf2;
    border-radius:16px;

    padding:20px;

    box-shadow:
    0 1px 2px rgba(15,23,42,.03),
    0 10px 25px rgba(15,23,42,.03);
}

/* =========================================================
   CARD HEADER
========================================================= */

.card-header-custom{
    display:flex;
    justify-content:space-between;
    align-items:center;

    margin-bottom:18px;
    padding-bottom:16px;

    border-bottom:1px solid #f1f3f5;
}

.card-header-custom h5{
    margin:0;
    font-size:17px;
    font-weight:700;
}

.card-header-custom small{
    color:#9ca3af;
}

.card-icon{
    width:44px;
    height:44px;

    border-radius:12px;

    display:flex;
    align-items:center;
    justify-content:center;
}

/* =========================================================
   LIST
========================================================= */

.list-card{
    border:1px solid #eef2f6;
    border-radius:14px;

    padding:15px;

    margin-bottom:12px;

    transition:.2s;
}

.list-card:hover{
    transform:translateY(-2px);

    box-shadow:
    0 6px 16px rgba(0,0,0,.04);
}

.list-top{
    display:flex;
    justify-content:space-between;
    gap:10px;

    margin-bottom:8px;
}

.list-top h6{
    margin:0;
    font-size:14px;
    font-weight:600;
}

.list-card p{
    margin:0;
    font-size:13px;
    line-height:1.7;
    color:#6b7280;
}

.badge-soft{
    background:#edf5f1;
    color:#2f6f57;

    border-radius:20px;

    padding:5px 10px;

    font-size:11px;
    white-space:nowrap;
}

/* =========================================================
   NOTIF
========================================================= */

.notif-blue,
.notif-green{
    padding:14px;
    border-radius:12px;
    margin-bottom:12px;
}

.notif-blue{
    background:#eef4f8;
    color:#35516b;
}

.notif-green{
    background:#edf5f1;
    color:#2f6f57;
}

/* =========================================================
   EMPTY
========================================================= */

.empty-state{
    text-align:center;
    padding:40px 20px;
    color:#9ca3af;
}

/* =========================================================
   CHATBOT
========================================================= */

.chatbot-btn{
    position:fixed;

    right:24px;
    bottom:24px;

    width:58px;
    height:58px;

    border-radius:50%;

    background:#2f6f57;
    color:#fff;

    display:flex;
    align-items:center;
    justify-content:center;

    text-decoration:none;

    font-size:24px;

    z-index:999;
}

.list-footer{
    margin-top:10px;
}

.status{
    padding:5px 10px;
    border-radius:20px;
    font-size:11px;
    font-weight:600;
}

.status-selesai{
    background:#dcfce7;
    color:#15803d;
}

.status-diproses{
    background:#fef3c7;
    color:#b45309;
}

.status-pending{
    background:#fee2e2;
    color:#dc2626;
}

/* =========================================================
   RESPONSIVE
========================================================= */

@media(max-width:992px){

    .metrics-grid{
        grid-template-columns:1fr;
    }

    .content-grid{
        grid-template-columns:1fr;
    }

}

@media(max-width:768px){

    .dashboard-header{
        flex-direction:column;
        align-items:flex-start;
    }

    .header-right{
        width:100%;
    }

    .date-chip{
        width:100%;
        justify-content:center;
    }

    .list-top{
        flex-direction:column;
    }

}

</style>

@endsection