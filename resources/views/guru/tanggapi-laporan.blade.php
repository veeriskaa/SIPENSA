@extends('layouts.guru')

@section('title','Tanggapi Laporan')

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

.tp * { box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }

/* =========================================================
   PAGE
========================================================= */

.tp {
    height: 100%;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    gap: 14px;
    animation: tpFade .35s ease both;
}

@keyframes tpFade {
    from { opacity:0; transform:translateY(8px); }
    to   { opacity:1; transform:translateY(0); }
}

/* =========================================================
   TOPBAR — fix, tidak scroll
========================================================= */

.tp-topbar {
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

.tp-topbar-left h3 {
    font-size: 18px;
    font-weight: 800;
    color: var(--text);
    margin: 0 0 2px;
    letter-spacing: -.2px;
}

.tp-topbar-left p {
    font-size: 12px;
    color: var(--soft);
    margin: 0;
}

.tp-topbar-right {
    display: flex;
    align-items: center;
    gap: 8px;
}

/* Back button */
.btn-back {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 14px;
    border-radius: 11px;
    border: 1.5px solid var(--border);
    background: white;
    color: #374151;
    font-size: 12.5px;
    font-weight: 600;
    text-decoration: none;
    transition: .2s;
}

.btn-back:hover {
    background: #f4f7f5;
    border-color: #9ca3af;
    color: var(--text);
}

/* =========================================================
   SCROLL — satu-satunya yang scroll
========================================================= */

.tp-scroll {
    flex: 1;
    overflow-y: auto;
    overflow-x: hidden;
    padding-right: 2px;
    padding-bottom: 24px;
    scrollbar-width: thin;
    scrollbar-color: #e5e7eb transparent;
}

.tp-scroll::-webkit-scrollbar { width: 5px; }
.tp-scroll::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 20px; }

/* =========================================================
   GRID
========================================================= */

.tp-grid {
    display: grid;
    grid-template-columns: 360px 1fr;
    gap: 14px;
    align-items: start;
}

/* =========================================================
   DETAIL CARD (kiri)
========================================================= */

.detail-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(15,23,42,.04);
    position: sticky;
    top: 0;
}

/* Header detail */
.detail-card-head {
    padding: 16px 18px;
    border-bottom: 1px solid #f3f4f6;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}

.kategori-pill {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    background: #f0fdf4;
    color: var(--g1);
    border: 1px solid #bbf7d0;
    padding: 5px 12px;
    border-radius: 30px;
    font-size: 11px;
    font-weight: 700;
}

.status-pill {
    padding: 5px 12px;
    border-radius: 30px;
    font-size: 10.5px;
    font-weight: 700;
}

.sp-pending { background: #fee2e2; color: #dc2626; }
.sp-proses  { background: #fef3c7; color: #b45309; }
.sp-selesai { background: #dcfce7; color: #15803d; }

/* Body detail */
.detail-card-body { padding: 18px; }

.detail-judul {
    font-size: 16px;
    font-weight: 800;
    color: var(--text);
    line-height: 1.4;
    margin: 0 0 16px;
}

/* Meta rows */
.meta-rows {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-bottom: 16px;
}

.meta-row {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 12px;
    background: #f9fbf9;
    border: 1px solid #f0f4f0;
    border-radius: 11px;
}

.meta-row-icon {
    width: 32px; height: 32px;
    border-radius: 9px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    flex-shrink: 0;
}

.mri-green { background: #dcfce7; color: var(--g1); }
.mri-blue  { background: #dbeafe; color: #1d4ed8; }
.mri-amber { background: #fef3c7; color: #b45309; }

.meta-row-body small {
    font-size: 10.5px;
    color: #9ca3af;
    text-transform: uppercase;
    letter-spacing: .4px;
    font-weight: 600;
    display: block;
    margin-bottom: 1px;
}

.meta-row-body span {
    font-size: 13px;
    font-weight: 700;
    color: var(--text);
}

/* Deskripsi */
.deskripsi-section {
    background: #f9fbf9;
    border: 1px solid #e8f0e8;
    border-radius: 13px;
    padding: 14px;
    margin-bottom: 14px;
}

.deskripsi-section-head {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 11px;
    font-weight: 700;
    color: var(--g1);
    text-transform: uppercase;
    letter-spacing: .5px;
    margin-bottom: 8px;
}

.deskripsi-section-head i { font-size: 12px; }

.deskripsi-text {
    font-size: 13px;
    color: #374151;
    line-height: 1.7;
    margin: 0;
}

/* Bukti */
.bukti-section { border-radius: 13px; overflow: hidden; }

.bukti-section img {
    width: 100%;
    max-height: 220px;
    object-fit: cover;
    display: block;
    border: 1px solid var(--border);
    border-radius: 13px;
}

/* =========================================================
   FORM CARD (kanan)
========================================================= */

.form-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(15,23,42,.04);
}

/* Form card head */
.form-card-head {
    padding: 18px 22px;
    border-bottom: 1px solid #f3f4f6;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
}

.form-card-head-left h4 {
    font-size: 16px;
    font-weight: 800;
    color: var(--text);
    margin: 0 0 3px;
}

.form-card-head-left p {
    font-size: 12px;
    color: var(--soft);
    margin: 0;
}

.form-card-icon {
    width: 44px; height: 44px;
    border-radius: 13px;
    background: #dcfce7;
    color: var(--g1);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 19px;
    flex-shrink: 0;
}

/* Form body */
.form-card-body { padding: 22px; }

/* Label */
.form-label {
    font-size: 13px;
    font-weight: 700;
    color: #374151;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 5px;
}

.form-label .req { color: #ef4444; }

/* Input */
.tp-input {
    width: 100%;
    border: 1.5px solid var(--border);
    border-radius: 12px;
    padding: 12px 15px;
    font-size: 14px;
    color: var(--text);
    background: #fafafa;
    outline: none;
    transition: border-color .2s, box-shadow .2s, background .2s;
    font-family: 'Plus Jakarta Sans', sans-serif;
    appearance: none;
}

.tp-input:focus {
    border-color: var(--g1);
    background: white;
    box-shadow: 0 0 0 3px rgba(10,127,46,.08);
}

textarea.tp-input {
    min-height: 180px;
    resize: vertical;
    line-height: 1.7;
}

select.tp-input {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' fill='none'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%239ca3af' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 14px center;
    padding-right: 36px;
    cursor: pointer;
}

/* Status pills selector */
.status-selector {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin-bottom: 6px;
}

.status-opt {
    flex: 1;
    min-width: 100px;
    border: 2px solid var(--border);
    border-radius: 12px;
    padding: 12px;
    text-align: center;
    cursor: pointer;
    transition: .2s;
    background: white;
}

.status-opt input[type="radio"] { display: none; }

.status-opt-icon {
    font-size: 20px;
    margin-bottom: 5px;
    display: block;
}

.status-opt-label {
    font-size: 12.5px;
    font-weight: 700;
    display: block;
}

.status-opt.opt-pending:has(input:checked),
.status-opt.opt-pending:hover { border-color: #dc2626; background: #fff5f5; }
.status-opt.opt-proses:has(input:checked),
.status-opt.opt-proses:hover  { border-color: #d97706; background: #fffbeb; }
.status-opt.opt-selesai:has(input:checked),
.status-opt.opt-selesai:hover { border-color: var(--g2); background: #f0fdf4; }

.opt-pending .status-opt-icon { color: #dc2626; }
.opt-proses  .status-opt-icon { color: #d97706; }
.opt-selesai .status-opt-icon { color: var(--g2); }

/* Tips box */
.tips-box {
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    border-radius: 12px;
    padding: 12px 14px;
    display: flex;
    gap: 10px;
    align-items: flex-start;
    margin-bottom: 20px;
}

.tips-box i { color: var(--g2); font-size: 15px; flex-shrink: 0; margin-top: 1px; }
.tips-box p { font-size: 12px; color: #15803d; margin: 0; line-height: 1.5; }

/* Action bar */
.form-actions {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 10px;
    padding: 16px 22px;
    border-top: 1px solid #f3f4f6;
    background: #fafcfa;
    flex-wrap: wrap;
}

.btn-cancel {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 10px 20px;
    border-radius: 12px;
    border: 1.5px solid var(--border);
    background: white;
    color: #374151;
    font-size: 13.5px;
    font-weight: 600;
    text-decoration: none;
    transition: .2s;
    font-family: 'Plus Jakarta Sans', sans-serif;
    cursor: pointer;
}

.btn-cancel:hover { background: #f4f7f5; border-color: #9ca3af; color: var(--text); }

.btn-submit {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 24px;
    border-radius: 12px;
    border: none;
    background: linear-gradient(135deg, var(--g1), var(--g2));
    color: white;
    font-size: 13.5px;
    font-weight: 700;
    transition: .25s;
    cursor: pointer;
    font-family: 'Plus Jakarta Sans', sans-serif;
    box-shadow: 0 4px 14px rgba(10,127,46,.28);
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(10,127,46,.35);
}

/* =========================================================
   RESPONSIVE — TABLET
========================================================= */

@media(min-width:769px) and (max-width:1024px){
    .tp-grid { grid-template-columns: 300px 1fr; gap: 12px; }
    .tp-topbar { padding: 14px 18px; }
    .detail-card { position: static; }
}

/* =========================================================
   RESPONSIVE — MOBILE
========================================================= */

@media(max-width:768px){

    .tp { gap: 12px; }
    .tp-topbar { padding: 12px 16px; border-radius: 14px; }
    .tp-topbar-left h3 { font-size: 15px; }
    .tp-breadcrumb { display: none; }

    /* Grid jadi 1 kolom */
    .tp-grid { grid-template-columns: 1fr; }

    .detail-card { position: static; }
    .form-card-body { padding: 16px; }
    .form-actions { padding: 14px 16px; flex-direction: column; }
    .btn-cancel, .btn-submit { width: 100%; justify-content: center; }

    .status-selector { gap: 8px; }
    .status-opt { padding: 10px 8px; }
    .status-opt-label { font-size: 11.5px; }

}

@media(max-width:400px){
    .status-opt-icon { font-size: 17px; }
}

</style>

<div class="tp">

    {{-- TOPBAR FIX --}}
    <div class="tp-topbar">
        <div class="tp-topbar-left">
            <h3>Tanggapi Laporan</h3>
            <p>Berikan tanggapan dan tindak lanjut laporan siswa</p>
        </div>
        <div class="tp-topbar-right">
            <a href="{{ url()->previous() }}" class="btn-back">
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>
        </div>
    </div>

    {{-- SCROLL AREA --}}
    <div class="tp-scroll">
        <div class="tp-grid">

            {{-- DETAIL CARD --}}
            <div class="detail-card">

                <div class="detail-card-head">
                    <span class="kategori-pill">
                        <i class="bi bi-tag"></i>
                        {{ $pengaduan->kategori }}
                    </span>
                    <span class="status-pill sp-{{ $pengaduan->status }}">
                        {{ ucfirst($pengaduan->status) }}
                    </span>
                </div>

                <div class="detail-card-body">

                    <h4 class="detail-judul">{{ $pengaduan->judul }}</h4>

                    <div class="meta-rows">
                        <div class="meta-row">
                            <div class="meta-row-icon mri-green"><i class="bi bi-person-circle"></i></div>
                            <div class="meta-row-body">
                                <small>Pelapor</small>
                                <span>{{ $pengaduan->user->name ?? '-' }}</span>
                            </div>
                        </div>
                        <div class="meta-row">
                            <div class="meta-row-icon mri-blue"><i class="bi bi-geo-alt"></i></div>
                            <div class="meta-row-body">
                                <small>Lokasi</small>
                                <span>{{ $pengaduan->lokasi ?? '-' }}</span>
                            </div>
                        </div>
                        <div class="meta-row">
                            <div class="meta-row-icon mri-amber"><i class="bi bi-calendar-event"></i></div>
                            <div class="meta-row-body">
                                <small>Tanggal</small>
                                <span>{{ \Carbon\Carbon::parse($pengaduan->created_at)->translatedFormat('d F Y') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="deskripsi-section">
                        <div class="deskripsi-section-head">
                            <i class="bi bi-file-text"></i>
                            Deskripsi Laporan
                        </div>
                        <p class="deskripsi-text">{{ $pengaduan->deskripsi }}</p>
                    </div>

                    @if($pengaduan->bukti)
                    <div class="bukti-section">
                        <img src="{{ asset('storage/' . $pengaduan->bukti) }}" alt="Bukti">
                    </div>
                    @endif

                </div>

            </div>

            {{-- FORM CARD --}}
            <div class="form-card">

                <div class="form-card-head">
                    <div class="form-card-head-left">
                        <h4>Beri Tanggapan</h4>
                        <p>Isi respon dan perbarui status laporan</p>
                    </div>
                    <div class="form-card-icon">
                        <i class="bi bi-chat-left-text"></i>
                    </div>
                </div>

                <form action="{{ route('guru.respon.store', $pengaduan->id) }}" method="POST">
                    @csrf

                    <div class="form-card-body">

                        {{-- TIPS --}}
                        <div class="tips-box">
                            <i class="bi bi-lightbulb"></i>
                            <p>Berikan tanggapan yang jelas dan solusi konkret agar siswa dapat memahami tindak lanjut yang akan dilakukan.</p>
                        </div>

                        {{-- TEXTAREA --}}
                        <div class="mb-4">
                            <label class="form-label">
                                Isi Tanggapan <span class="req">*</span>
                            </label>
                            <textarea
                                name="tanggapan"
                                class="tp-input"
                                placeholder="Tuliskan tindak lanjut atau respon terhadap laporan ini..."
                                required>{{ old('tanggapan', $pengaduan->tanggapan ?? '') }}</textarea>
                        </div>

                        {{-- STATUS --}}
                        <div class="mb-2">
                            <label class="form-label">
                                Status Laporan <span class="req">*</span>
                            </label>
                            <div class="status-selector">
                                <label class="status-opt opt-pending">
                                    <input type="radio" name="status" value="pending"
                                        {{ ($pengaduan->status ?? '') === 'pending' ? 'checked' : '' }}>
                                    <span class="status-opt-icon">⏳</span>
                                    <span class="status-opt-label">Pending</span>
                                </label>
                                <label class="status-opt opt-proses">
                                    <input type="radio" name="status" value="proses"
                                        {{ ($pengaduan->status ?? '') === 'proses' ? 'checked' : '' }}>
                                    <span class="status-opt-icon">🔄</span>
                                    <span class="status-opt-label">Diproses</span>
                                </label>
                                <label class="status-opt opt-selesai">
                                    <input type="radio" name="status" value="selesai"
                                        {{ ($pengaduan->status ?? '') === 'selesai' ? 'checked' : '' }}>
                                    <span class="status-opt-icon">✅</span>
                                    <span class="status-opt-label">Selesai</span>
                                </label>
                            </div>
                        </div>

                    </div>

                    <div class="form-actions">
                        <a href="{{ url()->previous() }}" class="btn-cancel">
                            <i class="bi bi-x"></i> Batal
                        </a>
                        <button type="submit" class="btn-submit">
                            <i class="bi bi-send-check-fill"></i>
                            Simpan Tanggapan
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>

</div>

@endsection