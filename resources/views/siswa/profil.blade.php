@extends('layouts.siswa')

@section('title','Profil Saya')

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

.pp * { box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }

/* =============================================
   PAGE
============================================= */
.pp {
    display: flex;
    flex-direction: column;
    height: 100%;
    overflow: hidden;
    animation: ppFade .4s ease both;
}

@keyframes ppFade {
    from { opacity: 0; transform: translateY(8px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* =============================================
   HEADER FIX
============================================= */
.pp-header {
    flex-shrink: 0;
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 18px;
    padding: 18px 22px;
    margin-bottom: 14px;
    box-shadow: 0 2px 10px rgba(15,23,42,.04);
    display: flex;
    align-items: center;
    gap: 14px;
}

.pp-header-icon {
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

.pp-header-title { font-size: 18px; font-weight: 700; color: #111827; margin: 0 0 2px; }
.pp-header-sub   { font-size: 12px; color: #9ca3af; margin: 0; }

/* =============================================
   SCROLL
============================================= */
.pp-scroll {
    flex: 1;
    overflow-y: auto;
    overflow-x: hidden;
    min-height: 0;
    padding-bottom: 32px;
    scrollbar-width: thin;
    scrollbar-color: #e5e7eb transparent;
}

.pp-scroll::-webkit-scrollbar { width: 5px; }
.pp-scroll::-webkit-scrollbar-thumb { background: #e5e7eb; border-radius: 99px; }

/* =============================================
   AVATAR SECTION
============================================= */
.pp-avatar-section {
    background: linear-gradient(135deg, var(--g1) 0%, var(--g2) 55%, var(--g3) 100%);
    border-radius: 18px;
    padding: 24px 26px;
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 16px;
    position: relative;
    overflow: hidden;
}

.pp-avatar-section::before {
    content: '';
    position: absolute;
    width: 200px; height: 200px;
    border-radius: 50%;
    background: rgba(255,255,255,.06);
    top: -80px; right: -30px;
    pointer-events: none;
}

.pp-avatar-wrap {
    position: relative;
    flex-shrink: 0;
}

.pp-avatar {
    width: 80px; height: 80px;
    border-radius: 22px;
    border: 3px solid rgba(255,255,255,.3);
    background: rgba(255,255,255,.15);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 32px;
    font-weight: 800;
    color: white;
    overflow: hidden;
}

.pp-avatar img { width: 100%; height: 100%; object-fit: cover; }

.pp-avatar-badge {
    position: absolute;
    bottom: -4px; right: -4px;
    width: 24px; height: 24px;
    border-radius: 7px;
    background: rgba(255,255,255,.9);
    color: var(--g1);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    border: 2px solid rgba(255,255,255,.5);
}

.pp-avatar-info { flex: 1; min-width: 0; position: relative; z-index: 1; }

.pp-avatar-name {
    font-size: 20px;
    font-weight: 800;
    color: white;
    margin: 0 0 3px;
    letter-spacing: -.2px;
}

.pp-avatar-email { font-size: 13px; color: rgba(255,255,255,.75); margin: 0 0 10px; }

.badge-active {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(255,255,255,.15);
    border: 1px solid rgba(255,255,255,.25);
    color: white;
    padding: 5px 12px;
    border-radius: 30px;
    font-size: 11px;
    font-weight: 600;
    backdrop-filter: blur(4px);
}

.badge-active::before {
    content: '';
    width: 6px; height: 6px;
    border-radius: 50%;
    background: #86efac;
    animation: activePulse 2s infinite;
}

@keyframes activePulse {
    0%,100% { opacity: 1; }
    50%      { opacity: .4; }
}

/* =============================================
   MAIN GRID
============================================= */
.pp-grid {
    display: grid;
    grid-template-columns: 280px 1fr;
    gap: 14px;
    align-items: start;
}

/* =============================================
   CARD BASE
============================================= */
.pp-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 18px;
    box-shadow: 0 2px 10px rgba(15,23,42,.04);
    overflow: hidden;
    margin-bottom: 14px;
}

.pp-card:last-child { margin-bottom: 0; }

.pp-card-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px 20px;
    border-bottom: 1px solid #f3f4f6;
}

.pp-card-head-left h5 { font-size: 14px; font-weight: 700; color: var(--text); margin: 0 0 2px; }
.pp-card-head-left small { font-size: 11.5px; color: var(--soft); }

.pp-card-icon {
    width: 38px; height: 38px;
    border-radius: 11px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 17px;
    flex-shrink: 0;
}

.ic-green  { background: #dcfce7; color: var(--g1); }
.ic-blue   { background: #dbeafe; color: #1d4ed8; }
.ic-amber  { background: #fef3c7; color: #b45309; }
.ic-purple { background: #f3e8ff; color: #7c3aed; }
.ic-red    { background: #fee2e2; color: #dc2626; }

.pp-card-body { padding: 18px 20px; }

/* =============================================
   INFO ROWS
============================================= */
.info-rows { padding: 4px 0; }

.info-row {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 20px;
    border-bottom: 1px solid #f7f9f7;
    transition: background .15s;
}

.info-row:last-child { border-bottom: none; }
.info-row:hover { background: #fafcfa; }

.info-row-icon {
    width: 34px; height: 34px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    flex-shrink: 0;
}

.ir-green  { background: #dcfce7; color: var(--g1); }
.ir-blue   { background: #dbeafe; color: #1d4ed8; }
.ir-amber  { background: #fef3c7; color: #b45309; }
.ir-rose   { background: #fce7f3; color: #be185d; }

.info-row-label { font-size: 10.5px; color: var(--soft); text-transform: uppercase; letter-spacing: .5px; font-weight: 600; margin-bottom: 1px; }
.info-row-val   { font-size: 13px; font-weight: 600; color: var(--text); }

/* =============================================
   FILE ZONE
============================================= */
.file-zone {
    border: 2px dashed var(--border);
    border-radius: 14px;
    padding: 22px 16px;
    text-align: center;
    cursor: pointer;
    transition: .25s;
    background: #fafcfa;
    position: relative;
    margin-bottom: 14px;
}

.file-zone:hover { border-color: var(--g2); background: #f0fdf4; }
.file-zone.has-file { border-color: var(--g2); background: #f0fdf4; }

.file-zone input[type="file"] {
    position: absolute; inset: 0;
    opacity: 0; cursor: pointer;
    width: 100%; height: 100%;
}

.fz-icon {
    width: 46px; height: 46px;
    border-radius: 13px;
    background: #dcfce7;
    color: var(--g1);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    margin: 0 auto 10px;
    transition: .25s;
}

.file-zone:hover .fz-icon { background: var(--g1); color: white; transform: translateY(-2px); }

.fz-title { font-size: 13px; font-weight: 600; color: var(--text); margin: 0 0 3px; }
.fz-sub   { font-size: 11.5px; color: var(--soft); margin: 0; }
.fz-name  { margin-top: 8px; font-size: 12px; color: var(--g1); font-weight: 600; display: none; }

/* =============================================
   FORM INPUT
============================================= */
.form-group { margin-bottom: 14px; }
.form-group:last-child { margin-bottom: 0; }

.form-label-pp {
    font-size: 12px;
    font-weight: 600;
    color: #374151;
    margin-bottom: 6px;
    display: flex;
    align-items: center;
    gap: 5px;
}

.form-label-pp .req { color: #ef4444; }

.pp-input {
    width: 100%;
    border: 1.5px solid var(--border);
    border-radius: 11px;
    padding: 11px 14px;
    font-size: 13.5px;
    color: var(--text);
    background: #fafafa;
    outline: none;
    transition: .2s;
    font-family: 'Plus Jakarta Sans', sans-serif;
}

.pp-input:focus {
    border-color: var(--g1);
    background: white;
    box-shadow: 0 0 0 3px rgba(10,127,46,.08);
}

.pp-input::placeholder { color: #b0b8c1; }

/* Password input wrapper */
.pass-wrap { position: relative; }

.pass-wrap .pp-input { padding-right: 42px; }

.pass-toggle {
    position: absolute;
    right: 12px; top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #9ca3af;
    cursor: pointer;
    font-size: 15px;
    padding: 2px;
    transition: .2s;
}

.pass-toggle:hover { color: var(--g1); }

/* Password strength */
.pass-strength {
    margin-top: 6px;
    display: none;
}

.strength-bar {
    height: 4px;
    border-radius: 99px;
    background: #f3f4f6;
    overflow: hidden;
    margin-bottom: 4px;
}

.strength-fill {
    height: 100%;
    border-radius: 99px;
    transition: width .3s, background .3s;
    width: 0%;
}

.strength-label { font-size: 11px; color: #9ca3af; }

/* Alert */
.pp-alert {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 11px 14px;
    border-radius: 11px;
    font-size: 13px;
    font-weight: 500;
    margin-bottom: 14px;
}

.pp-alert-success { background: #f0fdf4; border: 1px solid #bbf7d0; color: #15803d; }
.pp-alert-error   { background: #fef2f2; border: 1px solid #fecaca; color: #dc2626; }

/* Buttons */
.btn-save {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 10px 22px;
    border-radius: 11px;
    border: none;
    background: linear-gradient(135deg, var(--g1), var(--g2));
    color: white;
    font-size: 13.5px;
    font-weight: 700;
    cursor: pointer;
    transition: .25s;
    font-family: 'Plus Jakarta Sans', sans-serif;
    box-shadow: 0 4px 14px rgba(10,127,46,.25);
}

.btn-save:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(10,127,46,.32); }

.btn-logout {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 10px 20px;
    border-radius: 11px;
    border: 1.5px solid #fecaca;
    background: #fff5f5;
    color: #dc2626;
    font-size: 13.5px;
    font-weight: 700;
    cursor: pointer;
    transition: .2s;
    font-family: 'Plus Jakarta Sans', sans-serif;
}

.btn-logout:hover { background: #ef4444; border-color: #ef4444; color: white; transform: translateY(-1px); }

.logout-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 14px;
    flex-wrap: wrap;
}

.logout-info h6 { font-size: 13.5px; font-weight: 700; color: var(--text); margin: 0 0 2px; }
.logout-info small { font-size: 11.5px; color: var(--soft); }

/* =============================================
   RESPONSIVE
============================================= */
@media (max-width: 1024px) and (min-width: 769px) {
    .pp-grid { grid-template-columns: 240px 1fr; }
}

@media (max-width: 768px) {
    .pp-avatar-section { padding: 18px; gap: 14px; border-radius: 14px; }
    .pp-avatar { width: 64px; height: 64px; border-radius: 18px; font-size: 26px; }
    .pp-avatar-name { font-size: 17px; }
    .pp-grid { grid-template-columns: 1fr; }
    .pp-card-body { padding: 14px 16px; }
    .pp-card-head { padding: 13px 16px; }
    .info-row { padding: 11px 16px; }
    .btn-save, .btn-logout { width: 100%; justify-content: center; }
    .logout-row { flex-direction: column; align-items: flex-start; }
}

</style>

<div class="pp">

    {{-- HEADER FIX --}}
    <div class="pp-header">
        <div class="pp-header-icon"><i class="bi bi-person-circle"></i></div>
        <div>
            <p class="pp-header-title">Profil Saya</p>
            <p class="pp-header-sub">Kelola informasi akun dan keamanan</p>
        </div>
    </div>

    {{-- SCROLL --}}
    <div class="pp-scroll">

        {{-- AVATAR SECTION --}}
        <div class="pp-avatar-section">
            <div class="pp-avatar-wrap">
                <div class="pp-avatar">
                    @if(auth()->user()->foto)
                        <img src="{{ asset('storage/' . auth()->user()->foto) }}" alt="Foto">
                    @else
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    @endif
                </div>
                <div class="pp-avatar-badge"><i class="bi bi-person-fill"></i></div>
            </div>
            <div class="pp-avatar-info">
                <p class="pp-avatar-name">{{ auth()->user()->name }}</p>
                <p class="pp-avatar-email">{{ auth()->user()->email }}</p>
                <span class="badge-active">Aktif</span>
            </div>
        </div>

        {{-- GRID --}}
        <div class="pp-grid">

            {{-- KIRI: INFO AKUN --}}
            <div>
                <div class="pp-card">
                    <div class="pp-card-head">
                        <div class="pp-card-head-left">
                            <h5>Informasi Akun</h5>
                            <small>Data profil kamu</small>
                        </div>
                        <div class="pp-card-icon ic-green"><i class="bi bi-person-lines-fill"></i></div>
                    </div>
                    <div class="info-rows">
                        <div class="info-row">
                            <div class="info-row-icon ir-green"><i class="bi bi-person"></i></div>
                            <div>
                                <div class="info-row-label">Nama Lengkap</div>
                                <div class="info-row-val">{{ auth()->user()->name }}</div>
                            </div>
                        </div>
                        <div class="info-row">
                            <div class="info-row-icon ir-blue"><i class="bi bi-envelope"></i></div>
                            <div>
                                <div class="info-row-label">Email</div>
                                <div class="info-row-val">{{ auth()->user()->email }}</div>
                            </div>
                        </div>
                        <div class="info-row">
                            <div class="info-row-icon ir-amber"><i class="bi bi-shield-check"></i></div>
                            <div>
                                <div class="info-row-label">Role</div>
                                <div class="info-row-val">Siswa</div>
                            </div>
                        </div>
                        <div class="info-row">
                            <div class="info-row-icon ir-rose"><i class="bi bi-calendar3"></i></div>
                            <div>
                                <div class="info-row-label">Bergabung</div>
                                <div class="info-row-val">{{ auth()->user()->created_at?->format('d M Y') ?? '-' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- KANAN --}}
            <div>

                {{-- UPLOAD FOTO --}}
                <div class="pp-card">
                    <div class="pp-card-head">
                        <div class="pp-card-head-left">
                            <h5>Update Foto Profil</h5>
                            <small>Upload foto terbaru kamu</small>
                        </div>
                        <div class="pp-card-icon ic-green"><i class="bi bi-camera"></i></div>
                    </div>
                    <div class="pp-card-body">
                        @if(session('success') && session('success_type') === 'foto')
                            <div class="pp-alert pp-alert-success">
                                <i class="bi bi-check-circle-fill"></i>
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="/upload-foto" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="file-zone" id="fileZone">
                                <input type="file" name="foto" accept="image/*" onchange="onFotoChange(this)">
                                <div class="fz-icon"><i class="bi bi-cloud-arrow-up"></i></div>
                                <p class="fz-title">Klik atau seret foto ke sini</p>
                                <p class="fz-sub">JPG, PNG &nbsp;·&nbsp; Maks 2MB</p>
                                <p class="fz-name" id="fzName"></p>
                            </div>
                            <button type="submit" class="btn-save">
                                <i class="bi bi-upload"></i> Simpan Foto
                            </button>
                        </form>
                    </div>
                </div>

                {{-- GANTI PASSWORD --}}
                <div class="pp-card">
                    <div class="pp-card-head">
                        <div class="pp-card-head-left">
                            <h5>Ganti Password</h5>
                            <small>Perbarui kata sandi akun kamu</small>
                        </div>
                        <div class="pp-card-icon ic-purple"><i class="bi bi-lock"></i></div>
                    </div>
                    <div class="pp-card-body">

                        @if(session('success') && session('success_type') === 'password')
                            <div class="pp-alert pp-alert-success">
                                <i class="bi bi-check-circle-fill"></i>
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="pp-alert pp-alert-error">
                                <i class="bi bi-exclamation-circle-fill"></i>
                                {{ session('error') }}
                            </div>
                        @endif

                        @if($errors->has('password_lama') || $errors->has('password') || $errors->has('password_confirmation'))
                            <div class="pp-alert pp-alert-error">
                                <i class="bi bi-exclamation-circle-fill"></i>
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <form action="/profil/ganti-password" method="POST">
                            @csrf

                            <div class="form-group">
                                <label class="form-label-pp">
                                    Password Lama <span class="req">*</span>
                                </label>
                                <div class="pass-wrap">
                                    <input type="password" name="password_lama" class="pp-input"
                                           placeholder="Masukkan password saat ini" id="passLama">
                                    <button type="button" class="pass-toggle" onclick="togglePass('passLama', this)">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label-pp">
                                    Password Baru <span class="req">*</span>
                                </label>
                                <div class="pass-wrap">
                                    <input type="password" name="password" class="pp-input"
                                           placeholder="Min. 8 karakter" id="passBaru"
                                           oninput="checkStrength(this.value)">
                                    <button type="button" class="pass-toggle" onclick="togglePass('passBaru', this)">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                                <div class="pass-strength" id="passStrength">
                                    <div class="strength-bar">
                                        <div class="strength-fill" id="strengthFill"></div>
                                    </div>
                                    <span class="strength-label" id="strengthLabel"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label-pp">
                                    Konfirmasi Password Baru <span class="req">*</span>
                                </label>
                                <div class="pass-wrap">
                                    <input type="password" name="password_confirmation" class="pp-input"
                                           placeholder="Ulangi password baru" id="passConfirm">
                                    <button type="button" class="pass-toggle" onclick="togglePass('passConfirm', this)">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <button type="submit" class="btn-save">
                                <i class="bi bi-shield-lock"></i> Simpan Password
                            </button>

                        </form>
                    </div>
                </div>

                {{-- LOGOUT --}}
                <div class="pp-card">
                    <div class="pp-card-body">
                        <div class="logout-row">
                            <div class="logout-info">
                                <h6>Keluar dari Akun</h6>
                                <small>Pastikan semua aktivitas sudah selesai sebelum logout</small>
                            </div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn-logout">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>

<script>
function onFotoChange(input) {
    if (input.files && input.files[0]) {
        const name = input.files[0].name;
        const size = (input.files[0].size / 1024 / 1024).toFixed(2);
        document.getElementById('fileZone').classList.add('has-file');
        const label = document.getElementById('fzName');
        label.style.display = 'block';
        label.innerHTML = `<i class="bi bi-file-earmark-image me-1"></i>${name} (${size} MB)`;
    }
}

function togglePass(id, btn) {
    const input = document.getElementById(id);
    const icon  = btn.querySelector('i');
    if (input.type === 'password') {
        input.type = 'text';
        icon.className = 'bi bi-eye-slash';
    } else {
        input.type = 'password';
        icon.className = 'bi bi-eye';
    }
}

function checkStrength(val) {
    const bar    = document.getElementById('strengthFill');
    const label  = document.getElementById('strengthLabel');
    const wrap   = document.getElementById('passStrength');

    if (!val) { wrap.style.display = 'none'; return; }
    wrap.style.display = 'block';

    let score = 0;
    if (val.length >= 8)              score++;
    if (/[A-Z]/.test(val))           score++;
    if (/[0-9]/.test(val))           score++;
    if (/[^A-Za-z0-9]/.test(val))    score++;

    const levels = [
        { pct: '25%', color: '#ef4444', text: 'Lemah' },
        { pct: '50%', color: '#f59e0b', text: 'Cukup' },
        { pct: '75%', color: '#3b82f6', text: 'Baik' },
        { pct: '100%',color: '#16a34a', text: 'Kuat' },
    ];

    const lv = levels[score - 1] || levels[0];
    bar.style.width      = lv.pct;
    bar.style.background = lv.color;
    label.style.color    = lv.color;
    label.textContent    = lv.text;
}
</script>

@endsection