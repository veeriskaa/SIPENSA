@extends('layouts.guru')

@section('title','Analisis')

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
}

.an * { box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }

/* =========================================================
   PAGE
========================================================= */

.an {
    height: 100%;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    gap: 14px;
    animation: anFade .35s ease both;
}

@keyframes anFade {
    from { opacity:0; transform:translateY(8px); }
    to   { opacity:1; transform:translateY(0); }
}

/* =========================================================
   TOPBAR — fix
========================================================= */

.an-topbar {
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

.an-topbar-left h3 {
    font-size: 18px;
    font-weight: 800;
    color: var(--text);
    margin: 0 0 2px;
    letter-spacing: -.2px;
}

.an-topbar-left p {
    font-size: 12px;
    color: var(--soft);
    margin: 0;
}

.btn-export {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 10px 18px;
    border-radius: 12px;
    background: linear-gradient(135deg, var(--g1), var(--g2));
    color: white;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    transition: .2s;
    box-shadow: 0 4px 12px rgba(10,127,46,.25);
    white-space: nowrap;
    flex-shrink: 0;
}

.btn-export:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(10,127,46,.3);
    color: white;
}

/* =========================================================
   SCROLL
========================================================= */

.an-scroll {
    flex: 1;
    overflow-y: auto;
    overflow-x: hidden;
    padding-right: 2px;
    padding-bottom: 24px;
    scrollbar-width: thin;
    scrollbar-color: #e5e7eb transparent;
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.an-scroll::-webkit-scrollbar { width: 5px; }
.an-scroll::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 20px; }

/* =========================================================
   STAT CARDS
========================================================= */

.stat-row {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 12px;
}

.stat-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 18px;
    transition: .2s;
    box-shadow: 0 2px 8px rgba(15,23,42,.03);
    position: relative;
    overflow: hidden;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0;
    width: 4px; height: 100%;
    border-radius: 4px 0 0 4px;
}

.stat-card.sc-green::before { background: var(--g2); }
.stat-card.sc-blue::before  { background: #3b82f6; }
.stat-card.sc-amber::before { background: #f59e0b; }
.stat-card.sc-red::before   { background: #ef4444; }

.stat-card:hover { transform: translateY(-3px); box-shadow: 0 10px 24px rgba(15,23,42,.07); }

.stat-top {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 12px;
}

.stat-icon {
    width: 40px; height: 40px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 17px;
    flex-shrink: 0;
}

.si-green { background: #dcfce7; color: var(--g1); }
.si-blue  { background: #dbeafe; color: #1d4ed8; }
.si-amber { background: #fef3c7; color: #b45309; }
.si-red   { background: #fee2e2; color: #dc2626; }

.stat-num   { font-size: 28px; font-weight: 800; color: var(--text); line-height: 1; margin-bottom: 3px; }
.stat-label { font-size: 12px; color: var(--soft); font-weight: 500; }

/* =========================================================
   CHART GRID
========================================================= */

.chart-grid {
    display: grid;
    grid-template-columns: 1.5fr 1fr;
    gap: 14px;
}

.chart-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 20px;
    box-shadow: 0 2px 8px rgba(15,23,42,.03);
}

.chart-head {
    margin-bottom: 16px;
    padding-bottom: 12px;
    border-bottom: 1px solid #f3f4f6;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.chart-head-left h5 {
    font-size: 14px;
    font-weight: 700;
    color: var(--text);
    margin: 0 0 2px;
}

.chart-head-left p {
    font-size: 11.5px;
    color: var(--soft);
    margin: 0;
}

.chart-wrap { position: relative; height: 230px; }
.donut-wrap { position: relative; height: 230px; }

/* =========================================================
   INSIGHT BOX
========================================================= */

.insight-box {
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    border-radius: 16px;
    padding: 16px 20px;
    display: flex;
    gap: 14px;
    align-items: flex-start;
}

.insight-icon {
    width: 42px; height: 42px;
    border-radius: 12px;
    background: linear-gradient(135deg, var(--g1), var(--g2));
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    flex-shrink: 0;
}

.insight-body h6 {
    font-size: 13px;
    font-weight: 700;
    color: var(--g1);
    margin: 0 0 4px;
    text-transform: uppercase;
    letter-spacing: .4px;
}

.insight-body p {
    font-size: 13.5px;
    color: #166534;
    margin: 0;
    line-height: 1.6;
}

/* =========================================================
   BOTTOM GRID
========================================================= */

.bottom-grid {
    display: grid;
    grid-template-columns: 300px 1fr;
    gap: 14px;
    align-items: start;
}

.bottom-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(15,23,42,.03);
}

.bottom-card-head {
    padding: 14px 18px;
    border-bottom: 1px solid #f3f4f6;
    font-size: 13.5px;
    font-weight: 700;
    color: var(--text);
    display: flex;
    align-items: center;
    gap: 7px;
}

.bottom-card-head i { color: var(--g2); }

/* Kategori */
.kategori-content {
    padding: 20px 18px;
    display: flex;
    align-items: center;
    gap: 14px;
}

.kategori-icon-wrap {
    width: 56px; height: 56px;
    border-radius: 16px;
    background: #dcfce7;
    color: var(--g1);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    flex-shrink: 0;
}

.kategori-info h4 {
    font-size: 17px;
    font-weight: 800;
    color: var(--text);
    margin: 0 0 4px;
}

.kategori-info p {
    font-size: 12px;
    color: var(--soft);
    margin: 0;
}

/* Table */
.an-table { margin: 0; }

.an-table thead th {
    background: #f9fafb;
    border: none;
    font-size: 11px;
    font-weight: 700;
    color: #9ca3af;
    text-transform: uppercase;
    letter-spacing: .5px;
    padding: 11px 16px;
}

.an-table tbody td {
    padding: 11px 16px;
    border-top: 1px solid #f3f4f6;
    font-size: 13px;
    vertical-align: middle;
    color: var(--text);
    border-bottom: none;
}

.an-table tbody tr:hover { background: #fafcfa; }

.judul-td {
    max-width: 260px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    font-weight: 500;
}

.s-pill { padding: 4px 10px; border-radius: 20px; font-size: 10.5px; font-weight: 700; }
.s-selesai { background: #dcfce7; color: #15803d; }
.s-proses  { background: #fef3c7; color: #b45309; }
.s-pending { background: #fee2e2; color: #dc2626; }

/* =========================================================
   RESPONSIVE — TABLET
========================================================= */

@media(min-width:769px) and (max-width:1024px){
    .stat-row   { grid-template-columns: repeat(2,1fr); }
    .chart-grid { grid-template-columns: 1fr; }
    .bottom-grid{ grid-template-columns: 1fr; }
    .an-topbar  { padding: 14px 18px; }
    .an-topbar-left h3 { font-size: 16px; }
}

/* =========================================================
   RESPONSIVE — MOBILE
========================================================= */

@media(max-width:768px){

    .an { gap: 12px; }
    .an-topbar { padding: 12px 16px; border-radius: 14px; }
    .an-topbar-left h3 { font-size: 15px; }

    .btn-export { padding: 8px 13px; font-size: 12px; }

    .stat-row   { grid-template-columns: repeat(2,1fr); gap: 8px; }
    .stat-card  { padding: 14px 12px; }
    .stat-num   { font-size: 22px; }

    .chart-grid  { grid-template-columns: 1fr; }
    .chart-wrap  { height: 180px; }
    .donut-wrap  { height: 200px; }

    .bottom-grid { grid-template-columns: 1fr; }

    .insight-box { padding: 14px 16px; }
    .insight-body p { font-size: 13px; }

}

@media(max-width:400px){
    .stat-icon { width: 32px; height: 32px; font-size: 14px; }
    .stat-num  { font-size: 20px; }
    .btn-export span { display: none; }
}

</style>

<div class="an">

    {{-- TOPBAR FIX --}}
    <div class="an-topbar">
        <div class="an-topbar-left">
            <h3>Analisis Laporan</h3>
            <p>Monitoring statistik dan performa penanganan laporan siswa</p>
        </div>
        <a href="/guru/analisis/pdf" class="btn-export">
            <i class="bi bi-download"></i>
            <span>Export PDF</span>
        </a>
    </div>

    {{-- SCROLL AREA --}}
    <div class="an-scroll">

        {{-- STAT CARDS --}}
        <div class="stat-row">
            <div class="stat-card sc-green">
                <div class="stat-top">
                    <div class="stat-icon si-green"><i class="bi bi-journal-text"></i></div>
                </div>
                <div class="stat-num">{{ $totalLaporan }}</div>
                <div class="stat-label">Total Laporan</div>
            </div>
            <div class="stat-card sc-blue">
                <div class="stat-top">
                    <div class="stat-icon si-blue"><i class="bi bi-check-circle"></i></div>
                </div>
                <div class="stat-num">{{ $selesai }}</div>
                <div class="stat-label">Selesai</div>
            </div>
            <div class="stat-card sc-amber">
                <div class="stat-top">
                    <div class="stat-icon si-amber"><i class="bi bi-clock-history"></i></div>
                </div>
                <div class="stat-num">{{ $diproses }}</div>
                <div class="stat-label">Diproses</div>
            </div>
            <div class="stat-card sc-red">
                <div class="stat-top">
                    <div class="stat-icon si-red"><i class="bi bi-exclamation-circle"></i></div>
                </div>
                <div class="stat-num">{{ $pending }}</div>
                <div class="stat-label">Pending</div>
            </div>
        </div>

        {{-- CHARTS --}}
        <div class="chart-grid">
            <div class="chart-card">
                <div class="chart-head">
                    <div class="chart-head-left">
                        <h5>Tren Bulanan</h5>
                        <p>Laporan masuk 6 bulan terakhir</p>
                    </div>
                </div>
                <div class="chart-wrap">
                    <canvas id="trenChart"></canvas>
                </div>
            </div>

            <div class="chart-card">
                <div class="chart-head">
                    <div class="chart-head-left">
                        <h5>Persentase Status</h5>
                        <p>Distribusi status penanganan</p>
                    </div>
                </div>
                <div class="donut-wrap">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>

        {{-- INSIGHT --}}
        <div class="insight-box">
            <div class="insight-icon">
                <i class="bi bi-lightbulb"></i>
            </div>
            <div class="insight-body">
                <h6>Insight Sistem</h6>
                <p>
                    @if($pending > $selesai)
                        Jumlah laporan pending masih cukup tinggi. Disarankan meningkatkan kecepatan respon Guru BK agar penanganan lebih optimal.
                    @else
                        Tingkat penyelesaian laporan cukup baik. Sistem penanganan berjalan dengan optimal. Pertahankan performa ini!
                    @endif
                </p>
            </div>
        </div>

        {{-- BOTTOM GRID --}}
        <div class="bottom-grid">

            {{-- KATEGORI TERBANYAK --}}
            <div class="bottom-card">
                <div class="bottom-card-head">
                    <i class="bi bi-bar-chart"></i>
                    Kategori Terbanyak
                </div>
                <div class="kategori-content">
                    <div class="kategori-icon-wrap">
                        <i class="bi bi-folder2-open"></i>
                    </div>
                    <div class="kategori-info">
                        <h4>{{ $kategoriTerbanyak->nama_kategori ?? '-' }}</h4>
                        <p>{{ $kategoriTerbanyak->pengaduan_count ?? 0 }} laporan ditemukan</p>
                    </div>
                </div>
            </div>

            {{-- LAPORAN TERBARU --}}
            <div class="bottom-card">
                <div class="bottom-card-head">
                    <i class="bi bi-clock-history"></i>
                    Laporan Terbaru
                </div>
                <div class="table-responsive">
                    <table class="an-table table">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($laporanTerbaru as $item)
                            <tr>
                                <td><div class="judul-td">{{ $item->judul }}</div></td>
                                <td>
                                    <span class="s-pill s-{{ $item->status }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="text-center text-muted py-4">
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

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

new Chart(document.getElementById('trenChart'), {
    type: 'line',
    data: {
        labels: ['Jan','Feb','Mar','Apr','Mei','Jun'],
        datasets: [{
            data: [12,19,14,17,25,22],
            borderColor: '#16a34a',
            backgroundColor: 'rgba(22,163,74,0.07)',
            fill: true, tension: 0.4,
            pointRadius: 4,
            pointBackgroundColor: '#16a34a',
            borderWidth: 2,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true, grid: { color: '#f3f4f6' }, ticks: { font: { size: 11 } } },
            x: { grid: { display: false }, ticks: { font: { size: 11 } } }
        }
    }
});

new Chart(document.getElementById('statusChart'), {
    type: 'doughnut',
    data: {
        labels: ['Selesai','Diproses','Pending'],
        datasets: [{
            data: [{{ $selesai }}, {{ $diproses }}, {{ $pending }}],
            backgroundColor: ['#16a34a','#f59e0b','#ef4444'],
            borderWidth: 0,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { position: 'bottom', labels: { font: { size: 12 }, padding: 14 } }
        },
        cutout: '70%'
    }
});

</script>

@endsection