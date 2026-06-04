@extends('layouts.guru')

@section('title','Tambah User')

@section('content')

<div class="user-page">

    <!-- HEADER -->
    <div class="page-header">

        <div>

            <h3 class="page-title">
                Tambah User
            </h3>

            <p class="page-subtitle">
                Tambahkan akun siswa atau guru BK baru
            </p>

        </div>

        <div class="header-icon">
            <i class="bi bi-person-plus"></i>
        </div>

    </div>

    <!-- FORM -->
    <div class="form-card">

        @if(session('success'))

            <div class="alert alert-success custom-alert">

                <i class="bi bi-check-circle-fill"></i>

                {{ session('success') }}

            </div>

        @endif

        <form action="/kelola-user/store"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="row g-4">

                <!-- NAMA -->
                <div class="col-md-6">

                    <label class="form-label">
                        Nama Lengkap
                    </label>

                    <input type="text"
                           name="name"
                           class="form-control modern-input"
                           placeholder="Masukkan nama">

                </div>

                <!-- EMAIL -->
                <div class="col-md-6">

                    <label class="form-label">
                        Email
                    </label>

                    <input type="email"
                           name="email"
                           class="form-control modern-input"
                           placeholder="Masukkan email">

                </div>

                <!-- PASSWORD -->
                <div class="col-md-4">

                    <label class="form-label">
                        Password
                    </label>

                    <input type="password"
                           name="password"
                           class="form-control modern-input"
                           placeholder="Masukkan password">

                </div>

                <!-- ROLE -->
                <div class="col-md-4">

                    <label class="form-label">
                        Role
                    </label>

                    <select name="role"
                            class="form-select modern-input">

                        <option value="siswa">
                            Siswa
                        </option>

                        <option value="guru">
                            Guru BK
                        </option>

                    </select>

                </div>

                <!-- FOTO -->
                <div class="col-md-4">

                    <label class="form-label">
                        Foto Profil
                    </label>

                    <input type="file"
                           name="foto"
                           class="form-control modern-input">

                </div>

                <!-- BUTTON -->
                <div class="col-12 d-flex gap-3 flex-wrap">

                    <button class="btn-save">

                        <i class="bi bi-check-circle"></i>

                        Simpan User

                    </button>

                    <a href="/kelola-user"
                       class="btn-back">

                        <i class="bi bi-arrow-left"></i>

                        Kembali

                    </a>

                </div>

            </div>

        </form>

    </div>

</div>

<style>

body{
    background:#f4f6f9;
    overflow:hidden;
}

/* PAGE */
.user-page{
    padding:5px;
    height:100vh;
    display:flex;
    flex-direction:column;
    overflow:hidden;
}

/* HEADER */
.page-header{
    background:white;
    border-radius:20px;
    padding:18px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:24px;
    border:1px solid #eceff3;
    flex-shrink:0;
}

.page-title{
    font-size:24px;
    font-weight:600;
    margin-bottom:4px;
    color:#111827;
}

.page-subtitle{
    color:#6b7280;
    margin:0;
    font-size:13px;
}

/* ICON */
.header-icon{
    width:60px;
    height:40px;
    border-radius:18px;
    background:#ecfdf3;
    color:#16a34a;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:24px;
}

/* FORM CARD */
.form-card{
    background:white;
    border-radius:20px;
    padding:28px;
    border:1px solid #eceff3;

    flex:1;
    overflow-y:auto;
}

/* LABEL */
.form-label{
    font-size:14px;
    font-weight:600;
    margin-bottom:8px;
    color:#374151;
}

/* INPUT */
.modern-input{
    border-radius:14px;
    border:1px solid #e5e7eb;
    min-height:52px;
    padding:12px 16px;
    box-shadow:none !important;
}

.modern-input:focus{
    border-color:#16a34a;
}

/* BUTTON */
.btn-save{
    border:none;
    background:#16a34a;
    color:white;
    padding:12px 22px;
    border-radius:14px;
    font-weight:600;
    display:flex;
    align-items:center;
    gap:8px;
    transition:.3s;
}

.btn-save:hover{
    background:#15803d;
}

.btn-back{
    background:#eef2f7;
    color:#111827;
    padding:12px 22px;
    border-radius:14px;
    text-decoration:none;
    font-weight:600;
    display:flex;
    align-items:center;
    gap:8px;
    transition:.3s;
}

.btn-back:hover{
    background:#e5e7eb;
    color:#111827;
}

/* ALERT */
.custom-alert{
    border:none;
    border-radius:14px;
    margin-bottom:20px;
    display:flex;
    align-items:center;
    gap:10px;
}

/* SCROLLBAR */
.form-card::-webkit-scrollbar{
    width:8px;
}

.form-card::-webkit-scrollbar-thumb{
    background:#d1d5db;
    border-radius:20px;
}

/* RESPONSIVE */
@media(max-width:768px){

    body{
        overflow:auto;
    }

    .user-page{
        height:auto;
    }

    .page-header{
        flex-direction:column;
        align-items:flex-start;
        gap:16px;
    }

    .btn-save,
    .btn-back{
        width:100%;
        justify-content:center;
    }

}

</style>

@endsection