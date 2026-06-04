@extends('layouts.guru')

@section('title','Profil Saya')

@section('content')

<div class="profile-container">

    <!-- HEADER -->
    <div class="profile-header">

        <div>
            <h3 class="header-title">
                Profil Saya
            </h3>

            <p class="header-subtitle">
                Kelola informasi akun dan foto profil Anda
            </p>
        </div>

        <div class="header-icon">
            <i class="bi bi-person-circle"></i>
        </div>

    </div>

    <div class="row g-4">

        <!-- PROFILE CARD -->
        <div class="col-lg-4">

            <div class="profile-card">

                <!-- FOTO -->
                <div class="text-center">

                    <div class="profile-image-wrapper">

                        <img
                            src="{{ auth()->user()->foto
                                ? asset('storage/' . auth()->user()->foto)
                                : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->nama) }}"
                            class="profile-img">

                    </div>

                    <h4 class="profile-name">
                        {{ auth()->user()->nama }}
                    </h4>

                    <p class="profile-email">
                        {{ auth()->user()->email }}
                    </p>

                </div>

                <!-- INFO -->
                <div class="profile-info">

                    <div class="info-item">
                        <span class="info-label">
                            Role
                        </span>

                        <span class="info-value">
                            Guru BK
                        </span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">
                            Status
                        </span>

                        <span class="status-active">
                            Aktif
                        </span>
                    </div>

                </div>

            </div>

        </div>

        <!-- FORM -->
        <div class="col-lg-8">

            <div class="form-card">

                <div class="form-header">

                    <div>
                        <h5>
                            Update Foto Profil
                        </h5>

                        <small>
                            Upload foto profil terbaru Anda
                        </small>
                    </div>

                    <div class="form-icon">
                        <i class="bi bi-camera"></i>
                    </div>

                </div>

                <!-- ALERT -->
                @if(session('success'))

                    <div class="alert alert-success custom-alert">

                        <i class="bi bi-check-circle-fill"></i>

                        {{ session('success') }}

                    </div>

                @endif

                <!-- FORM -->
                <form action="/upload-foto"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf

                    <div class="mb-4">

                        <label class="form-label">
                            Pilih Foto
                        </label>

                        <input type="file"
                               name="foto"
                               class="form-control modern-input">

                        <small class="text-muted">
                            Format JPG atau PNG
                        </small>

                    </div>

                    <button class="btn-save">

                        <i class="bi bi-upload"></i>

                        Upload Foto

                    </button>

                </form>

            </div>

            <!-- LOGOUT -->
            <div class="logout-card">

                <div>

                    <h6 class="mb-1">
                        Keluar dari Akun
                    </h6>

                    <small>
                        Pastikan semua aktivitas sudah selesai sebelum logout
                    </small>

                </div>

                <form method="POST"
                      action="{{ route('logout') }}">

                    @csrf

                    <button class="btn-logout">

                        <i class="bi bi-box-arrow-right"></i>

                        Logout

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

<style>

/* =========================================================
   FIX LAYOUT
========================================================= */

html,
body{
    height:100%;
    margin:0;
    overflow:hidden;
    background:#f4f6f9;
}

.main-content,
.content,
.content-wrapper,
.dashboard-container{
    height:100vh;
    overflow-y:auto;
    overflow-x:hidden;
}

/* =========================================================
   CONTAINER
========================================================= */

.profile-container{
    padding:0 5px 5px 5px;
}

/* =========================================================
   HEADER FIX
========================================================= */

/* HEADER FIX */
.profile-header{
    background:white;
    border-radius:18px;
    padding:20px 24px;

    display:flex;
    justify-content:space-between;
    align-items:center;

    margin-bottom:20px;

    border:1px solid #eceff3;

    position:sticky;
    top:-10px;

    z-index:1000;

    backdrop-filter:blur(10px);

    box-shadow:
    0 4px 20px rgba(0,0,0,0.04);
}

.header-title{
    font-size:24px;
    font-weight:600;
    color:#111827;
    margin-bottom:4px;
}

.header-subtitle{
    color:#6b7280;
    font-size:13px;
    margin:0;
}

.header-icon{
    width:60px;
    height:60px;
    border-radius:18px;
    background:#ecfdf3;
    color:#16a34a;

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:24px;

    flex-shrink:0;
}

/* =========================================================
   CARD
========================================================= */

.profile-card,
.form-card,
.logout-card{
    background:white;
    border-radius:18px;
    border:1px solid #eceff3;
    padding:24px;

    box-shadow:
    0 2px 10px rgba(0,0,0,0.03);
}

/* =========================================================
   PROFILE
========================================================= */

.profile-image-wrapper{
    width:120px;
    height:120px;

    margin:auto;

    border-radius:50%;
    padding:5px;

    background:#ecfdf3;
}

.profile-img{
    width:100%;
    height:100%;
    border-radius:50%;
    object-fit:cover;
}

.profile-name{
    margin-top:18px;
    font-size:22px;
    font-weight:600;
    color:#111827;
}

.profile-email{
    color:#6b7280;
    font-size:14px;
    margin-bottom:0;
}

/* =========================================================
   INFO
========================================================= */

.profile-info{
    margin-top:28px;

    display:flex;
    flex-direction:column;
    gap:16px;
}

.info-item{
    display:flex;
    justify-content:space-between;
    align-items:center;

    padding:14px 16px;

    border-radius:14px;

    background:#f9fafb;
    border:1px solid #eef2f7;
}

.info-label{
    color:#6b7280;
    font-size:14px;
}

.info-value{
    font-weight:500;
    color:#111827;
}

.status-active{
    background:#dcfce7;
    color:#15803d;

    padding:6px 12px;

    border-radius:30px;

    font-size:12px;
    font-weight:600;
}

/* =========================================================
   FORM
========================================================= */

.form-header{
    display:flex;
    justify-content:space-between;
    align-items:center;

    margin-bottom:24px;
    padding-bottom:18px;

    border-bottom:1px solid #f1f3f5;
}

.form-header h5{
    margin-bottom:4px;
    font-weight:600;
}

.form-header small{
    color:#6b7280;
}

.form-icon{
    width:52px;
    height:52px;

    border-radius:16px;

    background:#ecfdf3;
    color:#16a34a;

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:20px;
}

.form-label{
    font-size:14px;
    font-weight:500;

    margin-bottom:10px;

    color:#374151;
}

.modern-input{
    border-radius:14px;
    border:1px solid #e5e7eb;

    padding:12px 16px;

    box-shadow:none !important;

    min-height:50px;
}

/* =========================================================
   ALERT
========================================================= */

.custom-alert{
    border:none;
    border-radius:14px;

    display:flex;
    align-items:center;
    gap:10px;
}

/* =========================================================
   BUTTON
========================================================= */

.btn-save{
    background:#16a34a;
    color:white;

    border:none;
    border-radius:14px;

    padding:12px 22px;

    font-size:14px;
    font-weight:500;

    display:flex;
    align-items:center;
    gap:8px;

    transition:.3s;
}

.btn-save:hover{
    background:#15803d;
}

.logout-card{
    margin-top:24px;

    display:flex;
    justify-content:space-between;
    align-items:center;

    gap:18px;
    flex-wrap:wrap;
}

.logout-card small{
    color:#6b7280;
}

.btn-logout{
    background:#ef4444;
    color:white;

    border:none;
    border-radius:14px;

    padding:12px 22px;

    font-size:14px;
    font-weight:500;

    display:flex;
    align-items:center;
    gap:8px;

    transition:.3s;
}

.btn-logout:hover{
    background:#dc2626;
}

/* =========================================================
   RESPONSIVE
========================================================= */

@media(max-width:768px){

    .profile-header{
        flex-direction:column;
        align-items:flex-start;
        gap:16px;
    }

    .logout-card{
        flex-direction:column;
        align-items:flex-start;
    }

}

</style>

@endsection