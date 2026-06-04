@extends('layouts.guru')

@section('title','Analisis')

@section('content')

<div class="dashboard-page">

    <!-- HEADER FIX -->
    <div class="hero-box">

        <div>
            <h3>Analisis Laporan</h3>

            <p>
                Monitoring statistik dan performa penanganan laporan siswa
            </p>
        </div>

        <a href="/guru/analisis/pdf"
           class="btn-export">

            <i class="bi bi-download"></i>
            Export PDF

        </a>

    </div>

    <!-- CONTENT SCROLL -->
    <div class="dashboard-scroll">


    <!-- MINI STATS -->
    <div class="mini-stats">

        <div class="mini-card">
            <small>Total</small>
            <h4>{{ $totalLaporan }}</h4>
        </div>

        <div class="mini-card">
            <small>Selesai</small>
            <h4>{{ $selesai }}</h4>
        </div>

        <div class="mini-card">
            <small>Diproses</small>
            <h4>{{ $diproses }}</h4>
        </div>

        <div class="mini-card">
            <small>Pending</small>
            <h4>{{ $pending }}</h4>
        </div>

    </div>

    <!-- CHART GRID -->
    <div class="chart-grid">

        <!-- LINE -->
        <div class="chart-card">

            <div class="card-head">
                <div>
                    <h5>Tren Bulanan</h5>
                    <span>Laporan 6 bulan terakhir</span>
                </div>
            </div>

            <div class="chart-wrapper">
                <canvas id="trenChart"></canvas>
            </div>

        </div>

        <!-- DONUT -->
        <div class="chart-card small-card">

            <div class="card-head">
                <div>
                    <h5>Persentase Status</h5>
                    <span>Status penanganan laporan</span>
                </div>
            </div>

            <div class="donut-wrapper">
                <canvas id="statusChart"></canvas>
            </div>

        </div>

    </div>

    <!-- INSIGHT -->
    <div class="insight-box">

        <div class="insight-icon">
            <i class="bi bi-lightbulb"></i>
        </div>

        <div>

            <h6>Insight Sistem</h6>

            <p>

                @if($pending > $selesai)

                    Jumlah laporan pending masih cukup tinggi.
                    Disarankan meningkatkan kecepatan respon Guru BK.

                @elseif($selesai >= $pending)

                    Tingkat penyelesaian laporan cukup baik.
                    Sistem penanganan berjalan dengan optimal.

                @endif

            </p>

        </div>

    </div>

    <!-- BOTTOM GRID -->
    <div class="bottom-grid">

        <!-- KATEGORI -->
        <div class="modern-card">

            <div class="section-head">

                <h5>Kategori Terbanyak</h5>

            </div>

            <div class="kategori-box">

                <div class="kategori-icon">
                    <i class="bi bi-folder2-open"></i>
                </div>

                <div>

                    <h4>
                        {{ $kategoriTerbanyak->nama_kategori ?? '-' }}
                    </h4>

                    <small>
                        {{ $kategoriTerbanyak->pengaduan_count ?? 0 }}
                        laporan ditemukan
                    </small>

                </div>

            </div>

        </div>

        <!-- LAPORAN -->
        <div class="modern-card">

            <div class="section-head">

                <h5>Laporan Terbaru</h5>

            </div>

            <div class="table-responsive">

                <table class="table align-middle">

                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($laporanTerbaru as $item)

                            <tr>

                                <td>
                                    {{ $item->judul }}
                                </td>

                                <td>

                                    @if($item->status == 'selesai')

                                        <span class="badge done">
                                            Selesai
                                        </span>

                                    @elseif($item->status == 'diproses')

                                        <span class="badge process">
                                            Diproses
                                        </span>

                                    @else

                                        <span class="badge pending">
                                            Pending
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="2"
                                    class="text-center text-muted">

                                    Belum ada laporan

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<!-- CHART -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

/*
|--------------------------------------------------------------------------
| TREN BULANAN
|--------------------------------------------------------------------------
*/

new Chart(
document.getElementById('trenChart'),
{
    type:'line',

    data:{
        labels:[
            'Jan','Feb','Mar',
            'Apr','Mei','Jun'
        ],

        datasets:[{
            data:[12,19,14,17,25,22],

            borderColor:'#16a34a',

            backgroundColor:'rgba(22,163,74,0.08)',

            fill:true,

            tension:0.4,

            pointRadius:3
        }]
    },

    options:{
        responsive:true,

        plugins:{
            legend:{
                display:false
            }
        },

        scales:{
            y:{
                beginAtZero:true,
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
| STATUS DONUT
|--------------------------------------------------------------------------
*/

new Chart(
document.getElementById('statusChart'),
{
    type:'doughnut',

    data:{
        labels:[
            'Selesai',
            'Diproses',
            'Pending'
        ],

        datasets:[{
            data:[
                {{ $selesai }},
                {{ $diproses }},
                {{ $pending }}
            ],

            backgroundColor:[
                '#16a34a',
                '#f59e0b',
                '#ef4444'
            ],

            borderWidth:0
        }]
    },

    options:{
        responsive:true,

        plugins:{
            legend:{
                position:'bottom'
            }
        },

        cutout:'70%'
    }
});

</script>

<style>


/* HERO */
.hero-box{
    background:white;
    border-radius:18px;
    border:1px solid #eaeef3;

    padding:16px 18px;

    display:flex;
    justify-content:space-between;
    align-items:center;

    position:sticky;
    top:0;

    z-index:100;

    margin-bottom:16px;

    box-shadow:0 2px 10px rgba(0,0,0,.04);
}

/* JUDUL */
.hero-box h3{
    font-size:22px;
    font-weight:600;
    margin-bottom:4px;
    color:#111827;
}

/* DESKRIPSI */
.hero-box p{
    margin:0;
    color:#6b7280;
    font-size:13px;
}

/* BUTTON */
.btn-export{
    background:#16a34a;
    color:white;
    border:none;
    border-radius:12px;

    padding:10px 16px;

    font-size:13px;
    text-decoration:none;

    display:flex;
    align-items:center;
    gap:8px;
}

/* MINI */
.mini-stats{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:14px;
    margin-top:24px;
}

.mini-card{
    background:white;
    border-radius:16px;
    padding:18px;
    border:1px solid #eaeef3;
}

.mini-card small{
    color:#6b7280;
    font-size:12px;
}

.mini-card h4{
    margin-top:8px;
    margin-bottom:0;
    font-size:24px;
    font-weight:600;
}

/* CHART */
.chart-grid{
    display:grid;
    grid-template-columns:1.5fr 0.9fr;
    gap:24px; /* jarak antar card */
    margin-top:20px;
    margin-bottom:24px;
}

.chart-card{
    background:white;
    border-radius:18px;
    border:1px solid #eaeef3;
    padding:20px;
}

.small-card{
    display:flex;
    flex-direction:column;
}

.card-head h5{
    font-size:15px;
    font-weight:600;
    margin-bottom:3px;
}

.card-head span{
    font-size:12px;
    color:#6b7280;
}

.chart-wrapper{
    margin-top:20px;
    height:260px;
}

.donut-wrapper{
    margin-top:20px;
    height:260px;
}

/* INSIGHT */
.insight-box{
    background:#ecfdf3;
    border:1px solid #bbf7d0;
    border-radius:18px;

    padding:18px 20px;

    display:flex;
    gap:16px;
    align-items:flex-start;
}

.insight-icon{
    width:48px;
    height:48px;
    border-radius:14px;

    background:#16a34a;
    color:white;

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:20px;
}

.insight-box h6{
    font-weight:600;
    margin-bottom:6px;
}

.insight-box p{
    margin:0;
    font-size:14px;
    color:#374151;



}

/* BOTTOM */
.bottom-grid{
    display:grid;
    grid-template-columns:0.9fr 1.4fr;
    gap:24px;
}

.modern-card{
    background:white;
    border-radius:18px;
    border:1px solid #eaeef3;
    padding:20px;
}

.section-head{
    margin-bottom:18px;
}

.section-head h5{
    font-size:15px;
    font-weight:600;
    margin:0;
}

/* KATEGORI */
.kategori-box{
    display:flex;
    align-items:center;
    gap:16px;
}

.kategori-icon{
    width:58px;
    height:58px;
    border-radius:16px;

    background:#dcfce7;
    color:#16a34a;

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:24px;
}

.kategori-box h4{
    font-size:18px;
    font-weight:600;
    margin-bottom:4px;
}

.kategori-box small{
    color:#6b7280;
}

/* TABLE */
table th{
    border:none;
    font-size:12px;
    color:#6b7280;
}

table td{
    border:none;
    font-size:13px;
}

/* BADGE */
.badge{
    padding:7px 12px;
    border-radius:30px;
    font-size:11px;
    font-weight:600;
}

.done{
    background:#dcfce7;
    color:#15803d;
}

.process{
    background:#fef3c7;
    color:#b45309;
}

.pending{
    background:#fee2e2;
    color:#dc2626;
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