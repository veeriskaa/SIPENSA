@extends('layouts.siswa')

@section('title','Panduan Konseling')

@section('content')

<div class="pan-page">

    {{-- HEADER FIX --}}
    <div class="pan-header">
        <div class="pan-header-left">
            <div class="pan-header-icon">
                <i class="bi bi-book-half"></i>
            </div>
            <div>
                <h3 class="pan-title">Panduan Konseling</h3>
                <p class="pan-sub">Informasi dan panduan penggunaan layanan pengaduan siswa</p>
            </div>
        </div>
    </div>

    {{-- SCROLL AREA --}}
    <div class="pan-scroll">

        <div class="pan-grid">

            {{-- CARD 1: CARA MEMBUAT LAPORAN --}}
            <div class="pan-card">
                <div class="pan-card-head">
                    <div class="pci green"><i class="bi bi-pencil-square"></i></div>
                    <div>
                        <h5 class="pan-card-title">Cara Membuat Laporan</h5>
                        <p class="pan-card-sub">Ikuti langkah berikut</p>
                    </div>
                </div>
                <div class="step-list">
                    <div class="step-row">
                        <span class="step-num">1</span>
                        <span>Pilih menu <strong>Buat Laporan</strong> di sidebar</span>
                    </div>
                    <div class="step-row">
                        <span class="step-num">2</span>
                        <span>Pilih kategori masalah yang sesuai</span>
                    </div>
                    <div class="step-row">
                        <span class="step-num">3</span>
                        <span>Isi judul dan deskripsi laporan secara lengkap</span>
                    </div>
                    <div class="step-row">
                        <span class="step-num">4</span>
                        <span>Tambahkan lokasi dan waktu kejadian</span>
                    </div>
                    <div class="step-row">
                        <span class="step-num">5</span>
                        <span>Upload bukti pendukung jika ada</span>
                    </div>
                    <div class="step-row">
                        <span class="step-num">6</span>
                        <span>Klik tombol <strong>Kirim Laporan</strong></span>
                    </div>
                </div>
            </div>

            {{-- CARD 2: JENIS LAPORAN --}}
            <div class="pan-card">
                <div class="pan-card-head">
                    <div class="pci blue"><i class="bi bi-folder-check"></i></div>
                    <div>
                        <h5 class="pan-card-title">Jenis Laporan</h5>
                        <p class="pan-card-sub">Yang dapat dilaporkan</p>
                    </div>
                </div>
                <div class="jenis-list">
                    <div class="jenis-item">
                        <span class="jenis-emoji">🛡️</span>
                        <div>
                            <p class="jenis-name">Bullying / Perundungan</p>
                            <p class="jenis-desc">Intimidasi fisik maupun verbal</p>
                        </div>
                    </div>
                    <div class="jenis-item">
                        <span class="jenis-emoji">📚</span>
                        <div>
                            <p class="jenis-name">Masalah Akademik</p>
                            <p class="jenis-desc">Kesulitan belajar atau nilai</p>
                        </div>
                    </div>
                    <div class="jenis-item">
                        <span class="jenis-emoji">🏫</span>
                        <div>
                            <p class="jenis-name">Fasilitas Sekolah</p>
                            <p class="jenis-desc">Kerusakan sarana prasarana</p>
                        </div>
                    </div>
                    <div class="jenis-item">
                        <span class="jenis-emoji">💬</span>
                        <div>
                            <p class="jenis-name">Konseling Pribadi</p>
                            <p class="jenis-desc">Masalah personal atau sosial</p>
                        </div>
                    </div>
                    <div class="jenis-item">
                        <span class="jenis-emoji">📋</span>
                        <div>
                            <p class="jenis-name">Lainnya</p>
                            <p class="jenis-desc">Permasalahan lain terkait sekolah</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- CARD 3: PROSES PENANGANAN --}}
            <div class="pan-card">
                <div class="pan-card-head">
                    <div class="pci orange"><i class="bi bi-arrow-repeat"></i></div>
                    <div>
                        <h5 class="pan-card-title">Proses Penanganan</h5>
                        <p class="pan-card-sub">Alur laporan hingga selesai</p>
                    </div>
                </div>
                <div class="timeline">
                    <div class="tl-item">
                        <div class="tl-dot tl-pending">
                            <i class="bi bi-exclamation-circle-fill"></i>
                        </div>
                        <div class="tl-body">
                            <p class="tl-status" style="color:#dc2626">Pending</p>
                            <p class="tl-desc">Laporan berhasil dikirim dan menunggu pemeriksaan oleh Guru BK.</p>
                        </div>
                    </div>
                    <div class="tl-connector"></div>
                    <div class="tl-item">
                        <div class="tl-dot tl-proses">
                            <i class="bi bi-clock-history"></i>
                        </div>
                        <div class="tl-body">
                            <p class="tl-status" style="color:#d97706">Proses</p>
                            <p class="tl-desc">Guru BK sedang menindaklanjuti dan akan memberikan tanggapan.</p>
                        </div>
                    </div>
                    <div class="tl-connector"></div>
                    <div class="tl-item">
                        <div class="tl-dot tl-selesai">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <div class="tl-body">
                            <p class="tl-status" style="color:#16a34a">Selesai</p>
                            <p class="tl-desc">Laporan telah selesai ditangani dan mendapat respons dari Guru BK.</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- CARD 4: PRIVASI --}}
            <div class="pan-card">
                <div class="pan-card-head">
                    <div class="pci red"><i class="bi bi-shield-lock"></i></div>
                    <div>
                        <h5 class="pan-card-title">Privasi & Keamanan</h5>
                        <p class="pan-card-sub">Data kamu aman bersama kami</p>
                    </div>
                </div>
                <p class="pan-desc">
                    Semua laporan siswa dijaga kerahasiaannya dan hanya dapat diakses oleh pihak terkait seperti Guru BK atau administrator sekolah.
                </p>
                <div class="privacy-list">
                    <div class="privacy-item">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>Data laporan aman & tidak dibagikan ke pihak luar</span>
                    </div>
                    <div class="privacy-item">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>Hanya Guru BK & admin yang dapat melihat laporan</span>
                    </div>
                    <div class="privacy-item">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>Identitas pelapor dijaga kerahasiaannya</span>
                    </div>
                </div>
            </div>

        </div>

        {{-- CONTACT CARD --}}
        <div class="contact-card">
            <div class="contact-left">
                <div class="contact-icon">
                    <i class="bi bi-headset"></i>
                </div>
                <div>
                    <h5 class="contact-title">Butuh Bantuan?</h5>
                    <p class="contact-desc">Hubungi Guru BK jika mengalami kendala saat menggunakan sistem.</p>
                    <p class="contact-phone">
                        <i class="bi bi-telephone-fill"></i>
                        081352655551
                    </p>
                </div>
            </div>
            <a href="/chatbot" class="btn-chatbot">
                <i class="bi bi-robot"></i>
                Tanya AI Assistant
            </a>
        </div>

    </div>{{-- end pan-scroll --}}

</div>

<style>

/* =============================================
   PAGE
============================================= */
.pan-page {
    display: flex;
    flex-direction: column;
    height: 100%;
    overflow: hidden;
    gap: 14px;
}

/* =============================================
   HEADER FIX
============================================= */
.pan-header {
    flex-shrink: 0;
    background: #fff;
    border: 1px solid #edf1f5;
    border-radius: 18px;
    padding: 18px 22px;
    box-shadow: 0 2px 10px rgba(15,23,42,.04);
}

.pan-header-left {
    display: flex;
    align-items: center;
    gap: 14px;
}

.pan-header-icon {
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

.pan-title {
    font-size: 18px;
    font-weight: 700;
    color: #111827;
    margin: 0 0 2px;
}

.pan-sub {
    font-size: 12px;
    color: #9ca3af;
    margin: 0;
}

/* =============================================
   SCROLL
============================================= */
.pan-scroll {
    flex: 1;
    overflow-y: auto;
    overflow-x: hidden;
    min-height: 0;
    padding-bottom: 32px;
    scrollbar-width: thin;
    scrollbar-color: #e5e7eb transparent;
}

.pan-scroll::-webkit-scrollbar { width: 5px; }
.pan-scroll::-webkit-scrollbar-thumb { background: #e5e7eb; border-radius: 99px; }

/* =============================================
   GRID
============================================= */
.pan-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
    margin-bottom: 14px;
}

/* =============================================
   CARD
============================================= */
.pan-card {
    background: #fff;
    border-radius: 18px;
    border: 1px solid #edf1f5;
    padding: 22px;
    box-shadow: 0 2px 10px rgba(15,23,42,.04);
    transition: .25s;
}

.pan-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(15,23,42,.07);
    border-color: #d1fae5;
}

.pan-card-head {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 18px;
    padding-bottom: 14px;
    border-bottom: 1px solid #f3f4f6;
}

.pci {
    width: 42px; height: 42px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 19px;
    flex-shrink: 0;
}

.green  { background: #f0fdf4; color: #16a34a; }
.blue   { background: #eff6ff; color: #2563eb; }
.orange { background: #fff7ed; color: #ea580c; }
.red    { background: #fef2f2; color: #dc2626; }

.pan-card-title {
    font-size: 14px;
    font-weight: 700;
    color: #111827;
    margin: 0 0 2px;
}

.pan-card-sub {
    font-size: 11px;
    color: #9ca3af;
    margin: 0;
}

/* STEP LIST */
.step-list { display: flex; flex-direction: column; gap: 10px; }

.step-row {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    font-size: 13px;
    color: #4b5563;
    line-height: 1.6;
}

.step-num {
    width: 22px; height: 22px;
    border-radius: 50%;
    background: #f0fdf4;
    border: 1.5px solid #bbf7d0;
    color: #16a34a;
    font-size: 11px;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    margin-top: 1px;
}

/* JENIS LIST */
.jenis-list { display: flex; flex-direction: column; gap: 10px; }

.jenis-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 12px;
    background: #f9fafb;
    border-radius: 12px;
    border: 1px solid #f3f4f6;
    transition: .2s;
}

.jenis-item:hover { background: #f0fdf4; border-color: #bbf7d0; }

.jenis-emoji { font-size: 20px; flex-shrink: 0; }

.jenis-name {
    font-size: 13px;
    font-weight: 600;
    color: #111827;
    margin: 0 0 2px;
}

.jenis-desc {
    font-size: 11px;
    color: #9ca3af;
    margin: 0;
}

/* TIMELINE */
.timeline { display: flex; flex-direction: column; }

.tl-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
}

.tl-connector {
    width: 2px;
    height: 16px;
    background: #f3f4f6;
    margin: 4px 0 4px 15px;
    border-radius: 2px;
}

.tl-dot {
    width: 32px; height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    flex-shrink: 0;
}

.tl-pending { background: #fef2f2; color: #dc2626; }
.tl-proses  { background: #fffbeb; color: #d97706; }
.tl-selesai { background: #f0fdf4; color: #16a34a; }

.tl-body { padding-top: 4px; }

.tl-status {
    font-size: 13px;
    font-weight: 700;
    margin: 0 0 2px;
}

.tl-desc {
    font-size: 12px;
    color: #6b7280;
    margin: 0;
    line-height: 1.6;
}

/* PRIVACY */
.pan-desc {
    font-size: 13px;
    color: #6b7280;
    line-height: 1.75;
    margin: 0 0 14px;
}

.privacy-list { display: flex; flex-direction: column; gap: 8px; }

.privacy-item {
    display: flex;
    align-items: flex-start;
    gap: 8px;
    font-size: 13px;
    color: #374151;
    line-height: 1.5;
}

.privacy-item i {
    color: #16a34a;
    font-size: 14px;
    flex-shrink: 0;
    margin-top: 1px;
}

/* =============================================
   CONTACT CARD
============================================= */
.contact-card {
    background: linear-gradient(135deg, #14532d 0%, #16a34a 60%, #22c55e 100%);
    border-radius: 18px;
    padding: 24px 28px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    flex-wrap: wrap;
    box-shadow: 0 8px 24px rgba(22,163,74,.2);
    position: relative;
    overflow: hidden;
}

.contact-card::before {
    content: '';
    position: absolute;
    width: 180px; height: 180px;
    border-radius: 50%;
    background: rgba(255,255,255,.06);
    top: -60px; right: -40px;
    pointer-events: none;
}

.contact-left {
    display: flex;
    align-items: center;
    gap: 16px;
    position: relative;
    z-index: 1;
}

.contact-icon {
    width: 52px; height: 52px;
    border-radius: 16px;
    background: rgba(255,255,255,.15);
    border: 1.5px solid rgba(255,255,255,.25);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    flex-shrink: 0;
    backdrop-filter: blur(4px);
}

.contact-title {
    font-size: 15px;
    font-weight: 700;
    color: white;
    margin: 0 0 3px;
}

.contact-desc {
    font-size: 12px;
    color: rgba(255,255,255,.8);
    margin: 0 0 4px;
    line-height: 1.5;
}

.contact-phone {
    font-size: 13px;
    font-weight: 600;
    color: #bbf7d0;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 6px;
}

.btn-chatbot {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: white;
    color: #16a34a;
    text-decoration: none;
    padding: 12px 20px;
    border-radius: 14px;
    font-size: 13px;
    font-weight: 700;
    transition: .2s;
    flex-shrink: 0;
    position: relative;
    z-index: 1;
    box-shadow: 0 4px 14px rgba(0,0,0,.1);
}

.btn-chatbot:hover {
    background: #f0fdf4;
    color: #15803d;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0,0,0,.12);
}

/* =============================================
   RESPONSIVE — TABLET
============================================= */
@media (max-width: 1024px) and (min-width: 641px) {
    .pan-grid { grid-template-columns: 1fr 1fr; gap: 12px; }
}

/* =============================================
   RESPONSIVE — MOBILE
============================================= */
@media (max-width: 640px) {

    .pan-header { padding: 14px 16px; border-radius: 14px; }
    .pan-header-icon { width: 38px; height: 38px; font-size: 17px; }
    .pan-title { font-size: 16px; }

    .pan-grid { grid-template-columns: 1fr; gap: 12px; }

    .pan-card { padding: 18px 16px; border-radius: 16px; }

    .contact-card { padding: 20px 18px; flex-direction: column; align-items: flex-start; }
    .contact-left { align-items: flex-start; }
    .btn-chatbot { width: 100%; justify-content: center; }
}

</style>

@endsection