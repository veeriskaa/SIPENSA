@extends('layouts.siswa')

@section('title','Buat Laporan')

@section('content')

<style>

@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

:root{
    --g1: #0a7f2e;
    --g2: #16a34a;
    --g3: #22c55e;
    --surface: #ffffff;
    --bg: #f4f7f5;
    --border: #e4ece7;
    --text: #111827;
    --soft: #6b7280;
    --radius: 16px;
}

.lp-page *{
    box-sizing: border-box;
    font-family: 'Plus Jakarta Sans', sans-serif;
}

/* =============================================
   PAGE — flex column full height
============================================= */
.lp-page {
    display: flex;
    flex-direction: column;
    height: 100%;
    overflow: hidden;
    animation: pageFade .4s ease both;
}

@keyframes pageFade{
    from{ opacity:0; transform:translateY(8px); }
    to{ opacity:1; transform:translateY(0); }
}

/* =============================================
   HEADER FIX — putih, tidak scroll
============================================= */
.lp-header {
    flex-shrink: 0;
    background: #fff;
    border: 1px solid #edf1f5;
    border-radius: 18px;
    padding: 18px 24px;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 14px;
    box-shadow: 0 2px 10px rgba(15,23,42,0.04);
    flex-wrap: wrap;
}

.lp-header-left {
    display: flex;
    align-items: center;
    gap: 14px;
}

.lp-header-icon {
    width: 44px;
    height: 44px;
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

.lp-header-title {
    font-size: 18px;
    font-weight: 700;
    color: #111827;
    margin: 0 0 2px;
}

.lp-header-sub {
    font-size: 12px;
    color: #9ca3af;
    margin: 0;
}

/* =============================================
   STEP BAR — fix, tidak scroll
============================================= */
.step-bar{
    flex-shrink: 0;
    display: flex;
    align-items: center;
    margin-bottom: 16px;
    padding: 0 4px;
}

.step-item{
    display: flex;
    align-items: center;
    gap: 8px;
    flex: 1;
}

.step-item:last-child{ flex: none; }

.step-dot{
    width: 32px; height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 13px;
    font-weight: 700;
    flex-shrink: 0;
    transition: .3s;
    border: 2px solid var(--border);
    background: white;
    color: #9ca3af;
}

.step-dot.active{
    background: var(--g1);
    border-color: var(--g1);
    color: white;
    box-shadow: 0 4px 12px rgba(10,127,46,.3);
}

.step-dot.done{
    background: #dcfce7;
    border-color: var(--g2);
    color: var(--g1);
}

.step-label{
    font-size: 12px;
    font-weight: 600;
    color: #9ca3af;
    white-space: nowrap;
}

.step-label.active{ color: var(--g1); }
.step-label.done{ color: var(--g2); }

.step-line{
    flex: 1;
    height: 2px;
    background: var(--border);
    margin: 0 10px;
    border-radius: 2px;
    position: relative;
    overflow: hidden;
}

.step-line.done::after{
    content: '';
    position: absolute;
    inset: 0;
    background: var(--g2);
}

/* =============================================
   SCROLL AREA — hanya ini yang scroll
============================================= */
.lp-scroll {
    flex: 1;
    overflow-y: auto;
    overflow-x: hidden;
    min-height: 0;
    padding-bottom: 32px;
    scrollbar-width: thin;
    scrollbar-color: #e5e7eb transparent;
}

.lp-scroll::-webkit-scrollbar { width: 5px; }
.lp-scroll::-webkit-scrollbar-thumb { background: #e5e7eb; border-radius: 99px; }

/* =============================================
   FORM CARD
============================================= */
.lp-card{
    background: var(--surface);
    border-radius: 20px;
    border: 1px solid var(--border);
    box-shadow: 0 4px 24px rgba(15,23,42,.05);
    overflow: hidden;
}

.form-section{
    padding: 24px 28px;
    border-bottom: 1px solid #f1f5f2;
    transition: background .2s;
}

.form-section:last-of-type{ border-bottom: none; }
.form-section:hover{ background: #fdfffe; }

.section-head{
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 20px;
}

.section-icon{
    width: 38px; height: 38px;
    border-radius: 11px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 17px;
    flex-shrink: 0;
}

.section-icon.green { background: #dcfce7; color: var(--g1); }
.section-icon.blue  { background: #dbeafe; color: #1d4ed8; }
.section-icon.amber { background: #fef3c7; color: #b45309; }

.section-title{
    font-size: 15px;
    font-weight: 700;
    color: var(--text);
    margin: 0 0 2px;
}

.section-sub{
    font-size: 12px;
    color: var(--soft);
    margin: 0;
}

/* INPUT */
.form-label{
    font-size: 13px;
    font-weight: 600;
    color: #374151;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 5px;
}

.form-label .req{ color: #ef4444; font-size: 14px; line-height: 1; }

.lp-input{
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
    -webkit-appearance: none;
}

.lp-input:focus{
    border-color: var(--g1);
    background: white;
    box-shadow: 0 0 0 3px rgba(10,127,46,.08);
}

.lp-input::placeholder{ color: #b0b8c1; }

select.lp-input{
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' fill='none'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%239ca3af' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 14px center;
    padding-right: 36px;
}

textarea.lp-input{
    min-height: 150px;
    resize: vertical;
    line-height: 1.6;
}

.input-hint{
    font-size: 11.5px;
    color: #9ca3af;
    margin-top: 5px;
    display: flex;
    align-items: center;
    gap: 4px;
}

/* FILE UPLOAD */
.file-upload-area{
    border: 2px dashed var(--border);
    border-radius: 14px;
    padding: 24px;
    text-align: center;
    cursor: pointer;
    transition: .25s;
    background: #fafafa;
    position: relative;
}

.file-upload-area:hover{ border-color: var(--g2); background: #f0fdf4; }
.file-upload-area.has-file{ border-color: var(--g2); background: #f0fdf4; }

.file-upload-area input[type="file"]{
    position: absolute;
    inset: 0;
    opacity: 0;
    cursor: pointer;
    width: 100%;
    height: 100%;
}

.upload-icon{
    width: 48px; height: 48px;
    border-radius: 14px;
    background: #dcfce7;
    color: var(--g1);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    margin: 0 auto 12px;
    transition: .25s;
}

.file-upload-area:hover .upload-icon{ background: var(--g1); color: white; transform: translateY(-2px); }

.upload-title{ font-size: 14px; font-weight: 600; color: var(--text); margin: 0 0 4px; }
.upload-sub{ font-size: 12px; color: var(--soft); margin: 0; }
.file-name-display{ margin-top: 10px; font-size: 12.5px; color: var(--g1); font-weight: 600; display: none; }

/* KATEGORI PILLS */
.kategori-pills{ display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 12px; }

.pill{
    display: flex;
    align-items: center;
    gap: 7px;
    padding: 9px 16px;
    border-radius: 30px;
    border: 1.5px solid var(--border);
    background: white;
    font-size: 13px;
    font-weight: 500;
    color: #6b7280;
    cursor: pointer;
    transition: .2s;
    user-select: none;
}

.pill:hover{ border-color: var(--g2); color: var(--g1); background: #f0fdf4; }

.pill.selected{
    border-color: var(--g1);
    background: var(--g1);
    color: white;
    box-shadow: 0 3px 10px rgba(10,127,46,.25);
}

.pill-emoji{ font-size: 16px; }
#kategoriInput{ display: none; }

/* ACTION BAR */
.lp-actions{
    padding: 20px 28px;
    background: #f9fbf9;
    border-top: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
}

.lp-actions-left{
    font-size: 13px;
    color: var(--soft);
    display: flex;
    align-items: center;
    gap: 6px;
}

.lp-actions-left i{ color: var(--g2); }
.lp-actions-right{ display: flex; gap: 10px; flex-wrap: wrap; }

.btn-cancel{
    padding: 11px 22px;
    border-radius: 12px;
    border: 1.5px solid var(--border);
    background: white;
    color: #374151;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 7px;
    transition: .2s;
    cursor: pointer;
    font-family: 'Plus Jakarta Sans', sans-serif;
}

.btn-cancel:hover{ background: #f9fafb; border-color: #9ca3af; color: #111827; }

.btn-submit{
    padding: 11px 26px;
    border-radius: 12px;
    border: none;
    background: linear-gradient(135deg, var(--g1), var(--g2));
    color: white;
    font-size: 14px;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: .25s;
    cursor: pointer;
    font-family: 'Plus Jakarta Sans', sans-serif;
    box-shadow: 0 4px 14px rgba(10,127,46,.3);
}

.btn-submit:hover{ transform: translateY(-2px); box-shadow: 0 8px 20px rgba(10,127,46,.35); }
.btn-submit:disabled{ opacity: .65; transform: none; cursor: not-allowed; }

/* =============================================
   RESPONSIVE — TABLET
============================================= */
@media (min-width: 769px) and (max-width: 1024px){
    .lp-header { padding: 16px 20px; border-radius: 14px; }
    .form-section { padding: 20px 22px; }
    .lp-actions { padding: 16px 22px; }
}

/* =============================================
   RESPONSIVE — MOBILE
============================================= */
@media (max-width: 768px){

    .lp-header {
        padding: 14px 16px;
        border-radius: 14px;
        margin-bottom: 12px;
    }

    .lp-header-icon { width: 38px; height: 38px; font-size: 17px; border-radius: 11px; }
    .lp-header-title { font-size: 15px; }
    .lp-header-sub { font-size: 11px; }

    .step-bar { display: none; }

    .form-section { padding: 16px 14px; }

    .section-icon { width: 34px; height: 34px; font-size: 15px; }
    .section-title { font-size: 14px; }

    .kategori-pills { gap: 7px; }
    .pill { padding: 8px 12px; font-size: 12px; }

    .file-upload-area { padding: 18px 12px; }

    .lp-actions {
        padding: 14px;
        flex-direction: column;
        align-items: stretch;
    }

    .lp-actions-left { justify-content: center; font-size: 12px; }
    .lp-actions-right { flex-direction: column; }
    .btn-cancel, .btn-submit { width: 100%; justify-content: center; }

    textarea.lp-input { min-height: 120px; }
}

@media (max-width: 400px){
    .lp-header-icon { display: none; }
    .lp-header-title { font-size: 14px; }
}

</style>

<div class="lp-page">

    {{-- HEADER FIX (putih) --}}
    <div class="lp-header">
        <div class="lp-header-left">
            <div class="lp-header-icon">
                <i class="bi bi-file-earmark-plus"></i>
            </div>
            <div>
                <h1 class="lp-header-title">Buat Laporan Baru</h1>
                <p class="lp-header-sub">Sampaikan permasalahan dengan detail agar dapat segera ditindaklanjuti</p>
            </div>
        </div>
    </div>

    {{-- STEP BAR FIX --}}
    <div class="step-bar">
        <div class="step-item">
            <div class="step-dot active" id="step1">1</div>
            <span class="step-label active">Kategori & Lokasi</span>
        </div>
        <div class="step-line" id="line1"></div>
        <div class="step-item">
            <div class="step-dot" id="step2">2</div>
            <span class="step-label">Detail Laporan</span>
        </div>
        <div class="step-line" id="line2"></div>
        <div class="step-item">
            <div class="step-dot" id="step3">3</div>
            <span class="step-label">Bukti & Kirim</span>
        </div>
    </div>

    {{-- KONTEN SCROLL --}}
    <div class="lp-scroll">

        <div class="lp-card">

            <form action="{{ route('laporan.store') }}"
                  method="POST"
                  enctype="multipart/form-data"
                  id="laporanForm">

                @csrf
                <input type="hidden" name="kategori" id="kategoriInput">

                {{-- SECTION 1 --}}
                <div class="form-section">
                    <div class="section-head">
                        <div class="section-icon green"><i class="bi bi-tag"></i></div>
                        <div>
                            <p class="section-title">Kategori & Lokasi</p>
                            <p class="section-sub">Pilih jenis permasalahan dan lokasi kejadian</p>
                        </div>
                    </div>

                    <label class="form-label">Kategori Masalah <span class="req">*</span></label>
                    <div class="kategori-pills">
                        <div class="pill" data-value="Bullying" onclick="pilihKategori(this)">
                            <span class="pill-emoji">🛡️</span> Bullying
                        </div>
                        <div class="pill" data-value="Fasilitas" onclick="pilihKategori(this)">
                            <span class="pill-emoji">🏫</span> Fasilitas
                        </div>
                        <div class="pill" data-value="Akademik" onclick="pilihKategori(this)">
                            <span class="pill-emoji">📚</span> Akademik
                        </div>
                        <div class="pill" data-value="Kekerasan" onclick="pilihKategori(this)">
                            <span class="pill-emoji">⚠️</span> Kekerasan
                        </div>
                        <div class="pill" data-value="Lainnya" onclick="pilihKategori(this)">
                            <span class="pill-emoji">💬</span> Lainnya
                        </div>
                    </div>

                    <div class="mt-3">
                        <label class="form-label">Lokasi Kejadian</label>
                        <input type="text" name="lokasi" class="lp-input"
                               placeholder="Contoh: Ruang Kelas XI TKJ, Kantin, Lapangan">
                    </div>
                </div>

                {{-- SECTION 2 --}}
                <div class="form-section">
                    <div class="section-head">
                        <div class="section-icon blue"><i class="bi bi-pencil-square"></i></div>
                        <div>
                            <p class="section-title">Detail Laporan</p>
                            <p class="section-sub">Isi judul, waktu, dan deskripsi kejadian</p>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Judul Laporan <span class="req">*</span></label>
                            <input type="text" name="judul" class="lp-input"
                                   placeholder="Tuliskan judul singkat yang menggambarkan masalah" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Waktu Kejadian</label>
                            <input type="datetime-local" name="waktu" class="lp-input">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Deskripsi Detail <span class="req">*</span></label>
                            <textarea name="deskripsi" class="lp-input"
                                      placeholder="Ceritakan kejadian secara lengkap — siapa, apa, kapan, di mana, dan bagaimana..."
                                      required></textarea>
                            <p class="input-hint">
                                <i class="bi bi-info-circle"></i>
                                Semakin detail laporan, semakin cepat dapat ditangani
                            </p>
                        </div>
                    </div>
                </div>

                {{-- SECTION 3 --}}
                <div class="form-section">
                    <div class="section-head">
                        <div class="section-icon amber"><i class="bi bi-paperclip"></i></div>
                        <div>
                            <p class="section-title">Bukti Pendukung</p>
                            <p class="section-sub">Lampirkan foto, video, atau dokumen (opsional)</p>
                        </div>
                    </div>

                    <div class="file-upload-area" id="uploadArea">
                        <input type="file" name="bukti" id="buktiInput"
                               accept="image/*,.pdf" onchange="onFileChange(this)">
                        <div class="upload-icon"><i class="bi bi-cloud-arrow-up"></i></div>
                        <p class="upload-title">Klik atau seret file ke sini</p>
                        <p class="upload-sub">JPG, PNG, PDF &nbsp;·&nbsp; Maksimal 5MB</p>
                        <p class="file-name-display" id="fileName"></p>
                    </div>
                </div>

                {{-- ACTION BAR --}}
                <div class="lp-actions">
                    <div class="lp-actions-left">
                        <i class="bi bi-shield-check"></i>
                        Laporan kamu bersifat rahasia dan aman
                    </div>
                    <div class="lp-actions-right">
                        <a href="/siswa" class="btn-cancel">
                            <i class="bi bi-x"></i> Batal
                        </a>
                        <button type="submit" id="submitBtn" class="btn-submit">
                            <i class="bi bi-send-fill"></i>
                            Kirim Laporan
                        </button>
                    </div>
                </div>

            </form>
        </div>

    </div>{{-- end lp-scroll --}}

</div>{{-- end lp-page --}}

<script>
function pilihKategori(el){
    document.querySelectorAll('.pill').forEach(p => p.classList.remove('selected'));
    el.classList.add('selected');
    document.getElementById('kategoriInput').value = el.dataset.value;
    updateStep();
}

function updateStep(){
    const s1 = document.getElementById('step1');
    const s2 = document.getElementById('step2');
    const l1 = document.getElementById('line1');
    s1.classList.remove('active');
    s1.classList.add('done');
    s1.innerHTML = '<i class="bi bi-check"></i>';
    l1.classList.add('done');
    s2.classList.add('active');
    document.querySelector('.step-label.active')?.classList.remove('active');
}

function onFileChange(input){
    const area = document.getElementById('uploadArea');
    const display = document.getElementById('fileName');
    if(input.files && input.files[0]){
        const name = input.files[0].name;
        const size = (input.files[0].size / 1024 / 1024).toFixed(2);
        area.classList.add('has-file');
        display.style.display = 'block';
        display.innerHTML = `<i class="bi bi-file-earmark-check me-1"></i>${name} (${size} MB)`;
        const s3 = document.getElementById('step3');
        const l2 = document.getElementById('line2');
        s3.classList.add('active');
        l2.classList.add('done');
    }
}

document.getElementById('laporanForm').addEventListener('submit', function(e){
    const kategori = document.getElementById('kategoriInput').value;
    if(!kategori){
        e.preventDefault();
        alert('Pilih kategori laporan terlebih dahulu.');
        return;
    }
    const btn = document.getElementById('submitBtn');
    btn.disabled = true;
    btn.innerHTML = `<span class="spinner-border spinner-border-sm me-2" style="width:14px;height:14px;"></span>Mengirim...`;
});
</script>

@endsection