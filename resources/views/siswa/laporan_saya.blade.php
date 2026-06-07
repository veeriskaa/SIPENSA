@extends('layouts.siswa')

@section('title','Laporan Saya')

@section('content')

<div class="lp-page">

    {{-- HEADER FIX --}}
    <div class="lp-header">
        <div class="lp-header-left">
            <div class="lp-header-icon">
                <i class="bi bi-journal-text"></i>
            </div>
            <div>
                <h3 class="lp-title">Laporan Saya</h3>
                <p class="lp-sub">Riwayat laporan yang telah dikirim beserta status penanganannya</p>
            </div>
        </div>
        <a href="/buat-laporan" class="btn-buat">
            <i class="bi bi-plus-lg"></i>
            Buat Laporan
        </a>
    </div>


    {{-- FILTER --}}
    <div class="filter-bar">
        <div class="filter-tabs" id="filterTabs">
            <button class="ftab active" data-filter="semua">Semua</button>
            <button class="ftab" data-filter="proses">
                <span class="ftab-dot" style="background:#d97706"></span>Proses
            </button>
            <button class="ftab" data-filter="selesai">
                <span class="ftab-dot" style="background:#16a34a"></span>Selesai
            </button>
            <button class="ftab" data-filter="pending">
                <span class="ftab-dot" style="background:#dc2626"></span>Pending
            </button>
        </div>
        <span class="result-label" id="resultLabel">{{ $laporans->count() }} laporan</span>
    </div>

    {{-- SCROLL AREA --}}
    <div class="lp-scroll">

        <div class="laporan-list" id="laporanList">

            @forelse($laporans as $item)

            <div class="lap-card" data-status="{{ strtolower($item->status) }}">

                {{-- ACCENT --}}
                <div class="lap-accent
                    @if($item->status=='proses') acc-proses
                    @elseif($item->status=='selesai') acc-selesai
                    @else acc-pending
                    @endif
                "></div>

                {{-- BODY --}}
                <div class="lap-body">

                    <div class="lap-top">
                        <div class="lap-meta">
                            <span class="kategori-pill">
                                <i class="bi bi-tag-fill"></i>
                                {{ $item->kategori ?? 'Laporan' }}
                            </span>
                            <span class="lap-time">
                                <i class="bi bi-clock"></i>
                                {{ $item->created_at->diffForHumans() }}
                            </span>
                        </div>

                        @if($item->status=='proses')
                            <span class="s-badge s-proses">
                                <i class="bi bi-clock-history"></i> Proses
                            </span>
                        @elseif($item->status=='selesai')
                            <span class="s-badge s-selesai">
                                <i class="bi bi-check-circle-fill"></i> Selesai
                            </span>
                        @else
                            <span class="s-badge s-pending">
                                <i class="bi bi-exclamation-circle-fill"></i> Pending
                            </span>
                        @endif
                    </div>

                    <h5 class="lap-title">{{ $item->judul }}</h5>

                    <p class="lap-desc">
                        {{ \Illuminate\Support\Str::limit($item->deskripsi, 140) }}
                    </p>

                    <div class="lap-footer">
                        @if($item->tanggapan)
                            <span class="tanggapan-hint has">
                                <i class="bi bi-chat-left-text-fill"></i> Ada tanggapan
                            </span>
                        @else
                            <span class="tanggapan-hint">
                                <i class="bi bi-chat-left-text"></i> Belum ada tanggapan
                            </span>
                        @endif

                        <a href="/pengaduan/{{ $item->id }}" class="btn-detail">
                            Lihat Detail <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>

                </div>

            </div>

            @empty

            <div class="empty-state">
                <div class="empty-icon"><i class="bi bi-inbox"></i></div>
                <h5>Belum Ada Laporan</h5>
                <p>Laporan yang kamu kirim akan muncul di sini</p>
                <a href="/buat-laporan" class="btn-buat mt-3">
                    <i class="bi bi-plus-lg"></i> Buat Laporan Pertama
                </a>
            </div>

            @endforelse

        </div>

        {{-- EMPTY FILTER --}}
        <div class="empty-filter" id="emptyFilter" style="display:none">
            <i class="bi bi-funnel"></i>
            <p>Tidak ada laporan dengan status ini</p>
        </div>

    </div>{{-- end lp-scroll --}}

</div>

<style>

/* =============================================
   PAGE
============================================= */
.lp-page {
    display: flex;
    flex-direction: column;
    height: 100%;
    overflow: hidden;
    gap: 14px;
}

/* =============================================
   HEADER FIX
============================================= */
.lp-header {
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 14px;
    background: #fff;
    border: 1px solid #edf1f5;
    border-radius: 18px;
    padding: 18px 22px;
    box-shadow: 0 2px 10px rgba(15,23,42,.04);
    flex-wrap: wrap;
}

.lp-header-left {
    display: flex;
    align-items: center;
    gap: 14px;
}

.lp-header-icon {
    width: 44px; height: 44px;
    border-radius: 13px;
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    color: #16a34a;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
}

.lp-title {
    font-size: 18px;
    font-weight: 700;
    color: #111827;
    margin: 0 0 2px;
}

.lp-sub {
    font-size: 12px;
    color: #9ca3af;
    margin: 0;
}

.btn-buat {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    background: #16a34a;
    color: white;
    text-decoration: none;
    padding: 10px 18px;
    border-radius: 12px;
    font-size: 13px;
    font-weight: 600;
    transition: .2s;
    white-space: nowrap;
}

.btn-buat:hover {
    background: #15803d;
    color: white;
    transform: translateY(-1px);
}


/* =============================================
   FILTER BAR
============================================= */
.filter-bar {
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    flex-wrap: wrap;
}

.filter-tabs {
    display: flex;
    background: #f3f4f6;
    border-radius: 12px;
    padding: 4px;
    gap: 2px;
}

.ftab {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 7px 14px;
    border-radius: 9px;
    border: none;
    background: transparent;
    font-size: 13px;
    font-weight: 500;
    color: #6b7280;
    cursor: pointer;
    transition: .2s;
}

.ftab.active {
    background: #fff;
    color: #111827;
    font-weight: 600;
    box-shadow: 0 1px 4px rgba(15,23,42,.08);
}

.ftab:hover:not(.active) { color: #374151; }

.ftab-dot {
    width: 7px; height: 7px;
    border-radius: 50%;
    flex-shrink: 0;
}

.result-label {
    font-size: 12px;
    color: #9ca3af;
}

/* =============================================
   SCROLL
============================================= */
.lp-scroll {
    flex: 1;
    overflow-y: auto;
    overflow-x: hidden;
    min-height: 0;
    padding-bottom: 24px;
    scrollbar-width: thin;
    scrollbar-color: #e5e7eb transparent;
}

.lp-scroll::-webkit-scrollbar { width: 5px; }
.lp-scroll::-webkit-scrollbar-thumb { background: #e5e7eb; border-radius: 99px; }

/* =============================================
   LIST
============================================= */
.laporan-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

/* =============================================
   CARD
============================================= */
.lap-card {
    background: #fff;
    border-radius: 18px;
    border: 1px solid #edf1f5;
    display: flex;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(15,23,42,.04);
    transition: .25s;
    animation: cardIn .3s ease both;
}

@keyframes cardIn {
    from { opacity: 0; transform: translateY(6px); }
    to   { opacity: 1; transform: translateY(0); }
}

.lap-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(15,23,42,.08);
    border-color: #d1fae5;
}

.lap-accent {
    width: 5px;
    flex-shrink: 0;
}

.acc-proses  { background: #d97706; }
.acc-selesai { background: #16a34a; }
.acc-pending { background: #dc2626; }

.lap-body {
    flex: 1;
    padding: 18px 20px;
    min-width: 0;
}

/* TOP */
.lap-top {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 10px;
    margin-bottom: 10px;
    flex-wrap: wrap;
}

.lap-meta {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}

.kategori-pill {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    background: #f0fdf4;
    color: #15803d;
    border: 1px solid #bbf7d0;
    padding: 4px 10px;
    border-radius: 30px;
    font-size: 11px;
    font-weight: 500;
}

.lap-time {
    font-size: 11px;
    color: #9ca3af;
    display: flex;
    align-items: center;
    gap: 4px;
}

/* STATUS */
.s-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 5px 11px;
    border-radius: 30px;
    font-size: 11px;
    font-weight: 600;
    flex-shrink: 0;
}

.s-proses  { background: #fffbeb; color: #d97706; border: 1px solid #fde68a; }
.s-selesai { background: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0; }
.s-pending { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }

.lap-title {
    font-size: 15px;
    font-weight: 700;
    color: #111827;
    margin: 0 0 6px;
    line-height: 1.4;
}

.lap-desc {
    font-size: 13px;
    color: #6b7280;
    line-height: 1.7;
    margin: 0 0 14px;
}

/* FOOTER */
.lap-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 10px;
    padding-top: 12px;
    border-top: 1px solid #f9fafb;
    flex-wrap: wrap;
}

.tanggapan-hint {
    font-size: 12px;
    color: #9ca3af;
    display: flex;
    align-items: center;
    gap: 5px;
}

.tanggapan-hint.has {
    color: #16a34a;
    font-weight: 500;
}

.btn-detail {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #16a34a;
    color: white;
    text-decoration: none;
    padding: 8px 14px;
    border-radius: 10px;
    font-size: 12px;
    font-weight: 600;
    transition: .2s;
}

.btn-detail:hover {
    background: #15803d;
    color: white;
    gap: 9px;
}

/* =============================================
   EMPTY
============================================= */
.empty-state {
    text-align: center;
    padding: 60px 20px;
    background: #fff;
    border-radius: 20px;
    border: 1px dashed #d1d5db;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.empty-icon {
    width: 68px; height: 68px;
    border-radius: 50%;
    background: #f9fafb;
    border: 1px solid #f3f4f6;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 30px;
    color: #d1d5db;
    margin-bottom: 16px;
}

.empty-state h5 { font-size: 17px; font-weight: 700; color: #374151; margin: 0 0 6px; }
.empty-state p  { font-size: 13px; color: #9ca3af; margin: 0; }

.empty-filter {
    text-align: center;
    padding: 36px 20px;
    color: #9ca3af;
}

.empty-filter i  { font-size: 28px; display: block; margin-bottom: 8px; }
.empty-filter p  { font-size: 13px; margin: 0; }

/* =============================================
   RESPONSIVE
============================================= */
@media (max-width: 640px) {

    .lp-header { padding: 14px 16px; border-radius: 14px; }
    .lp-header-icon { width: 38px; height: 38px; font-size: 17px; }
    .lp-title { font-size: 16px; }

    .btn-buat { width: 100%; justify-content: center; }


    .filter-tabs { width: 100%; justify-content: space-between; }
    .ftab { flex: 1; justify-content: center; padding: 7px 8px; font-size: 12px; }

    .lap-body { padding: 14px; }
    .lap-title { font-size: 14px; }
    .lap-top { flex-direction: column; align-items: flex-start; }

    .lap-footer { flex-direction: column; align-items: flex-start; }
    .btn-detail { width: 100%; justify-content: center; }
}

</style>

<script>
const tabs       = document.querySelectorAll('.ftab');
const cards      = document.querySelectorAll('.lap-card');
const resultLabel = document.getElementById('resultLabel');
const emptyFilter = document.getElementById('emptyFilter');

tabs.forEach(tab => {
    tab.addEventListener('click', function () {
        tabs.forEach(t => t.classList.remove('active'));
        this.classList.add('active');

        const filter = this.dataset.filter;
        let visible  = 0;

        cards.forEach(card => {
            const match = filter === 'semua' || card.dataset.status === filter;
            card.style.display = match ? 'flex' : 'none';
            if (match) visible++;
        });

        resultLabel.textContent = visible + ' laporan';
        emptyFilter.style.display = visible === 0 ? 'block' : 'none';
    });
});
</script>

@endsection