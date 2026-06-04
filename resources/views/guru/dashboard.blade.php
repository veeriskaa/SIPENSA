@extends('layouts.guru')

@section('title','Dashboard Guru BK')

@section('content')

<div class="dashboard-page">

    <!-- HEADER -->
    <div class="dashboard-header-clean">

        <div>
            <h2>Dashboard</h2>
            <p>Ringkasan laporan siswa terbaru</p>
        </div>

        <div class="header-right">

            <!-- DATE -->
            <div class="date-chip">
                <i class="bi bi-calendar3"></i>
                {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
            </div>

            <!-- NOTIF -->
            <div class="notif-btn">

                <i class="bi bi-bell"></i>

                <span class="notif-dot"></span>

            </div>

            <!-- PROFILE -->
            <img src="{{ auth()->user()->foto
                ? asset('storage/' . auth()->user()->foto)
                : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}"
                class="profile-img">

        </div>

    </div>

    <!-- SCROLL CONTENT -->
    <div class="dashboard-scroll">

        <!-- METRIC -->
        <div class="metrics">

            <!-- TOTAL -->
            <div class="metric-card">

                <div class="metric-top">

                    <div>

                        <div class="metric-title">
                            Total Laporan
                        </div>

                        <div class="metric-number"
                             id="total-laporan">
                            0
                        </div>

                        <div class="metric-desc">
                            Semua laporan masuk
                        </div>

                    </div>

                    <div class="metric-icon icon-green">
                        <i class="bi bi-journal-text"></i>
                    </div>

                </div>

            </div>

            <!-- PENDING -->
            <div class="metric-card">

                <div class="metric-top">

                    <div>

                        <div class="metric-title">
                            Pending
                        </div>

                        <div class="metric-number"
                             id="perlu-ditanggapi">
                            0
                        </div>

                        <div class="metric-desc">
                            Menunggu respon
                        </div>

                    </div>

                    <div class="metric-icon icon-red">
                        <i class="bi bi-exclamation-circle"></i>
                    </div>

                </div>

            </div>

            <!-- PROSES -->
            <div class="metric-card">

                <div class="metric-top">

                    <div>

                        <div class="metric-title">
                            Diproses
                        </div>

                        <div class="metric-number"
                             id="laporan-proses">
                            0
                        </div>

                        <div class="metric-desc">
                            Sedang ditangani
                        </div>

                    </div>

                    <div class="metric-icon icon-orange">
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

                        <div class="metric-number"
                             id="laporan-selesai">
                            0
                        </div>

                        <div class="metric-desc">
                            Sudah selesai
                        </div>

                    </div>

                    <div class="metric-icon icon-blue">
                        <i class="bi bi-check-circle"></i>
                    </div>

                </div>

            </div>

        </div>

        <!-- CHART -->
        <div class="chart-grid">

            <!-- LINE -->
            <div class="chart-card">

                <h5>Statistik Mingguan</h5>

                <p>Jumlah laporan setiap minggu</p>

                <div class="chart-wrapper line-chart-wrapper">
                    <canvas id="lineChart"></canvas>
                </div>

            </div>

            <!-- BAR -->
            <div class="chart-card">

                <h5>Kategori Laporan</h5>

                <p>Total laporan berdasarkan kategori</p>

                <div class="chart-wrapper bar-chart-wrapper">
                    <canvas id="barChart"></canvas>
                </div>

            </div>

        </div>

        <!-- TABLE -->
        <div class="table-card">

            <div class="table-top">

                <h5>Laporan Terbaru</h5>

                <a href="/guru/laporan"
                   class="btn btn-outline-success btn-modern">

                    Lihat Semua

                </a>

            </div>

            <div class="table-responsive">

                <table class="table align-middle">

                    <thead>

                        <tr>

                            <th>No</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Pelapor</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>

                        </tr>

                    </thead>

                    <tbody id="laporan-table">

                        <tr>

                            <td colspan="7"
                                class="text-center text-muted py-4">

                                Loading...

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

/*
|--------------------------------------------------------------------------
| LINE CHART
|--------------------------------------------------------------------------
*/

const lineChart = new Chart(
document.getElementById('lineChart'),
{
    type:'line',

    data:{
        labels:['Sen','Sel','Rab','Kam','Jum','Sab','Min'],

        datasets:[{
            data:[12,19,9,14,17,13,20],

            borderColor:'#2f6f57',

            backgroundColor:'rgba(47,111,87,0.08)',

            tension:0.4,

            fill:true,

            pointRadius:3
        }]
    },

    options:{
        responsive:true,
        maintainAspectRatio:false,

        plugins:{
            legend:{
                display:false
            }
        },

        scales:{
            y:{
                grid:{
                    color:'#eef2f7'
                },

                ticks:{
                    stepSize:5
                }
            },

            x:{
                grid:{
                    display:false
                }
            }
        }
    }
});

/*
|--------------------------------------------------------------------------
| BAR CHART
|--------------------------------------------------------------------------
*/

const barChart = new Chart(
document.getElementById('barChart'),
{
    type:'bar',

    data:{
        labels:['Bullying','Fasilitas','Akademik'],

        datasets:[{
            data:[0,0,0],

            borderRadius:6,

            backgroundColor:[
                '#c65b5b',
                '#5d7fa3',
                '#c79b46'
            ]
        }]
    },

    options:{
        responsive:true,
        maintainAspectRatio:false,

        plugins:{
            legend:{
                display:false
            }
        },

        scales:{
            y:{
                beginAtZero:true,

                ticks:{
                    precision:0
                },

                grid:{
                    color:'#eef2f7'
                }
            },

            x:{
                grid:{
                    display:false
                }
            }
        }
    }
});

/*
|--------------------------------------------------------------------------
| LOAD DASHBOARD
|--------------------------------------------------------------------------
*/

function loadDashboard(){

    fetch('/guru/realtime')

    .then(res => res.json())

    .then(data => {

        document.getElementById('total-laporan').innerText =
            data.total;

        document.getElementById('perlu-ditanggapi').innerText =
            data.pending;

        document.getElementById('laporan-proses').innerText =
            data.proses;

        document.getElementById('laporan-selesai').innerText =
            data.selesai;

        /*
        |--------------------------------------------------------------------------
        | BAR CHART
        |--------------------------------------------------------------------------
        */

        barChart.data.datasets[0].data = [
            data.bullying,
            data.fasilitas,
            data.akademik
        ];

        barChart.update();

        /*
        |--------------------------------------------------------------------------
        | LINE CHART
        |--------------------------------------------------------------------------
        */

        lineChart.data.datasets[0].data =
            data.mingguan;

        lineChart.update();

        /*
        |--------------------------------------------------------------------------
        | TABLE
        |--------------------------------------------------------------------------
        */

        let html = '';

        if(data.laporan.length === 0){

            html = `
                <tr>

                    <td colspan="7"
                        class="text-center text-muted py-4">

                        Belum ada laporan

                    </td>

                </tr>
            `;

        } else {

            data.laporan.forEach((item,index)=>{

                let statusBadge = '';

                if(item.status === 'pending'){

                    statusBadge =
                    `<span class="badge-soft badge-pending">
                        Pending
                    </span>`;

                } else if(item.status === 'proses'){

                    statusBadge =
                    `<span class="badge-soft badge-process">
                        Diproses
                    </span>`;

                } else {

                    statusBadge =
                    `<span class="badge-soft badge-done">
                        Selesai
                    </span>`;
                }

                html += `
                    <tr>

                        <td>${index + 1}</td>

                        <td>${item.judul}</td>

                        <td>${item.kategori}</td>

                        <td>${item.user?.name ?? '-'}</td>

                        <td>${item.created_at}</td>

                        <td>${statusBadge}</td>

                        <td>

                            <a href="/guru/respon/${item.id}"
                               class="btn btn-outline-success btn-sm">

                                <i class="bi bi-eye"></i>

                            </a>

                        </td>

                    </tr>
                `;
            });
        }

        document.getElementById('laporan-table').innerHTML =
            html;
    });
}

loadDashboard();

setInterval(loadDashboard,5000);

</script>

<style>

/* =========================================================
   ROOT
========================================================= */

:root{
    --bg:#f5f7fa;
    --surface:#ffffff;
    --surface2:#f8fafc;

    --border:#e9edf2;

    --text-1:#1f2937;
    --text-2:#4b5563;
    --text-3:#9ca3af;

    --green:#2f6f57;
    --green-soft:#edf5f1;

    --red:#c65b5b;
    --red-soft:#fdf1f1;

    --orange:#c79b46;
    --orange-soft:#fbf6eb;

    --blue:#5d7fa3;
    --blue-soft:#eff4f8;

    --shadow:
    0 1px 2px rgba(15,23,42,.03),
    0 8px 20px rgba(15,23,42,.03);
}

/* =========================================================
   BODY
========================================================= */

body{
    background:var(--bg);
    overflow:hidden;
}

/* =========================================================
   PAGE
========================================================= */

.dashboard-page{
    height:calc(100vh - 90px);

    display:flex;
    flex-direction:column;

    gap:18px;
}

/* =========================================================
   HEADER
========================================================= */

.dashboard-header-clean{
    background:#fff;

    border:1px solid #eceff3;

    border-radius:16px;

    padding:18px 22px;

    display:flex;
    justify-content:space-between;
    align-items:center;

    flex-wrap:wrap;
    gap:16px;

    flex-shrink:0;

    box-shadow:var(--shadow);
}

/* TITLE */

.dashboard-header-clean h2{
    font-size:24px;
    font-weight:700;
    margin-bottom:2px;
    color:#1f2937;
}

.dashboard-header-clean p{
    color:#8b95a7;
    margin:0;
    font-size:13px;
}

/* RIGHT */

.header-right{
    display:flex;
    align-items:center;
    gap:12px;
    flex-wrap:wrap;
}

/* DATE */

.date-chip{
    border:1px solid #e9edf2;

    background:#fafafa;

    border-radius:10px;

    padding:9px 14px;

    font-size:13px;

    color:#556070;

    display:flex;
    align-items:center;
    gap:8px;
}

/* NOTIF */

.notif-btn{
    width:40px;
    height:40px;

    border:1px solid #e9edf2;

    border-radius:10px;

    background:#fff;

    display:flex;
    justify-content:center;
    align-items:center;

    position:relative;
}

.notif-dot{
    width:7px;
    height:7px;

    background:#dc3545;

    border-radius:50%;

    position:absolute;

    top:10px;
    right:11px;
}

/* PROFILE */

.profile-img{
    width:42px;
    height:42px;

    border-radius:50%;

    object-fit:cover;

    border:2px solid #f3f4f6;
}

/* =========================================================
   SCROLL CONTENT
========================================================= */

.dashboard-scroll{
    flex:1;

    overflow-y:auto;
    overflow-x:hidden;

    padding-right:4px;
}

/* SCROLLBAR */

.dashboard-scroll::-webkit-scrollbar{
    width:8px;
}

.dashboard-scroll::-webkit-scrollbar-thumb{
    background:#d1d5db;
    border-radius:20px;
}

/* =========================================================
   METRICS
========================================================= */

.metrics{
    display:grid;
    grid-template-columns:repeat(4,1fr);

    gap:14px;

    margin-bottom:18px;
}

.metric-card{
    background:#fff;

    border:1px solid var(--border);

    border-radius:12px;

    padding:18px;

    box-shadow:var(--shadow);

    transition:.2s;
}

.metric-card:hover{
    transform:translateY(-2px);
}

.metric-top{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
}

.metric-icon{
    width:44px;
    height:44px;

    border-radius:10px;

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:18px;
}

.icon-green{
    background:var(--green-soft);
    color:var(--green);
}

.icon-red{
    background:var(--red-soft);
    color:var(--red);
}

.icon-orange{
    background:var(--orange-soft);
    color:var(--orange);
}

.icon-blue{
    background:var(--blue-soft);
    color:var(--blue);
}

.metric-number{
    font-size:28px;
    font-weight:600;

    margin-top:14px;
    margin-bottom:2px;
}

.metric-title{
    font-size:14px;
    font-weight:500;
}

.metric-desc{
    font-size:12px;
    color:var(--text-3);
}

/* =========================================================
   CHART
========================================================= */

.chart-grid{
    display:grid;

    grid-template-columns:1.4fr 1fr;

    gap:14px;

    margin-bottom:18px;

    align-items:start;
}

.chart-card{
    background:#fff;

    border:1px solid var(--border);

    border-radius:12px;

    padding:18px;

    box-shadow:var(--shadow);

    overflow:hidden;
}

.chart-card h5{
    font-size:16px;
    font-weight:600;
    margin-bottom:2px;
}

.chart-card p{
    font-size:12px;
    color:var(--text-3);
    margin-bottom:14px;
}

/* FIX CHART SIZE */

.chart-wrapper{
    position:relative;
    width:100%;
}

.line-chart-wrapper{
    height:220px;
    max-height:220px;
}

.bar-chart-wrapper{
    height:220px;
    max-height:220px;
}

.chart-wrapper canvas{
    width:100% !important;
    height:100% !important;
    display:block;
}

/* =========================================================
   TABLE
========================================================= */

.table-card{
    background:#fff;

    border:1px solid var(--border);

    border-radius:12px;

    padding:18px;

    box-shadow:var(--shadow);
}

.table-top{
    display:flex;
    justify-content:space-between;
    align-items:center;

    margin-bottom:16px;
}

.table thead th{
    border:none;

    font-size:12px;

    color:var(--text-3);

    font-weight:600;

    white-space:nowrap;
}

.table tbody td{
    padding:15px 10px;

    border-top:1px solid #f1f3f5;

    font-size:13px;

    vertical-align:middle;
}

/* =========================================================
   BADGE
========================================================= */

.badge-soft{
    padding:6px 10px;

    border-radius:8px;

    font-size:11px;
    font-weight:500;
}

.badge-pending{
    background:var(--red-soft);
    color:var(--red);
}

.badge-process{
    background:var(--orange-soft);
    color:var(--orange);
}

.badge-done{
    background:var(--green-soft);
    color:var(--green);
}

/* =========================================================
   BUTTON
========================================================= */

.btn-modern{
    border-radius:8px;

    padding:7px 12px;

    font-size:12px;
}

/* =========================================================
   RESPONSIVE
========================================================= */

@media(max-width:1100px){

    .metrics{
        grid-template-columns:repeat(2,1fr);
    }

    .chart-grid{
        grid-template-columns:1fr;
    }

    .line-chart-wrapper,
    .bar-chart-wrapper{
        height:210px;
    }

}

@media(max-width:768px){

    body{
        overflow:auto;
    }

    .dashboard-page{
        height:auto;
    }

    .dashboard-header-clean{
        flex-direction:column;
        align-items:flex-start;
    }

    .metrics{
        grid-template-columns:1fr;
    }

    .dashboard-scroll{
        overflow:visible;
    }

    .line-chart-wrapper,
    .bar-chart-wrapper{
        height:190px;
    }

}

</style>

@endsection