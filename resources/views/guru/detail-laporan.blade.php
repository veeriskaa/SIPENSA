@extends('layouts.guru')

@section('title','Detail Laporan')

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

.dl * { box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }

/* =============================================
   PAGE
============================================= */
.dl {
    display: flex;
    flex-direction: column;
    height: 100%;
    overflow: hidden;
    animation: dlFade .35s ease both;
}

@keyframes dlFade {
    from { opacity:0; transform:translateY(8px); }
    to   { opacity:1; transform:translateY(0); }
}

/* =============================================
   HEADER FIX
============================================= */
.dl-header {
    flex-shrink: 0;
    display: flex;
    align-items: center;
    gap: 12px;
    background: rgba(255,255,255,.97);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid var(--border);
    border-radius: 18px;
    padding: 16px 20px;
    margin-bottom: 14px;
    box-shadow: 0 2px 10px rgba(15,23,42,.05);
    flex-wrap: wrap;
}

.dl-back-btn {
    width: 38px; height: 38px;
    border-radius: 11px;
    border: 1px solid var(--border);
    background: #f9fafb;
    display: flex; align-items: center; justify-content: center;
    color: #374151; font-size: 15px;
    text-decoration: none; transition: .2s; flex-shrink: 0;
}
.dl-back-btn:hover { background: #f3f4f6; color: #111; }

.dl-header-text { flex: 1; min-width: 0; }
.dl-header-title { font-size: 17px; font-weight: 700; color: var(--text); margin: 0 0 2px; }
.dl-header-sub   { font-size: 12px; color: #9ca3af; margin: 0; }

.status-chip {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 7px 14px; border-radius: 30px;
    font-size: 12px; font-weight: 600; flex-shrink: 0;
}
.chip-pending { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }
.chip-proses  { background: #fffbeb; color: #d97706; border: 1px solid #fde68a; }
.chip-selesai { background: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0; }

/* =============================================
   SCROLL
============================================= */
.dl-scroll {
    flex: 1;
    overflow-y: auto;
    overflow-x: hidden;
    min-height: 0;
    padding-bottom: 32px;
    scrollbar-width: thin;
    scrollbar-color: #e5e7eb transparent;
}
.dl-scroll::-webkit-scrollbar { width: 5px; }
.dl-scroll::-webkit-scrollbar-thumb { background: #e5e7eb; border-radius: 99px; }

/* =============================================
   GRID
============================================= */
.dl-grid {
    display: grid;
    grid-template-columns: 1fr 320px;
    gap: 16px;
    align-items: start;
}

/* =============================================
   MAIN CARD
============================================= */
.main-card {
    background: #fff;
    border-radius: 20px;
    border: 1px solid var(--border);
    padding: 24px;
    box-shadow: 0 2px 12px rgba(15,23,42,.04);
}

/* Kategori + Judul */
.kategori-pill {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 5px 12px; border-radius: 30px;
    font-size: 11px; font-weight: 600; margin-bottom: 12px;
}
.kat-bullying  { background: #fee2e2; color: #dc2626; border: 1px solid #fecaca; }
.kat-fasilitas { background: #dbeafe; color: #2563eb; border: 1px solid #bfdbfe; }
.kat-akademik  { background: #fef3c7; color: #d97706; border: 1px solid #fde68a; }
.kat-kekerasan { background: #f3e8ff; color: #7c3aed; border: 1px solid #ddd6fe; }
.kat-default   { background: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0; }

.laporan-title { font-size: 22px; font-weight: 700; color: var(--text); line-height: 1.4; margin: 0 0 20px; }

/* Meta row */
.meta-row { display: grid; grid-template-columns: repeat(3,1fr); gap: 10px; margin-bottom: 20px; }

.meta-item {
    background: #f9fafb; border: 1px solid #f3f4f6;
    border-radius: 12px; padding: 12px 14px;
    display: flex; flex-direction: column; gap: 5px;
}
.meta-label { font-size: 11px; color: #9ca3af; display: flex; align-items: center; gap: 4px; }
.meta-value { font-size: 13px; font-weight: 600; color: var(--text); }

.divider { height: 1px; background: #f3f4f6; margin: 20px 0; }

.section-label {
    display: flex; align-items: center; gap: 7px;
    font-size: 13px; font-weight: 700; color: #374151;
    margin: 0 0 10px;
}

.desc-text { font-size: 14px; color: #4b5563; line-height: 1.85; margin: 0; white-space: pre-line; }

.bukti-img { width: 100%; max-height: 340px; object-fit: cover; border-radius: 14px; border: 1px solid #e5e7eb; }

/* =============================================
   RIGHT COLUMN
============================================= */
.right-col { display: flex; flex-direction: column; gap: 14px; }

/* =============================================
   SIDE CARD BASE
============================================= */
.side-card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid var(--border);
    padding: 18px;
    box-shadow: 0 2px 8px rgba(15,23,42,.03);
}

.side-card-title {
    font-size: 13px; font-weight: 700; color: #374151;
    display: flex; align-items: center; gap: 7px;
    margin: 0 0 16px; padding-bottom: 12px;
    border-bottom: 1px solid #f3f4f6;
}

/* =============================================
   PELAPOR CARD
============================================= */
.pelapor-row { display: flex; align-items: center; gap: 12px; }

.pelapor-avatar {
    width: 46px; height: 46px; border-radius: 14px;
    background: linear-gradient(135deg, var(--g1), var(--g2));
    color: white; display: flex; align-items: center;
    justify-content: center; font-size: 18px; font-weight: 700;
    flex-shrink: 0;
}

.pelapor-name  { font-size: 14px; font-weight: 700; color: var(--text); margin: 0 0 3px; }
.pelapor-meta  { font-size: 12px; color: #9ca3af; margin: 0; display: flex; align-items: center; gap: 5px; }

/* =============================================
   TIMELINE STATUS
============================================= */
.timeline { display: flex; flex-direction: column; }

.tl-item { display: flex; gap: 12px; align-items: flex-start; position: relative; padding-bottom: 18px; }
.tl-item:last-child { padding-bottom: 0; }

.tl-item:not(:last-child)::after {
    content: ''; position: absolute;
    left: 15px; top: 32px;
    width: 1px; height: calc(100% - 16px);
    background: #e5e7eb;
}
.tl-item.done:not(:last-child)::after { background: #bbf7d0; }

.tl-dot {
    width: 30px; height: 30px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 12px; flex-shrink: 0; z-index: 1;
}
.done .tl-dot    { background: var(--g2); color: white; }
.waiting .tl-dot { background: #f3f4f6; color: #9ca3af; border: 1px solid #e5e7eb; }

.tl-text { padding-top: 3px; }
.tl-label { display: block; font-size: 13px; font-weight: 600; color: var(--text); margin-bottom: 1px; }
.tl-time  { font-size: 11px; color: #9ca3af; }

/* =============================================
   TANGGAPAN CARD
============================================= */
.tanggapan-box { display: flex; gap: 10px; align-items: flex-start; }

.guru-avatar {
    width: 34px; height: 34px; border-radius: 10px;
    background: #f0fdf4; color: var(--g1);
    border: 2px solid #bbf7d0;
    display: flex; align-items: center; justify-content: center;
    font-size: 15px; flex-shrink: 0;
}

.tanggapan-bubble {
    background: #f9fafb; border: 1px solid #f3f4f6;
    border-left: 3px solid var(--g2);
    border-radius: 0 12px 12px 12px;
    padding: 12px 14px;
    font-size: 13px; color: #374151; line-height: 1.75; flex: 1;
}

.empty-tanggapan {
    text-align: center; padding: 22px 10px;
    background: #f9fafb; border-radius: 12px;
    border: 1px dashed #d1d5db;
}
.empty-tanggapan i { font-size: 28px; color: #d1d5db; }
.empty-tanggapan p { font-size: 13px; font-weight: 600; color: #6b7280; margin: 8px 0 4px; }
.empty-tanggapan small { font-size: 11px; color: #9ca3af; }

/* =============================================
   ACTION BUTTONS
============================================= */
.action-card { display: flex; flex-direction: column; gap: 10px; }

.btn-edit-lap {
    display: flex; align-items: center; justify-content: center; gap: 8px;
    width: 100%; padding: 12px; border-radius: 13px;
    background: white; border: 1.5px solid var(--g2); color: var(--g2);
    font-size: 13.5px; font-weight: 600; text-decoration: none; transition: .2s;
}
.btn-edit-lap:hover { background: #f0fdf4; }

.btn-back {
    display: flex; align-items: center; justify-content: center; gap: 8px;
    width: 100%; padding: 12px; border-radius: 13px;
    background: linear-gradient(135deg, var(--g1), var(--g2));
    color: white; font-size: 13.5px; font-weight: 600;
    text-decoration: none; transition: .2s;
    box-shadow: 0 4px 12px rgba(10,127,46,.25);
}
.btn-back:hover { background: #15803d; color: white; }

/* =============================================
   RESPONSIVE — TABLET
============================================= */
@media (max-width: 1024px) and (min-width: 641px) {
    .dl-grid { grid-template-columns: 1fr 290px; }
}

/* =============================================
   RESPONSIVE — MOBILE
============================================= */
@media (max-width: 640px) {
    .dl-header { padding: 12px 14px; border-radius: 14px; margin-bottom: 12px; }
    .dl-header-title { font-size: 15px; }
    .status-chip { width: 100%; justify-content: center; }

    .dl-grid { grid-template-columns: 1fr; }

    .main-card { padding: 16px; border-radius: 16px; }
    .laporan-title { font-size: 17px; }
    .meta-row { grid-template-columns: 1fr; }

    .right-col { display: flex; flex-direction: column; gap: 12px; }
}

</style>

<div class="dl">

    {{-- HEADER FIX --}}
    <div class="dl-header">
        <a href="{{ url()->previous() }}" class="dl-back-btn">
            <i class="bi bi-arrow-left"></i>
        </a>
        <div class="dl-header-text">
            <h4 class="dl-header-title">Detail Laporan</h4>
            <p class="dl-header-sub">Informasi lengkap laporan siswa</p>
        </div>
        <span class="status-chip
            @if($pengaduan->status=='pending') chip-pending
            @elseif($pengaduan->status=='proses') chip-proses
            @else chip-selesai
            @endif">
            @if($pengaduan->status=='pending')
                <i class="bi bi-exclamation-circle-fill"></i>
            @elseif($pengaduan->status=='proses')
                <i class="bi bi-clock-fill"></i>
            @else
                <i class="bi bi-check-circle-fill"></i>
            @endif
            {{ ucfirst($pengaduan->status) }}
        </span>
    </div>

    {{-- SCROLL --}}
    <div class="dl-scroll">
        <div class="dl-grid">

            {{-- LEFT --}}
            <div class="main-card">

                {{-- Kategori + Judul --}}
                @php
                    $katClass = match(strtolower($pengaduan->kategori ?? '')) {
                        'bullying'  => 'kat-bullying',
                        'fasilitas' => 'kat-fasilitas',
                        'akademik'  => 'kat-akademik',
                        'kekerasan' => 'kat-kekerasan',
                        default     => 'kat-default',
                    };
                @endphp
                <span class="kategori-pill {{ $katClass }}">
                    <i class="bi bi-tag-fill"></i>
                    {{ $pengaduan->kategori }}
                </span>
                <h2 class="laporan-title">{{ $pengaduan->judul }}</h2>

                {{-- Meta --}}
                <div class="meta-row">
                    <div class="meta-item">
                        <span class="meta-label"><i class="bi bi-person"></i> Pelapor</span>
                        <span class="meta-value">{{ $pengaduan->user->name ?? '-' }}</span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label"><i class="bi bi-geo-alt"></i> Lokasi</span>
                        <span class="meta-value">{{ $pengaduan->lokasi ?? '-' }}</span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label"><i class="bi bi-calendar3"></i> Tanggal</span>
                        <span class="meta-value">{{ \Carbon\Carbon::parse($pengaduan->created_at)->translatedFormat('d F Y') }}</span>
                    </div>
                </div>

                <div class="divider"></div>

                {{-- Deskripsi --}}
                <p class="section-label"><i class="bi bi-file-text"></i> Deskripsi Laporan</p>
                <p class="desc-text">{{ $pengaduan->deskripsi }}</p>

                {{-- Bukti --}}
                @if($pengaduan->bukti)
                <div class="divider"></div>
                <p class="section-label"><i class="bi bi-image"></i> Bukti Pendukung</p>
                <img src="{{ asset('storage/' . $pengaduan->bukti) }}" class="bukti-img" alt="Bukti">
                @endif

            </div>

            {{-- RIGHT --}}
            <div class="right-col">

                {{-- Pelapor --}}
                <div class="side-card">
                    <p class="side-card-title"><i class="bi bi-person-fill"></i> Informasi Pelapor</p>
                    <div class="pelapor-row">
                        <div class="pelapor-avatar">
                            {{ strtoupper(substr($pengaduan->user->name ?? 'S', 0, 1)) }}
                        </div>
                        <div>
                            <p class="pelapor-name">{{ $pengaduan->user->name ?? '-' }}</p>
                            <p class="pelapor-meta">
                                <i class="bi bi-envelope"></i>
                                {{ $pengaduan->user->email ?? '-' }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Timeline Status --}}
                <div class="side-card">
                    <p class="side-card-title"><i class="bi bi-activity"></i> Status Laporan</p>
                    <div class="timeline">
                        <div class="tl-item done">
                            <div class="tl-dot"><i class="bi bi-check"></i></div>
                            <div class="tl-text">
                                <span class="tl-label">Laporan Dikirim</span>
                                <span class="tl-time">{{ $pengaduan->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        <div class="tl-item {{ in_array($pengaduan->status, ['proses','selesai']) ? 'done' : 'waiting' }}">
                            <div class="tl-dot">
                                @if(in_array($pengaduan->status, ['proses','selesai']))
                                    <i class="bi bi-check"></i>
                                @else
                                    <i class="bi bi-three-dots"></i>
                                @endif
                            </div>
                            <div class="tl-text">
                                <span class="tl-label">Sedang Diproses</span>
                                <span class="tl-time">{{ in_array($pengaduan->status, ['proses','selesai']) ? 'Dalam penanganan' : 'Menunggu...' }}</span>
                            </div>
                        </div>
                        <div class="tl-item {{ $pengaduan->status == 'selesai' ? 'done' : 'waiting' }}">
                            <div class="tl-dot">
                                @if($pengaduan->status == 'selesai')
                                    <i class="bi bi-check"></i>
                                @else
                                    <i class="bi bi-flag"></i>
                                @endif
                            </div>
                            <div class="tl-text">
                                <span class="tl-label">Selesai</span>
                                <span class="tl-time">{{ $pengaduan->status == 'selesai' ? 'Ditangani' : 'Belum selesai' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tanggapan --}}
                <div class="side-card">
                    <p class="side-card-title"><i class="bi bi-chat-left-text"></i> Tanggapan Guru BK</p>
                    @if($pengaduan->tanggapan)
                    <div class="tanggapan-box">
                        <div class="guru-avatar"><i class="bi bi-person-fill"></i></div>
                        <div class="tanggapan-bubble">{{ $pengaduan->tanggapan }}</div>
                    </div>
                    @else
                    <div class="empty-tanggapan">
                        <i class="bi bi-chat-square-dots"></i>
                        <p>Belum ada tanggapan</p>
                        <small>Silakan tanggapi laporan ini</small>
                    </div>
                    @endif
                </div>

                {{-- Actions --}}
                <div class="action-card">
                    <a href="{{ route('laporan.edit', $pengaduan->id) }}" class="btn-edit-lap">
                        <i class="bi bi-pencil"></i> Edit / Tanggapi
                    </a>
                    <a href="{{ url()->previous() }}" class="btn-back">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>

            </div>

        </div>
    </div>

</div>

@endsection