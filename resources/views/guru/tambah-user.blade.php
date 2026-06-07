@extends('layouts.guru')

@section('title','Tambah User')

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

.tu * { box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }

/* =========================================================
   PAGE
========================================================= */

.tu {
    height: 100%;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    gap: 14px;
    animation: tuFade .35s ease both;
}

@keyframes tuFade {
    from { opacity:0; transform:translateY(8px); }
    to   { opacity:1; transform:translateY(0); }
}

/* =========================================================
   TOPBAR — fix
========================================================= */

.tu-topbar {
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

.tu-topbar-left h3 {
    font-size: 18px;
    font-weight: 800;
    color: var(--text);
    margin: 0 0 2px;
    letter-spacing: -.2px;
}

.tu-topbar-left p {
    font-size: 12px;
    color: var(--soft);
    margin: 0;
}

.btn-back {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    border-radius: 11px;
    border: 1.5px solid var(--border);
    background: white;
    color: #374151;
    font-size: 12.5px;
    font-weight: 600;
    text-decoration: none;
    transition: .2s;
    white-space: nowrap;
}

.btn-back:hover {
    background: #f4f7f5;
    border-color: #9ca3af;
    color: var(--text);
}

/* =========================================================
   SCROLL — satu-satunya yang scroll
========================================================= */

.tu-scroll {
    flex: 1;
    overflow-y: auto;
    overflow-x: hidden;
    padding-right: 2px;
    padding-bottom: 24px;
    scrollbar-width: thin;
    scrollbar-color: #e5e7eb transparent;
}

.tu-scroll::-webkit-scrollbar { width: 5px; }
.tu-scroll::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 20px; }

/* =========================================================
   ALERT
========================================================= */

.tu-alert {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 13px 16px;
    border-radius: 14px;
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    color: #15803d;
    font-size: 13px;
    font-weight: 500;
    margin-bottom: 16px;
}

.tu-alert i { font-size: 16px; }

/* =========================================================
   FORM GRID
========================================================= */

.tu-form-grid {
    display: grid;
    grid-template-columns: 280px 1fr;
    gap: 14px;
    align-items: start;
}

/* =========================================================
   INFO CARD (kiri)
========================================================= */

.info-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(15,23,42,.04);
    position: sticky;
    top: 0;
}

.info-card-head {
    background: linear-gradient(135deg, #0b6b27, var(--g2));
    padding: 24px 20px;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.info-card-head::before {
    content: '';
    position: absolute;
    width: 120px; height: 120px;
    border-radius: 50%;
    background: rgba(255,255,255,.07);
    top: -40px; right: -30px;
}

.info-avatar-preview {
    width: 72px; height: 72px;
    border-radius: 20px;
    background: rgba(255,255,255,.15);
    border: 2px solid rgba(255,255,255,.3);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    color: white;
    margin: 0 auto 12px;
    overflow: hidden;
    position: relative;
    z-index: 1;
    transition: .2s;
}

.info-avatar-preview img {
    width: 100%; height: 100%;
    object-fit: cover;
    display: none;
    border-radius: 18px;
}

.info-card-head h5 {
    font-size: 14px;
    font-weight: 700;
    color: white;
    margin: 0 0 3px;
    position: relative;
    z-index: 1;
}

.info-card-head p {
    font-size: 12px;
    color: rgba(255,255,255,.7);
    margin: 0;
    position: relative;
    z-index: 1;
}

.info-card-body { padding: 16px 18px; }

.info-tip {
    display: flex;
    gap: 10px;
    align-items: flex-start;
    padding: 11px 13px;
    border-radius: 12px;
    margin-bottom: 10px;
    font-size: 12.5px;
    line-height: 1.5;
}

.info-tip:last-child { margin-bottom: 0; }

.info-tip.tip-green  { background: #f0fdf4; border: 1px solid #bbf7d0; color: #15803d; }
.info-tip.tip-blue   { background: #eff6ff; border: 1px solid #bfdbfe; color: #1d4ed8; }
.info-tip.tip-amber  { background: #fffbeb; border: 1px solid #fde68a; color: #b45309; }

.info-tip i { font-size: 13px; flex-shrink: 0; margin-top: 1px; }

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

.form-card-head {
    padding: 18px 22px;
    border-bottom: 1px solid #f3f4f6;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
}

.form-card-head-left h4 {
    font-size: 15px;
    font-weight: 800;
    color: var(--text);
    margin: 0 0 2px;
}

.form-card-head-left p {
    font-size: 12px;
    color: var(--soft);
    margin: 0;
}

.form-card-icon {
    width: 42px; height: 42px;
    border-radius: 12px;
    background: #dcfce7;
    color: var(--g1);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    flex-shrink: 0;
}

.form-card-body { padding: 22px; }

/* =========================================================
   SECTION DALAM FORM
========================================================= */

.form-section {
    margin-bottom: 22px;
}

.form-section-title {
    font-size: 11px;
    font-weight: 700;
    color: #9ca3af;
    text-transform: uppercase;
    letter-spacing: .6px;
    margin-bottom: 14px;
    display: flex;
    align-items: center;
    gap: 7px;
}

.form-section-title::after {
    content: '';
    flex: 1;
    height: 1px;
    background: #f3f4f6;
}

/* =========================================================
   INPUT
========================================================= */

.form-label {
    font-size: 13px;
    font-weight: 700;
    color: #374151;
    margin-bottom: 7px;
    display: flex;
    align-items: center;
    gap: 5px;
}

.form-label .req { color: #ef4444; }

.tu-input {
    width: 100%;
    border: 1.5px solid var(--border);
    border-radius: 12px;
    padding: 11px 14px;
    font-size: 14px;
    color: var(--text);
    background: #fafafa;
    outline: none;
    transition: border-color .2s, box-shadow .2s, background .2s;
    font-family: 'Plus Jakarta Sans', sans-serif;
    appearance: none;
}

.tu-input:focus {
    border-color: var(--g1);
    background: white;
    box-shadow: 0 0 0 3px rgba(10,127,46,.08);
}

.tu-input::placeholder { color: #b0b8c1; font-size: 13px; }

select.tu-input {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' fill='none'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%239ca3af' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 14px center;
    padding-right: 36px;
    cursor: pointer;
}

/* File input custom */
.file-zone {
    border: 2px dashed var(--border);
    border-radius: 12px;
    padding: 18px;
    text-align: center;
    cursor: pointer;
    transition: .25s;
    background: #fafafa;
    position: relative;
}

.file-zone:hover {
    border-color: var(--g2);
    background: #f0fdf4;
}

.file-zone.has-file {
    border-color: var(--g2);
    background: #f0fdf4;
}

.file-zone input[type="file"] {
    position: absolute;
    inset: 0;
    opacity: 0;
    cursor: pointer;
    width: 100%;
    height: 100%;
}

.fz-icon {
    width: 40px; height: 40px;
    border-radius: 11px;
    background: #dcfce7;
    color: var(--g1);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    margin: 0 auto 8px;
    transition: .2s;
}

.file-zone:hover .fz-icon {
    background: var(--g1);
    color: white;
}

.fz-title {
    font-size: 13px;
    font-weight: 600;
    color: var(--text);
    margin: 0 0 3px;
}

.fz-sub {
    font-size: 11.5px;
    color: var(--soft);
    margin: 0;
}

.fz-name {
    margin-top: 8px;
    font-size: 12px;
    color: var(--g1);
    font-weight: 600;
    display: none;
}

/* Role selector */
.role-selector {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}

.role-opt {
    border: 2px solid var(--border);
    border-radius: 12px;
    padding: 14px;
    text-align: center;
    cursor: pointer;
    transition: .2s;
    background: white;
    position: relative;
}

.role-opt input[type="radio"] { display: none; }

.role-opt-icon {
    font-size: 22px;
    margin-bottom: 6px;
    display: block;
}

.role-opt-label {
    font-size: 13px;
    font-weight: 700;
    color: var(--text);
    display: block;
    margin-bottom: 2px;
}

.role-opt-sub {
    font-size: 11px;
    color: var(--soft);
    display: block;
}

.role-opt.opt-siswa:has(input:checked),
.role-opt.opt-siswa:hover {
    border-color: #2563eb;
    background: #eff6ff;
}

.role-opt.opt-guru:has(input:checked),
.role-opt.opt-guru:hover {
    border-color: #d97706;
    background: #fffbeb;
}

.role-opt .check-indicator {
    position: absolute;
    top: 8px; right: 8px;
    width: 18px; height: 18px;
    border-radius: 50%;
    border: 2px solid var(--border);
    background: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 10px;
    transition: .2s;
}

.role-opt.opt-siswa:has(input:checked) .check-indicator {
    background: #2563eb;
    border-color: #2563eb;
    color: white;
}

.role-opt.opt-siswa:has(input:checked) .check-indicator::after { content: '✓'; }

.role-opt.opt-guru:has(input:checked) .check-indicator {
    background: #d97706;
    border-color: #d97706;
    color: white;
}

.role-opt.opt-guru:has(input:checked) .check-indicator::after { content: '✓'; }

/* =========================================================
   ACTION BAR
========================================================= */

.form-actions {
    padding: 16px 22px;
    border-top: 1px solid #f3f4f6;
    background: #fafcfa;
    display: flex;
    justify-content: flex-end;
    gap: 10px;
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
    .tu-form-grid { grid-template-columns: 240px 1fr; gap: 12px; }
    .tu-topbar { padding: 14px 18px; }
    .info-card { position: static; }
    .form-card-body { padding: 18px; }
}

/* =========================================================
   RESPONSIVE — MOBILE
========================================================= */

@media(max-width:768px){

    .tu { gap: 12px; }
    .tu-topbar { padding: 12px 16px; border-radius: 14px; }
    .tu-topbar-left h3 { font-size: 15px; }

    .tu-form-grid { grid-template-columns: 1fr; }
    .info-card { position: static; }
    .info-card-head { padding: 18px 16px; }
    .info-avatar-preview { width: 60px; height: 60px; font-size: 24px; }

    .form-card-head { padding: 14px 16px; }
    .form-card-body { padding: 16px; }
    .form-actions { padding: 14px 16px; flex-direction: column; }
    .btn-cancel, .btn-submit { width: 100%; justify-content: center; }

    .role-selector { grid-template-columns: 1fr 1fr; gap: 8px; }
    .role-opt { padding: 12px 10px; }
    .role-opt-icon { font-size: 20px; }
    .role-opt-label { font-size: 12px; }

}

@media(max-width:400px){
    .info-card { display: none; }
}

</style>

<div class="tu">

    {{-- TOPBAR FIX --}}
    <div class="tu-topbar">
        <div class="tu-topbar-left">
            <h3>Tambah Pengguna</h3>
            <p>Buat akun baru untuk siswa atau Guru BK</p>
        </div>
        <a href="/kelola-user" class="btn-back">
            <i class="bi bi-arrow-left"></i>
            Kembali
        </a>
    </div>

    {{-- SCROLL AREA --}}
    <div class="tu-scroll">

        {{-- ALERT --}}
        @if(session('success'))
        <div class="tu-alert">
            <i class="bi bi-check-circle-fill"></i>
            {{ session('success') }}
        </div>
        @endif

        <div class="tu-form-grid">

            {{-- INFO CARD (kiri) --}}
            <div class="info-card">

                <div class="info-card-head">
                    <div class="info-avatar-preview" id="avatarPreview">
                        <i class="bi bi-person"></i>
                        <img id="avatarImg" src="" alt="">
                    </div>
                    <h5 id="previewName">Nama Pengguna</h5>
                    <p id="previewRole">Pilih role di form</p>
                </div>

                <div class="info-card-body">
                    <div class="info-tip tip-green">
                        <i class="bi bi-shield-check"></i>
                        Password akan di-hash otomatis dan aman disimpan.
                    </div>
                    <div class="info-tip tip-blue">
                        <i class="bi bi-person-badge"></i>
                        Siswa hanya bisa membuat dan melihat laporan miliknya.
                    </div>
                    <div class="info-tip tip-amber">
                        <i class="bi bi-mortarboard"></i>
                        Guru BK dapat melihat & menanggapi semua laporan.
                    </div>
                </div>

            </div>

            {{-- FORM CARD (kanan) --}}
            <div class="form-card">

                <div class="form-card-head">
                    <div class="form-card-head-left">
                        <h4>Informasi Akun</h4>
                        <p>Isi semua data dengan lengkap dan benar</p>
                    </div>
                    <div class="form-card-icon">
                        <i class="bi bi-person-plus"></i>
                    </div>
                </div>

                <form action="/kelola-user/store" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-card-body">

                        {{-- IDENTITAS --}}
                        <div class="form-section">
                            <div class="form-section-title">Identitas</div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">
                                        Nama Lengkap <span class="req">*</span>
                                    </label>
                                    <input type="text" name="name" class="tu-input"
                                           id="inputName"
                                           placeholder="Masukkan nama lengkap"
                                           oninput="updatePreview()"
                                           required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">
                                        Email <span class="req">*</span>
                                    </label>
                                    <input type="email" name="email" class="tu-input"
                                           placeholder="contoh@email.com"
                                           required>
                                </div>
                            </div>
                        </div>

                        {{-- KEAMANAN --}}
                        <div class="form-section">
                            <div class="form-section-title">Keamanan</div>

                            <label class="form-label">
                                Password <span class="req">*</span>
                            </label>
                            <input type="password" name="password" class="tu-input"
                                   placeholder="Min. 6 karakter"
                                   required>
                        </div>

                        {{-- ROLE --}}
                        <div class="form-section">
                            <div class="form-section-title">Role Pengguna</div>

                            <div class="role-selector">
                                <label class="role-opt opt-siswa" onclick="updateRolePreview('Siswa')">
                                    <input type="radio" name="role" value="siswa" checked>
                                    <div class="check-indicator"></div>
                                    <span class="role-opt-icon">👨‍🎓</span>
                                    <span class="role-opt-label">Siswa</span>
                                    <span class="role-opt-sub">Akses laporan sendiri</span>
                                </label>
                                <label class="role-opt opt-guru" onclick="updateRolePreview('Guru BK')">
                                    <input type="radio" name="role" value="guru_bk">
                                    <div class="check-indicator"></div>
                                    <span class="role-opt-icon">👨‍🏫</span>
                                    <span class="role-opt-label">Guru BK</span>
                                    <span class="role-opt-sub">Akses semua laporan</span>
                                </label>
                            </div>
                        </div>

                        {{-- FOTO --}}
                        <div class="form-section" style="margin-bottom:0;">
                            <div class="form-section-title">Foto Profil</div>

                            <div class="file-zone" id="fileZone">
                                <input type="file" name="foto" accept="image/*"
                                       onchange="onFotoChange(this)">
                                <div class="fz-icon">
                                    <i class="bi bi-camera"></i>
                                </div>
                                <p class="fz-title">Klik atau seret foto ke sini</p>
                                <p class="fz-sub">JPG, PNG · Opsional · Maks 2MB</p>
                                <p class="fz-name" id="fzName"></p>
                            </div>
                        </div>

                    </div>

                    <div class="form-actions">
                        <a href="/kelola-user" class="btn-cancel">
                            <i class="bi bi-x"></i> Batal
                        </a>
                        <button type="submit" class="btn-submit">
                            <i class="bi bi-person-plus-fill"></i>
                            Tambah Pengguna
                        </button>
                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<script>

/* Preview nama */
function updatePreview(){
    const name = document.getElementById('inputName').value;
    document.getElementById('previewName').textContent = name || 'Nama Pengguna';
}

/* Preview role */
function updateRolePreview(role){
    document.getElementById('previewRole').textContent = role;
}

/* Foto preview */
function onFotoChange(input){
    if(!input.files || !input.files[0]) return;

    const file  = input.files[0];
    const name  = file.name;
    const size  = (file.size / 1024 / 1024).toFixed(2);

    /* Nama file */
    const fzName = document.getElementById('fzName');
    fzName.style.display = 'block';
    fzName.innerHTML = `<i class="bi bi-file-earmark-image me-1"></i>${name} (${size} MB)`;
    document.getElementById('fileZone').classList.add('has-file');

    /* Preview avatar */
    const reader = new FileReader();
    reader.onload = e => {
        const img = document.getElementById('avatarImg');
        const icon = document.querySelector('#avatarPreview > i');
        img.src = e.target.result;
        img.style.display = 'block';
        if(icon) icon.style.display = 'none';
    };
    reader.readAsDataURL(file);
}

</script>

@endsection