@extends('layouts.siswa')

@section('title','Detail Laporan')

@section('content')

{{-- Struktur: header fix + konten scroll --}}
<div class="detail-wrapper">

    {{-- HEADER FIX --}}
    <div class="detail-header">
        <a href="{{ url()->previous() }}" class="back-btn">
            <i class="bi bi-arrow-left"></i>
        </a>
        <div class="header-text">
            <h4 class="header-title">Detail Laporan</h4>
            <p class="header-subtitle">Informasi lengkap laporan beserta tanggapan Guru BK</p>
        </div>
        <span class="status-chip
            @if($pengaduan->status == 'pending') chip-pending
            @elseif($pengaduan->status == 'proses') chip-proses
            @else chip-selesai
            @endif">
            @if($pengaduan->status == 'pending')
                <i class="bi bi-exclamation-circle-fill"></i>
            @elseif($pengaduan->status == 'proses')
                <i class="bi bi-clock-fill"></i>
            @else
                <i class="bi bi-check-circle-fill"></i>
            @endif
            {{ ucfirst($pengaduan->status) }}
        </span>
    </div>

    {{-- SCROLLABLE CONTENT --}}
    <div class="detail-scroll">
        <div class="detail-grid">

            {{-- LEFT --}}
            <div class="left-col">

                <div class="main-card">

                    <div class="card-section">
                        <span class="kategori-pill">
                            <i class="bi bi-tag-fill"></i>
                            {{ $pengaduan->kategori }}
                        </span>
                        <h2 class="laporan-title">{{ $pengaduan->judul }}</h2>
                    </div>

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
                            <span class="meta-value">
                                {{ \Carbon\Carbon::parse($pengaduan->created_at)->translatedFormat('d F Y') }}
                            </span>
                        </div>
                    </div>

                    <div class="divider"></div>

                    <div class="desc-section">
                        <p class="section-label">
                            <i class="bi bi-file-text"></i>
                            Deskripsi Laporan
                        </p>
                        <p class="desc-text">{{ $pengaduan->deskripsi }}</p>
                    </div>

                    @if($pengaduan->bukti)
                    <div class="divider"></div>
                    <div>
                        <p class="section-label">
                            <i class="bi bi-image"></i>
                            Bukti Pendukung
                        </p>
                        <img src="{{ asset('storage/' . $pengaduan->bukti) }}"
                             class="bukti-img" alt="Bukti laporan">
                    </div>
                    @endif

                </div>

            </div>

            {{-- RIGHT --}}
            <div class="right-col">

                {{-- TIMELINE --}}
                <div class="side-card">
                    <p class="side-card-title">
                        <i class="bi bi-activity"></i>
                        Status Laporan
                    </p>
                    <div class="timeline">
                        <div class="timeline-item done">
                            <div class="tl-dot"><i class="bi bi-check"></i></div>
                            <div class="tl-text">
                                <span class="tl-label">Laporan Dikirim</span>
                                <span class="tl-time">{{ $pengaduan->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        <div class="timeline-item {{ in_array($pengaduan->status, ['proses','selesai']) ? 'done' : 'waiting' }}">
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
                        <div class="timeline-item {{ $pengaduan->status == 'selesai' ? 'done' : 'waiting' }}">
                            <div class="tl-dot">
                                @if($pengaduan->status == 'selesai')
                                    <i class="bi bi-check"></i>
                                @else
                                    <i class="bi bi-flag"></i>
                                @endif
                            </div>
                            <div class="tl-text">
                                <span class="tl-label">Selesai</span>
                                <span class="tl-time">{{ $pengaduan->status == 'selesai' ? 'Laporan selesai ditangani' : 'Belum selesai' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TANGGAPAN (read-only, tanpa tombol edit) --}}
                <div class="side-card">
                    <p class="side-card-title">
                        <i class="bi bi-chat-left-text"></i>
                        Tanggapan Guru BK
                    </p>

                    @if($pengaduan->tanggapan)
                    <div class="tanggapan-box">
                        <div class="guru-avatar">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <div class="tanggapan-bubble">
                            {{ $pengaduan->tanggapan }}
                        </div>
                    </div>
                    @else
                    <div class="empty-tanggapan">
                        <i class="bi bi-chat-square-dots"></i>
                        <p>Belum ada tanggapan</p>
                        <small>Guru BK akan segera merespons laporan kamu</small>
                    </div>
                    @endif
                </div>

                {{-- TOMBOL KEMBALI SAJA --}}
                <a href="{{ url()->previous() }}" class="btn-kembali">
                    <i class="bi bi-arrow-left"></i>
                    Kembali ke Laporan Saya
                </a>

            </div>

        </div>
    </div>

</div>

<style>

/* ============================================
   WRAPPER — full height, flex column
============================================ */
.detail-wrapper {
    display: flex;
    flex-direction: column;
    height: 100%;          /* ikuti tinggi .content dari layout */
    overflow: hidden;
}

/* ============================================
   HEADER — fix, tidak ikut scroll
============================================ */
.detail-header {
    display: flex;
    align-items: center;
    gap: 14px;
    background: rgba(255,255,255,0.97);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid #edf1f5;
    border-radius: 18px;
    padding: 16px 22px;
    margin-bottom: 16px;
    box-shadow: 0 2px 10px rgba(15,23,42,0.05);
    flex-shrink: 0;        /* jangan menyusut */
    flex-wrap: wrap;
    gap: 12px;
}

.back-btn {
    width: 38px;
    height: 38px;
    border-radius: 11px;
    border: 1px solid #e5e7eb;
    background: #f9fafb;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #374151;
    font-size: 15px;
    text-decoration: none;
    transition: .2s;
    flex-shrink: 0;
}
.back-btn:hover { background: #f3f4f6; color: #111; }

.header-text { flex: 1; min-width: 0; }

.header-title {
    font-size: 17px;
    font-weight: 700;
    color: #111827;
    margin: 0 0 2px;
}

.header-subtitle {
    font-size: 12px;
    color: #9ca3af;
    margin: 0;
}

/* STATUS CHIP */
.status-chip {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 7px 14px;
    border-radius: 30px;
    font-size: 12px;
    font-weight: 600;
    flex-shrink: 0;
}
.chip-pending { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }
.chip-proses  { background: #fffbeb; color: #d97706; border: 1px solid #fde68a; }
.chip-selesai { background: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0; }

/* ============================================
   SCROLL AREA — sisa tinggi
============================================ */
.detail-scroll {
    flex: 1;
    overflow-y: auto;
    overflow-x: hidden;
    padding-bottom: 32px;
    scrollbar-width: thin;
    scrollbar-color: #e5e7eb transparent;
}
.detail-scroll::-webkit-scrollbar { width: 5px; }
.detail-scroll::-webkit-scrollbar-thumb { background: #e5e7eb; border-radius: 99px; }

/* ============================================
   GRID
============================================ */
.detail-grid {
    display: grid;
    grid-template-columns: 1fr 320px;
    gap: 18px;
    align-items: start;
}

/* ============================================
   MAIN CARD
============================================ */
.main-card {
    background: #fff;
    border-radius: 18px;
    border: 1px solid #edf1f5;
    padding: 24px;
    box-shadow: 0 2px 12px rgba(15,23,42,0.04);
}

.card-section { margin-bottom: 20px; }

.kategori-pill {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    background: #f0fdf4;
    color: #15803d;
    border: 1px solid #bbf7d0;
    padding: 5px 12px;
    border-radius: 30px;
    font-size: 11px;
    font-weight: 500;
    margin-bottom: 12px;
}

.laporan-title {
    font-size: 21px;
    font-weight: 700;
    color: #111827;
    line-height: 1.4;
    margin: 0;
}

/* META */
.meta-row {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
    margin-bottom: 20px;
}

.meta-item {
    background: #f9fafb;
    border: 1px solid #f3f4f6;
    border-radius: 12px;
    padding: 12px 14px;
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.meta-label {
    font-size: 11px;
    color: #9ca3af;
    display: flex;
    align-items: center;
    gap: 4px;
}

.meta-value {
    font-size: 13px;
    font-weight: 600;
    color: #1f2937;
}

.divider {
    height: 1px;
    background: #f3f4f6;
    margin: 20px 0;
}

.section-label {
    display: flex;
    align-items: center;
    gap: 7px;
    font-size: 13px;
    font-weight: 600;
    color: #374151;
    margin: 0 0 10px;
}

.desc-text {
    font-size: 14px;
    color: #4b5563;
    line-height: 1.85;
    margin: 0;
    white-space: pre-line;
}

.bukti-img {
    width: 100%;
    max-height: 320px;
    object-fit: cover;
    border-radius: 14px;
    border: 1px solid #e5e7eb;
}

/* ============================================
   SIDE CARD
============================================ */
.side-card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid #edf1f5;
    padding: 18px;
    margin-bottom: 14px;
    box-shadow: 0 2px 8px rgba(15,23,42,0.03);
}

.side-card-title {
    font-size: 13px;
    font-weight: 600;
    color: #374151;
    display: flex;
    align-items: center;
    gap: 7px;
    margin: 0 0 16px;
    padding-bottom: 12px;
    border-bottom: 1px solid #f3f4f6;
}

/* TIMELINE */
.timeline { display: flex; flex-direction: column; }

.timeline-item {
    display: flex;
    gap: 12px;
    align-items: flex-start;
    position: relative;
    padding-bottom: 18px;
}
.timeline-item:last-child { padding-bottom: 0; }

.timeline-item:not(:last-child)::after {
    content: '';
    position: absolute;
    left: 15px;
    top: 32px;
    width: 1px;
    height: calc(100% - 16px);
    background: #e5e7eb;
}
.timeline-item.done:not(:last-child)::after { background: #bbf7d0; }

.tl-dot {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    flex-shrink: 0;
    z-index: 1;
}
.done .tl-dot    { background: #16a34a; color: white; }
.waiting .tl-dot { background: #f3f4f6; color: #9ca3af; border: 1px solid #e5e7eb; }

.tl-text { padding-top: 3px; }

.tl-label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 2px;
}
.tl-time { font-size: 11px; color: #9ca3af; }

/* TANGGAPAN */
.tanggapan-box {
    display: flex;
    gap: 10px;
    align-items: flex-start;
}

.guru-avatar {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    background: #f0fdf4;
    color: #16a34a;
    border: 2px solid #bbf7d0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 15px;
    flex-shrink: 0;
}

.tanggapan-bubble {
    background: #f9fafb;
    border: 1px solid #f3f4f6;
    border-left: 3px solid #16a34a;
    border-radius: 0 12px 12px 12px;
    padding: 12px 14px;
    font-size: 13px;
    color: #374151;
    line-height: 1.75;
    flex: 1;
}

.empty-tanggapan {
    text-align: center;
    padding: 22px 10px;
    background: #f9fafb;
    border-radius: 12px;
    border: 1px dashed #d1d5db;
}
.empty-tanggapan i { font-size: 28px; color: #d1d5db; }
.empty-tanggapan p { font-size: 13px; font-weight: 600; color: #6b7280; margin: 8px 0 4px; }
.empty-tanggapan small { font-size: 11px; color: #9ca3af; }

/* TOMBOL KEMBALI */
.btn-kembali {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    padding: 12px;
    background: #16a34a;
    color: white;
    text-decoration: none;
    border-radius: 14px;
    font-size: 14px;
    font-weight: 600;
    transition: .2s;
    box-sizing: border-box;
}
.btn-kembali:hover { background: #15803d; color: white; }

/* ============================================
   RESPONSIVE — tablet
============================================ */
@media (max-width: 900px) {
    .detail-grid {
        grid-template-columns: 1fr;
    }

    .right-col {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
    }

    .btn-kembali {
        grid-column: 1 / -1;
    }
}

/* ============================================
   RESPONSIVE — mobile
============================================ */
@media (max-width: 600px) {

    .detail-wrapper {
        height: auto;
        overflow: visible;
    }

    .detail-scroll {
        overflow: visible;
        height: auto;
    }

    .detail-header {
        border-radius: 14px;
        padding: 14px 16px;
    }

    .header-title { font-size: 15px; }

    .status-chip { width: 100%; justify-content: center; }

    .main-card {
        padding: 16px;
        border-radius: 14px;
    }

    .laporan-title { font-size: 17px; }

    .meta-row { grid-template-columns: 1fr; }

    .right-col {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }
}

</style>

@endsection