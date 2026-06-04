@extends('layouts.guru')

@section('title','Kelola User')

@section('content')

<div class="user-page">

    <!-- HEADER -->
    <div class="page-header">

        <div>
            <h3 class="page-title">
                Kelola Akun Siswa & Guru
            </h3>

            <p class="page-subtitle">
                Manajemen data pengguna sistem eLapor
            </p>
        </div>

        <a href="/tambah-user" class="btn-add">
            <i class="bi bi-plus-circle"></i>
            Tambah User
        </a>

    </div>

    <!-- ALERT -->
    @if(session('success'))

        <div class="alert alert-success custom-alert">

            <i class="bi bi-check-circle-fill"></i>

            {{ session('success') }}

        </div>

    @endif

    <!-- FILTER -->
    <div class="filter-card">

        <div class="row g-3">

            <div class="col-md-6">

                <input type="text"
                       id="searchInput"
                       class="form-control modern-input"
                       placeholder="Cari nama atau email...">

            </div>

            <div class="col-md-3">

                <select id="roleFilter"
                        class="form-select modern-input">

                    <option value="">
                        Semua Role
                    </option>

                    <option value="siswa">
                        Siswa
                    </option>

                    <option value="guru">
                        Guru BK
                    </option>

                </select>

            </div>

            <div class="col-md-3">

                <button class="btn-filter">

                    <i class="bi bi-funnel"></i>

                    Filter User

                </button>

            </div>

        </div>

    </div>

    <!-- TABLE -->
    <div class="table-card">

        <div class="table-scroll">

            <div class="table-responsive">

                <table class="table custom-table align-middle">

                    <thead>

                        <tr>
                            <th>Pengguna</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>

                    </thead>

                    <tbody id="userTable">

                    @foreach($users as $user)

                        <tr>

                            <!-- USER -->
                            <td>

                                <div class="user-info">

                                    <div class="user-avatar">

                                        @if($user->foto)

                                            <img src="{{ asset('storage/'.$user->foto) }}"
                                                 style="width:46px;height:46px;border-radius:50%;object-fit:cover;">

                                        @else

                                            {{ strtoupper(substr($user->name,0,1)) }}

                                        @endif

                                    </div>

                                    <div>

                                        <div class="user-name">
                                            {{ $user->name }}
                                        </div>

                                        <small class="text-muted">
                                            ID #{{ $user->id }}
                                        </small>

                                    </div>

                                </div>

                            </td>

                            <!-- EMAIL -->
                            <td>
                                {{ $user->email }}
                            </td>

                            <!-- ROLE -->
                            <td>

                                <span class="role-badge {{ $user->role == 'guru' ? 'guru' : 'siswa' }}">

                                    {{ ucfirst($user->role) }}

                                </span>

                            </td>

                            <!-- STATUS -->
                            <td>

                                <span class="status-badge aktif">
                                    Aktif
                                </span>

                            </td>

                            <!-- AKSI -->
                            <td>

                                <div class="action-group">

                                    <!-- EDIT -->
                                    <button class="btn-action edit">

                                        <i class="bi bi-pencil-square"></i>

                                    </button>

                                    <!-- DELETE -->
                                    <form action="/kelola-user/delete/{{ $user->id }}"
                                          method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button class="btn-action delete">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<style>

/* =========================================================
   BODY
========================================================= */

body{
    background:#f4f6f9;
    overflow:hidden;
}

/* =========================================================
   PAGE
========================================================= */

.user-page{
    height:calc(100vh - 95px);
    display:flex;
    flex-direction:column;
    gap:18px;
}

/* =========================================================
   HEADER
========================================================= */

.page-header{
    background:white;
    border-radius:18px;
    padding:18px 22px;

    display:flex;
    justify-content:space-between;
    align-items:center;

    border:1px solid #eceff3;

    flex-shrink:0;
}

.page-title{
    font-size:22px;
    font-weight:600;
    margin-bottom:4px;
    color:#111827;
}

.page-subtitle{
    margin:0;
    color:#6b7280;
    font-size:13px;
}

/* =========================================================
   BUTTON
========================================================= */

.btn-add{
    border:none;
    background:#16a34a;
    color:white;

    padding:11px 18px;

    border-radius:12px;

    font-size:14px;
    font-weight:500;

    display:flex;
    align-items:center;
    gap:8px;

    text-decoration:none;

    transition:.3s;
}

.btn-add:hover{
    background:#15803d;
    color:white;
}

/* =========================================================
   CARD
========================================================= */

.filter-card,
.table-card{
    background:white;
    border-radius:18px;
    border:1px solid #eceff3;
}

.filter-card{
    padding:18px;
    flex-shrink:0;
}

.table-card{
    flex:1;
    overflow:hidden;
    padding:0;
}

/* =========================================================
   TABLE SCROLL
========================================================= */

.table-scroll{
    height:100%;
    overflow-y:auto;
    overflow-x:auto;
    padding:18px;
}

/* =========================================================
   INPUT
========================================================= */

.modern-input{
    border-radius:12px;
    border:1px solid #e5e7eb;

    min-height:46px;

    padding:10px 14px;

    font-size:14px;

    box-shadow:none !important;
}

/* =========================================================
   BUTTON FILTER
========================================================= */

.btn-filter{
    width:100%;
    height:46px;

    border:none;
    border-radius:12px;

    background:#111827;
    color:white;

    font-size:14px;
    font-weight:500;

    display:flex;
    justify-content:center;
    align-items:center;
    gap:8px;
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

    margin-bottom:0;

    flex-shrink:0;
}

/* =========================================================
   TABLE
========================================================= */

.custom-table{
    margin:0;
}

.custom-table thead th{
    position:sticky;
    top:0;
    background:white;
    z-index:5;

    border:none;

    font-size:13px;
    color:#6b7280;
    font-weight:600;

    padding:14px 10px;

    box-shadow:0 1px 0 #f1f3f5;
}

.custom-table tbody td{
    padding:14px 10px;
    border-top:1px solid #f1f3f5;
    vertical-align:middle;

    font-size:14px;
}

/* =========================================================
   USER
========================================================= */

.user-info{
    display:flex;
    align-items:center;
    gap:12px;
}

.user-avatar{
    width:44px;
    height:44px;

    border-radius:50%;

    background:#dcfce7;
    color:#15803d;

    display:flex;
    align-items:center;
    justify-content:center;

    font-weight:700;

    overflow:hidden;

    flex-shrink:0;
}

.user-name{
    font-weight:600;
    color:#111827;
    font-size:14px;
}

/* =========================================================
   ROLE
========================================================= */

.role-badge{
    padding:6px 12px;
    border-radius:30px;

    font-size:11px;
    font-weight:600;
}

.role-badge.siswa{
    background:#dbeafe;
    color:#1d4ed8;
}

.role-badge.guru{
    background:#fef3c7;
    color:#b45309;
}

/* =========================================================
   STATUS
========================================================= */

.status-badge{
    padding:6px 12px;
    border-radius:30px;

    font-size:11px;
    font-weight:600;
}

.status-badge.aktif{
    background:#dcfce7;
    color:#15803d;
}

/* =========================================================
   ACTION
========================================================= */

.action-group{
    display:flex;
    justify-content:center;
    gap:8px;
}

.btn-action{
    width:36px;
    height:36px;

    border:none;
    border-radius:10px;

    display:flex;
    align-items:center;
    justify-content:center;

    transition:.3s;
}

.btn-action.edit{
    background:#eef2ff;
    color:#4f46e5;
}

.btn-action.delete{
    background:#fef2f2;
    color:#dc2626;
}

.btn-action:hover{
    transform:translateY(-2px);
}

/* =========================================================
   SCROLLBAR
========================================================= */

.table-scroll::-webkit-scrollbar{
    width:8px;
    height:8px;
}

.table-scroll::-webkit-scrollbar-thumb{
    background:#d1d5db;
    border-radius:20px;
}

/* =========================================================
   RESPONSIVE
========================================================= */

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
        gap:14px;
    }

    .btn-add{
        width:100%;
        justify-content:center;
    }

    .custom-table{
        min-width:700px;
    }

    .table-card{
        overflow:auto;
    }

}

</style>

@endsection