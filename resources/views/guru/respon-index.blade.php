@extends('layouts.guru')

@section('title','Respon Saya')

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

.rp * { box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }

/* =========================================================
   PAGE — flex column, tinggi penuh, tidak overflow
========================================================= */

.rp {
    height: 100%;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    animation: rpFade .35s ease both;
    gap: 16px;
}

@keyframes rpFade {
    from { opacity:0; transform:translateY(8px); }
    to   { opacity:1; transform:translateY(0); }
}

/* =========================================================
   TOPBAR — fix, tidak ikut scroll
========================================================= */

.rp-topbar {
    flex-shrink: 0;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 18px;
    padding: 0;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(15,23,42,.04);
}

/* Banner putih */
.rp-banner {
    background: white;
    padding: 18px 22px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 14px;
}

.banner-left h4 {
    font-size: 18px;
    font-weight: 800;
    color: var(--text);
    margin: 0 0 4px;
    letter-spacing: -.2px;
}

.banner-left p {
    font-size: 12.5px;
    color: var(--soft);
    margin: 0;
}

.banner-icon {
    width: 48px; height: 48px;
    border-radius: 14px;
    background: #dcfce7;
    color: var(--g1);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
}

/* Stat strip di bawah banner */
.rp-stat-strip {
    display: flex;
    padding: 0;
    border-top: 1px solid var(--border);
}

.stat-strip-item {
    flex: 1;
    padding: 12px 16px;
    text-align: center;
    border-right: 1px solid var(--border);
    transition: background .15s;
}

.stat-strip-item:last-child { border-right: none; }
.stat-strip-item:hover { background: #f9fbf9; }

.ssi-num {
    font-size: 20px;
    font-weight: 800;
    color: var(--text);
    line-height: 1;
    margin-bottom: 2px;
}

.ssi-lbl {
    font-size: 10.5px;
    color: var(--soft);
    font-weight: 500;
}

/* =========================================================
   SCROLL AREA — satu-satunya yang scroll
========================================================= */

.rp-scroll {
    flex: 1;
    overflow-y: auto;
    overflow-x: hidden;
    padding-right: 2px;
    padding-bottom: 24px;
    scrollbar-width: thin;
    scrollbar-color: #e5e7eb transparent;
}

.rp-scroll::-webkit-scrollbar { width: 5px; }
.rp-scroll::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 20px; }

/* =========================================================
   GRID CARD
========================================================= */

.rp-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 14px;
}

/* =========================================================
   CARD
========================================================= */

.rp-card {
    background: white;
    border: 1px solid var(--border);
    border-radius: 18px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    transition: .25s;
    box-shadow: 0 2px 10px rgba(15,23,42,.04);
    position: relative;
}

.rp-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 28px rgba(15,23,42,.08);
    border-color: #bbf7d0;
}

/* Accent bar atas */
.rp-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
}

.rp-card.ac-green::before  { background: linear-gradient(90deg, var(--g1), var(--g3)); }
.rp-card.ac-amber::before  { background: linear-gradient(90deg, #d97706, #fbbf24); }
.rp-card.ac-red::before    { background: linear-gradient(90deg, #dc2626, #f87171); }

/* =========================================================
   CARD HEAD
========================================================= */

.rp-card-head {
    padding: 16px 16px 12px;
    border-bottom: 1px solid #f3f4f6;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 8px;
}

.kategori-pill {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    background: #f0fdf4;
    color: var(--g1);
    border: 1px solid #bbf7d0;
    padding: 5px 11px;
    border-radius: 30px;
    font-size: 11px;
    font-weight: 700;
}

.status-pill {
    padding: 5px 11px;
    border-radius: 30px;
    font-size: 10.5px;
    font-weight: 700;
}

.sp-pending { background: #fee2e2; color: #dc2626; }
.sp-proses  { background: #fef3c7; color: #b45309; }
.sp-selesai { background: #dcfce7; color: #15803d; }

/* =========================================================
   CARD BODY
========================================================= */

.rp-card-body {
    padding: 14px 16px;
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.rp-judul {
    font-size: 14px;
    font-weight: 700;
    color: var(--text);
    line-height: 1.4;
    margin: 0;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.rp-meta {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}

.rp-meta-item {
    display: flex;
    align-items: center;
    gap: 4px;
    font-size: 11.5px;
    color: var(--soft);
}

.rp-meta-item i { font-size: 12px; color: #9ca3af; }

.rp-deskripsi {
    font-size: 12.5px;
    color: var(--soft);
    line-height: 1.6;
    margin: 0;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* =========================================================
   TANGGAPAN BOX
========================================================= */

.tanggapan-box {
    background: #f8fdf9;
    border: 1px solid #d1fae5;
    border-radius: 12px;
    padding: 11px 13px;
}

.tanggapan-head {
    display: flex;
    align-items: center;
    gap: 6px;
    margin-bottom: 6px;
}

.tanggapan-head i { color: var(--g2); font-size: 13px; }

.tanggapan-head span {
    font-size: 11px;
    font-weight: 700;
    color: var(--g1);
    text-transform: uppercase;
    letter-spacing: .5px;
}

.tanggapan-text {
    font-size: 12.5px;
    color: #374151;
    line-height: 1.6;
    margin: 0;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* =========================================================
   CARD FOOTER
========================================================= */

.rp-card-foot {
    padding: 12px 16px;
    border-top: 1px solid #f3f4f6;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 8px;
    background: #fafcfa;
}

.guru-chip {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 11.5px;
    color: var(--soft);
}

.guru-chip-avatar {
    width: 24px; height: 24px;
    border-radius: 7px;
    background: linear-gradient(135deg, var(--g1), var(--g2));
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 10px;
    font-weight: 700;
    flex-shrink: 0;
}

.foot-actions { display: flex; gap: 7px; }

.btn-edit {
    width: 32px; height: 32px;
    border-radius: 9px;
    background: #eef2ff;
    color: #4f46e5;
    border: 1px solid #e0e7ff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 13px;
    text-decoration: none;
    transition: .2s;
}

.btn-edit:hover { background: #4f46e5; color: white; border-color: #4f46e5; }

.btn-detail {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 7px 13px;
    border-radius: 9px;
    background: linear-gradient(135deg, var(--g1), var(--g2));
    color: white;
    font-size: 11.5px;
    font-weight: 700;
    text-decoration: none;
    transition: .2s;
    box-shadow: 0 2px 8px rgba(10,127,46,.2);
}

.btn-detail:hover {
    transform: translateY(-1px);
    box-shadow: 0 5px 14px rgba(10,127,46,.3);
    color: white;
}

/* =========================================================
   EMPTY STATE
========================================================= */

.rp-empty {
    grid-column: 1 / -1;
    background: white;
    border: 2px dashed var(--border);
    border-radius: 20px;
    padding: 60px 24px;
    text-align: center;
}

.rp-empty-icon {
    width: 72px; height: 72px;
    border-radius: 20px;
    background: #f0fdf4;
    color: var(--g2);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 30px;
    margin: 0 auto 16px;
}

.rp-empty h5 {
    font-size: 17px;
    font-weight: 700;
    color: var(--text);
    margin: 0 0 6px;
}

.rp-empty p {
    font-size: 13px;
    color: var(--soft);
    margin: 0;
}

/* =========================================================
   RESPONSIVE — TABLET
========================================================= */

@media(min-width:769px) and (max-width:1024px){
    .rp-grid { grid-template-columns: repeat(2, 1fr); }
    .rp-banner { padding: 16px 20px; }
    .banner-left h4 { font-size: 16px; }
    .stat-strip-item { padding: 10px 12px; }
    .ssi-num { font-size: 17px; }
}

/* =========================================================
   RESPONSIVE — MOBILE
========================================================= */

@media(max-width:768px){

    .rp { gap: 12px; }

    /* Topbar tetap fix, banner lebih compact */
    .rp-banner { padding: 14px 16px; }
    .banner-left h4 { font-size: 15px; }
    .banner-left p { font-size: 11.5px; }
    .banner-icon { width: 42px; height: 42px; font-size: 18px; border-radius: 12px; }


    /* Stat strip — 3 kolom */
    .stat-strip-item { padding: 9px 8px; }
    .ssi-num { font-size: 16px; }
    .ssi-lbl { font-size: 10px; }

    /* Grid jadi 1 kolom */
    .rp-grid { grid-template-columns: 1fr; gap: 10px; }

    .rp-card-head { padding: 12px 14px 10px; }
    .rp-card-body { padding: 12px 14px; }
    .rp-card-foot { padding: 10px 14px; }
    .rp-judul { font-size: 13.5px; }

}

@media(max-width:400px){
    .banner-icon { display: none; }
    .ssi-lbl { display: none; }
}

</style>

<div class="rp">

    {{-- TOPBAR FIX --}}
    <div class="rp-topbar">

        {{-- Banner --}}
        <div class="rp-banner">
            <div class="banner-left">
                <h4>Respon Saya</h4>
                <p>Daftar laporan siswa yang telah mendapat tanggapan dari Guru BK</p>
            </div>
            <div class="banner-icon">
                <i class="bi bi-chat-dots-fill"></i>
            </div>
        </div>

        {{-- Stat strip --}}
        <div class="rp-stat-strip">
            @php
                $total   = $laporan->count();
                $selesai = $laporan->where('status','selesai')->count();
                $proses  = $laporan->where('status','proses')->count();
                $pending = $laporan->where('status','pending')->count();
            @endphp
            <div class="stat-strip-item">
                <div class="ssi-num">{{ $total }}</div>
                <div class="ssi-lbl">Total Respon</div>
            </div>
            <div class="stat-strip-item">
                <div class="ssi-num" style="color:#15803d;">{{ $selesai }}</div>
                <div class="ssi-lbl">Selesai</div>
            </div>
            <div class="stat-strip-item">
                <div class="ssi-num" style="color:#b45309;">{{ $proses }}</div>
                <div class="ssi-lbl">Diproses</div>
            </div>
            <div class="stat-strip-item">
                <div class="ssi-num" style="color:#dc2626;">{{ $pending }}</div>
                <div class="ssi-lbl">Pending</div>
            </div>
        </div>

    </div>

    {{-- SCROLL AREA --}}
    <div class="rp-scroll">
        <div class="rp-grid">

            @forelse($laporan as $item)

            @php
                $ac = $item->status === 'selesai' ? 'ac-green' : ($item->status === 'proses' ? 'ac-amber' : 'ac-red');
                $sp = 'sp-' . $item->status;
            @endphp

            <div class="rp-card {{ $ac }}">

                {{-- HEAD --}}
                <div class="rp-card-head">
                    <span class="kategori-pill">
                        <i class="bi bi-tag"></i>
                        {{ $item->kategori }}
                    </span>
                    <span class="status-pill {{ $sp }}">
                        {{ ucfirst($item->status) }}
                    </span>
                </div>

                {{-- BODY --}}
                <div class="rp-card-body">

                    <h5 class="rp-judul">{{ $item->judul }}</h5>

                    <div class="rp-meta">
                        <span class="rp-meta-item">
                            <i class="bi bi-person"></i>
                            {{ $item->user->name ?? 'Siswa' }}
                        </span>
                        <span class="rp-meta-item">
                            <i class="bi bi-calendar3"></i>
                            {{ $item->created_at->format('d M Y') }}
                        </span>
                        @if($item->lokasi)
                        <span class="rp-meta-item">
                            <i class="bi bi-geo-alt"></i>
                            {{ $item->lokasi }}
                        </span>
                        @endif
                    </div>

                    <p class="rp-deskripsi">{{ $item->deskripsi }}</p>

                    {{-- TANGGAPAN --}}
                    <div class="tanggapan-box">
                        <div class="tanggapan-head">
                            <i class="bi bi-chat-left-text-fill"></i>
                            <span>Tanggapan Guru BK</span>
                        </div>
                        <p class="tanggapan-text">{{ $item->tanggapan }}</p>
                    </div>

                </div>

                {{-- FOOTER --}}
                <div class="rp-card-foot">
                    <div class="guru-chip">
                        <div class="guru-chip-avatar">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        Guru BK
                    </div>
                    <div class="foot-actions">
                        <a href="{{ route('laporan.edit', $item->id) }}" class="btn-edit" title="Edit">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a href="/pengaduan/{{ $item->id }}" class="btn-detail">
                            <i class="bi bi-eye-fill"></i>
                            Detail
                        </a>
                    </div>
                </div>

            </div>

            @empty

            <div class="rp-empty">
                <div class="rp-empty-icon">
                    <i class="bi bi-chat-square-text"></i>
                </div>
                <h5>Belum Ada Respon</h5>
                <p>Tanggapan yang diberikan kepada laporan siswa akan muncul di sini</p>
            </div>

            @endforelse

        </div>
    </div>

</div>

@endsection