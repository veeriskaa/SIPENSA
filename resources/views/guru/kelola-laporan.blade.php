@extends('layouts.guru')

@section('title','Kelola Laporan')

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

.kl * { box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }

/* =============================================
   PAGE
============================================= */
.kl {
    height: 100%;
    display: flex;
    flex-direction: column;
    gap: 14px;
    animation: klFade .35s ease both;
}

@keyframes klFade {
    from { opacity:0; transform:translateY(8px); }
    to   { opacity:1; transform:translateY(0); }
}

/* =============================================
   HEADER FIX
============================================= */
.kl-header {
    flex-shrink: 0;
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 18px;
    padding: 18px 22px;
    box-shadow: 0 2px 10px rgba(15,23,42,.04);
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 14px;
    flex-wrap: wrap;
}

.kl-header-left {
    display: flex;
    align-items: center;
    gap: 14px;
}

.kl-header-icon {
    width: 44px; height: 44px;
    border-radius: 13px;
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    color: var(--g1);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
}

.kl-title { font-size: 18px; font-weight: 700; color: var(--text); margin: 0 0 2px; }
.kl-sub   { font-size: 12px; color: #9ca3af; margin: 0; }

.kl-header-stats {
    display: flex;
    align-items: center;
    gap: 6px;
}

.hstat {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 8px 14px;
    border-radius: 12px;
    border: 1px solid var(--border);
    background: #f9fafb;
    min-width: 64px;
}

.hstat-num   { font-size: 18px; font-weight: 800; line-height: 1; }
.hstat-label { font-size: 10px; color: #9ca3af; font-weight: 500; margin-top: 2px; }

.hstat-sep { width: 1px; height: 28px; background: #f3f4f6; }

/* =============================================
   FILTER FIX
============================================= */
.kl-filter {
    flex-shrink: 0;
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 16px 20px;
    box-shadow: 0 2px 8px rgba(15,23,42,.03);
}

.filter-row {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}

.filter-select, .filter-input {
    height: 40px;
    border: 1.5px solid var(--border);
    border-radius: 11px;
    padding: 0 14px;
    font-size: 13px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    color: var(--text);
    background: #f9fafb;
    outline: none;
    transition: .2s;
    appearance: none;
    -webkit-appearance: none;
}

.filter-select {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' fill='none'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%239ca3af' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 12px center;
    padding-right: 34px;
    cursor: pointer;
    min-width: 150px;
}

.filter-input { flex: 1; min-width: 160px; }

.filter-select:focus, .filter-input:focus {
    border-color: var(--g1);
    background: white;
    box-shadow: 0 0 0 3px rgba(10,127,46,.07);
}

.filter-select::placeholder, .filter-input::placeholder { color: #b0b8c1; }

.btn-filter {
    height: 40px;
    padding: 0 18px;
    border-radius: 11px;
    border: none;
    background: linear-gradient(135deg, var(--g1), var(--g2));
    color: white;
    font-size: 13px;
    font-weight: 600;
    font-family: 'Plus Jakarta Sans', sans-serif;
    display: inline-flex;
    align-items: center;
    gap: 7px;
    cursor: pointer;
    transition: .2s;
    box-shadow: 0 3px 10px rgba(10,127,46,.2);
    white-space: nowrap;
}

.btn-filter:hover { transform: translateY(-1px); box-shadow: 0 6px 16px rgba(10,127,46,.28); }

.btn-reset {
    height: 40px;
    padding: 0 16px;
    border-radius: 11px;
    border: 1.5px solid var(--border);
    background: white;
    color: var(--soft);
    font-size: 13px;
    font-weight: 600;
    font-family: 'Plus Jakarta Sans', sans-serif;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    text-decoration: none;
    transition: .2s;
    white-space: nowrap;
}

.btn-reset:hover { background: #f9fafb; color: var(--text); border-color: #9ca3af; }

/* Filter pills (active filter indicator) */
.active-filters { display: flex; gap: 6px; flex-wrap: wrap; margin-top: 10px; }

.filter-pill {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    color: #15803d;
    padding: 4px 10px;
    border-radius: 30px;
    font-size: 11.5px;
    font-weight: 500;
}

/* =============================================
   SCROLL
============================================= */
.kl-scroll {
    flex: 1;
    overflow-y: auto;
    overflow-x: hidden;
    min-height: 0;
    padding-bottom: 24px;
    scrollbar-width: thin;
    scrollbar-color: #e5e7eb transparent;
}

.kl-scroll::-webkit-scrollbar { width: 5px; }
.kl-scroll::-webkit-scrollbar-thumb { background: #e5e7eb; border-radius: 99px; }

/* =============================================
   RESULT INFO
============================================= */
.result-info {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 12px;
    flex-wrap: wrap;
    gap: 8px;
}

.result-count { font-size: 13px; color: #9ca3af; font-weight: 500; }

/* =============================================
   CARD LIST
============================================= */
.laporan-list { display: flex; flex-direction: column; gap: 12px; }

.lap-card {
    background: white;
    border-radius: 18px;
    border: 1px solid var(--border);
    display: flex;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(15,23,42,.04);
    transition: .25s;
    animation: cardIn .3s ease both;
}

@keyframes cardIn {
    from { opacity:0; transform:translateY(6px); }
    to   { opacity:1; transform:translateY(0); }
}

.lap-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(15,23,42,.08);
    border-color: #d1fae5;
}

/* ACCENT */
.lap-accent { width: 5px; flex-shrink: 0; }
.acc-pending { background: #ef4444; }
.acc-proses  { background: #f59e0b; }
.acc-selesai { background: #16a34a; }

/* BODY */
.lap-body { flex: 1; padding: 18px 20px; min-width: 0; }

/* TOP */
.lap-top {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 10px;
    flex-wrap: wrap;
}

.lap-title-row {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
}

.lap-title { font-size: 15px; font-weight: 700; color: var(--text); margin: 0; line-height: 1.4; }

.kat-pill {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 3px 10px;
    border-radius: 30px;
    font-size: 11px;
    font-weight: 600;
    flex-shrink: 0;
}

.kat-bullying  { background: #fee2e2; color: #dc2626; }
.kat-fasilitas { background: #dbeafe; color: #2563eb; }
.kat-akademik  { background: #fef3c7; color: #d97706; }
.kat-kekerasan { background: #f3e8ff; color: #7c3aed; }
.kat-default   { background: #f0fdf4; color: #16a34a; }

.s-badge { padding: 6px 12px; border-radius: 30px; font-size: 11px; font-weight: 600; display: inline-flex; align-items: center; gap: 5px; flex-shrink: 0; }
.s-pending { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }
.s-proses  { background: #fffbeb; color: #d97706; border: 1px solid #fde68a; }
.s-selesai { background: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0; }

/* META */
.lap-meta {
    display: flex;
    align-items: center;
    gap: 14px;
    flex-wrap: wrap;
    margin-bottom: 10px;
}

.lap-meta span {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 12px;
    color: #9ca3af;
}

.lap-meta i { font-size: 12px; }

/* DESC */
.lap-desc { font-size: 13px; color: #6b7280; line-height: 1.7; margin: 0 0 14px; }

/* FOOTER */
.lap-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    padding-top: 12px;
    border-top: 1px solid #f9fafb;
    flex-wrap: wrap;
}

.lap-location {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 12px;
    color: #9ca3af;
}

.lap-actions { display: flex; gap: 8px; }

.btn-detail {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 14px;
    border-radius: 10px;
    border: 1.5px solid var(--border);
    background: white;
    color: var(--text);
    font-size: 12px;
    font-weight: 600;
    text-decoration: none;
    transition: .2s;
}

.btn-detail:hover { background: #f9fafb; border-color: #9ca3af; color: var(--text); }

.btn-respon {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    border-radius: 10px;
    border: none;
    background: linear-gradient(135deg, var(--g1), var(--g2));
    color: white;
    font-size: 12px;
    font-weight: 600;
    text-decoration: none;
    transition: .2s;
    box-shadow: 0 3px 10px rgba(10,127,46,.2);
}

.btn-respon:hover { transform: translateY(-1px); box-shadow: 0 6px 14px rgba(10,127,46,.28); color: white; }

/* =============================================
   EMPTY STATE
============================================= */
.empty-state {
    text-align: center;
    padding: 60px 20px;
    background: white;
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
    display: flex; align-items: center; justify-content: center;
    font-size: 28px; color: #d1d5db;
    margin-bottom: 16px;
}

.empty-state h5 { font-size: 17px; font-weight: 700; color: #374151; margin: 0 0 6px; }
.empty-state p  { font-size: 13px; color: #9ca3af; margin: 0; }

/* =============================================
   RESPONSIVE
============================================= */
@media (max-width: 768px) {
    .kl { gap: 12px; }
    .kl-header { padding: 14px 16px; border-radius: 14px; }
    .kl-header-icon { width: 38px; height: 38px; font-size: 17px; }
    .kl-title { font-size: 16px; }
    .kl-header-stats { display: none; }

    .kl-filter { padding: 14px; border-radius: 14px; }
    .filter-row { flex-direction: column; align-items: stretch; }
    .filter-select { min-width: unset; width: 100%; }
    .filter-input  { width: 100%; }
    .btn-filter, .btn-reset { width: 100%; justify-content: center; }

    .lap-body { padding: 14px; }
    .lap-top  { flex-direction: column; align-items: flex-start; }
    .lap-footer { flex-direction: column; align-items: flex-start; }
    .lap-actions { width: 100%; }
    .btn-detail, .btn-respon { flex: 1; justify-content: center; }
}

</style>

<div class="kl">

    {{-- HEADER FIX --}}
    <div class="kl-header">
        <div class="kl-header-left">
            <div class="kl-header-icon">
                <i class="bi bi-journal-text"></i>
            </div>
            <div>
                <h3 class="kl-title">Kelola Laporan</h3>
                <p class="kl-sub">Kelola seluruh laporan siswa secara realtime</p>
            </div>
        </div>

        <div class="kl-header-stats">
            @php
    $total   = $laporan->count();
    $pending = \App\Models\Pengaduan::where('status','pending')->count();
    $proses  = \App\Models\Pengaduan::where('status','proses')->count();
    $selesai = \App\Models\Pengaduan::where('status','selesai')->count();
@endphp
            <div class="hstat">
                <span class="hstat-num" style="color:var(--g1)">{{ $total }}</span>
                <span class="hstat-label">Total</span>
            </div>
            <div class="hstat-sep"></div>
            <div class="hstat">
                <span class="hstat-num" style="color:#dc2626">{{ $pending }}</span>
                <span class="hstat-label">Pending</span>
            </div>
            <div class="hstat-sep"></div>
            <div class="hstat">
                <span class="hstat-num" style="color:#d97706">{{ $proses }}</span>
                <span class="hstat-label">Proses</span>
            </div>
            <div class="hstat-sep"></div>
            <div class="hstat">
                <span class="hstat-num" style="color:#2563eb">{{ $selesai }}</span>
                <span class="hstat-label">Selesai</span>
            </div>
        </div>
    </div>

    {{-- FILTER FIX --}}
    <form method="GET" action="{{ route('guru.laporan') }}" class="kl-filter">
        <div class="filter-row">
            <select name="kategori" class="filter-select">
                <option value="">Semua Kategori</option>
                <option value="Bullying"   {{ request('kategori')=='Bullying'   ? 'selected':'' }}>🛡️ Bullying</option>
                <option value="Fasilitas"  {{ request('kategori')=='Fasilitas'  ? 'selected':'' }}>🏫 Fasilitas</option>
                <option value="Akademik"   {{ request('kategori')=='Akademik'   ? 'selected':'' }}>📚 Akademik</option>
                <option value="Kekerasan"  {{ request('kategori')=='Kekerasan'  ? 'selected':'' }}>⚠️ Kekerasan</option>
                <option value="Lainnya"    {{ request('kategori')=='Lainnya'    ? 'selected':'' }}>💬 Lainnya</option>
            </select>

            <select name="status" class="filter-select">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status')=='pending' ? 'selected':'' }}>Pending</option>
                <option value="proses"  {{ request('status')=='proses'  ? 'selected':'' }}>Proses</option>
                <option value="selesai" {{ request('status')=='selesai' ? 'selected':'' }}>Selesai</option>
            </select>

            <input type="text" name="search" value="{{ request('search') }}"
                   class="filter-input" placeholder="🔍 Cari judul atau nama siswa...">

            <button type="submit" class="btn-filter">
                <i class="bi bi-funnel-fill"></i> Filter
            </button>

            <a href="{{ route('guru.laporan') }}" class="btn-reset">
                <i class="bi bi-arrow-counterclockwise"></i> Reset
            </a>
        </div>

        {{-- Active filter pills --}}
        @if(request('kategori') || request('status') || request('search'))
        <div class="active-filters">
            @if(request('kategori'))
                <span class="filter-pill"><i class="bi bi-tag-fill"></i> {{ request('kategori') }}</span>
            @endif
            @if(request('status'))
                <span class="filter-pill"><i class="bi bi-circle-fill" style="font-size:7px"></i> {{ ucfirst(request('status')) }}</span>
            @endif
            @if(request('search'))
                <span class="filter-pill"><i class="bi bi-search"></i> "{{ request('search') }}"</span>
            @endif
        </div>
        @endif
    </form>

    {{-- SCROLL --}}
    <div class="kl-scroll">

        <div class="result-info">
            <span class="result-count">
                {{ $laporan->count() }} laporan ditemukan
            </span>
        </div>

        <div class="laporan-list">

            @forelse($laporan as $item)

            <div class="lap-card">

                {{-- ACCENT --}}
                <div class="lap-accent
                    @if($item->status=='pending') acc-pending
                    @elseif($item->status=='proses') acc-proses
                    @else acc-selesai
                    @endif
                "></div>

                {{-- BODY --}}
                <div class="lap-body">

                    <div class="lap-top">
                        <div>
                            <div class="lap-title-row">
                                <h5 class="lap-title">{{ $item->judul }}</h5>
                                @php
                                    $katClass = match(strtolower($item->kategori ?? '')) {
                                        'bullying'  => 'kat-bullying',
                                        'fasilitas' => 'kat-fasilitas',
                                        'akademik'  => 'kat-akademik',
                                        'kekerasan' => 'kat-kekerasan',
                                        default     => 'kat-default',
                                    };
                                @endphp
                                <span class="kat-pill {{ $katClass }}">{{ $item->kategori ?? 'Laporan' }}</span>
                            </div>
                        </div>

                        @if($item->status=='selesai')
                            <span class="s-badge s-selesai"><i class="bi bi-check-circle-fill"></i> Selesai</span>
                        @elseif($item->status=='proses')
                            <span class="s-badge s-proses"><i class="bi bi-clock-history"></i> Diproses</span>
                        @else
                            <span class="s-badge s-pending"><i class="bi bi-exclamation-circle-fill"></i> Pending</span>
                        @endif
                    </div>

                    <div class="lap-meta">
                        <span><i class="bi bi-person-fill"></i> {{ $item->user->name ?? 'Siswa' }}</span>
                        <span><i class="bi bi-calendar3"></i> {{ $item->created_at->format('d M Y') }}</span>
                        <span><i class="bi bi-clock"></i> {{ $item->created_at->diffForHumans() }}</span>
                    </div>

                    <p class="lap-desc">{{ \Illuminate\Support\Str::limit($item->deskripsi, 150) }}</p>

                    <div class="lap-footer">
                        <div class="lap-location">
                            <i class="bi bi-geo-alt"></i>
                            {{ $item->lokasi ?? 'SMKN 2 Marabahan' }}
                        </div>
                        <div class="lap-actions">
                            <a href="{{ route('pengaduan.show', $item->id) }}" class="btn-detail">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                            <a href="{{ route('guru.respon', $item->id) }}" class="btn-respon">
                                <i class="bi bi-reply-fill"></i> Tanggapi
                            </a>
                        </div>
                    </div>

                </div>

            </div>

            @empty

            <div class="empty-state">
                <div class="empty-icon"><i class="bi bi-inbox"></i></div>
                <h5>Belum Ada Laporan</h5>
                <p>Laporan siswa akan muncul di sini</p>
            </div>

            @endforelse

        </div>

        {{-- PAGINATION --}}
       @if(method_exists($laporan, 'hasPages') && $laporan->hasPages())
        <div style="margin-top:20px;">
            {{ $laporan->withQueryString()->links() }}
        </div>
        @endif

    </div>

</div>

@endsection