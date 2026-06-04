@extends('layouts.guru')

@section('title','Kelola Kategori')

@section('content')

<div class="kategori-page">

    <!-- HEADER -->
    <div class="kategori-header">

        <div>
            <h3 class="kategori-title">
                Kelola Kategori
            </h3>

            <p class="kategori-subtitle">
                Tambahkan dan kelola kategori laporan siswa
            </p>
        </div>

        <!-- BUTTON TAMBAH -->
        <button
            class="btn-tambah"
            data-bs-toggle="modal"
            data-bs-target="#modalTambah">

            <i class="bi bi-plus-circle"></i>
            Tambah Kategori

        </button>

    </div>

    <!-- ALERT -->
    @if(session('success'))

        <div class="alert alert-success custom-alert">

            <i class="bi bi-check-circle-fill"></i>

            {{ session('success') }}

        </div>

    @endif

    <!-- CONTENT -->
    <div class="kategori-content">

        @php
            $colors = [
                ['bg' => '#fee2e2', 'icon' => '#ef4444'],
                ['bg' => '#dcfce7', 'icon' => '#16a34a'],
                ['bg' => '#dbeafe', 'icon' => '#3b82f6'],
                ['bg' => '#fef3c7', 'icon' => '#f59e0b'],
                ['bg' => '#ede9fe', 'icon' => '#8b5cf6'],
            ];
        @endphp

        @forelse($kategori as $item)

            @php
                $color = $colors[$loop->index % count($colors)];
            @endphp

            <div class="kategori-card"
                 style="background: {{ $color['bg'] }};">

                <!-- TOP -->
                <div class="kategori-top">

                    <div class="kategori-icon"
                         style="color: {{ $color['icon'] }}">

                        <i class="bi bi-folder2-open"></i>

                    </div>

                    <div class="dropdown">

                        <button class="btn-action"
                                data-bs-toggle="dropdown">

                            <i class="bi bi-three-dots"></i>

                        </button>

                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-4">

                            <!-- EDIT -->
                            <li>

                                <button
                                    class="dropdown-item"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $item->id_kategori }}">

                                    <i class="bi bi-pencil-square me-2"></i>
                                    Edit

                                </button>

                            </li>

                            <!-- DELETE -->
                            <li>

                                <form
                                    action="{{ route('kategori.destroy',$item->id_kategori) }}"
                                    method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="dropdown-item text-danger">

                                        <i class="bi bi-trash me-2"></i>
                                        Hapus

                                    </button>

                                </form>

                            </li>

                        </ul>

                    </div>

                </div>

                <!-- BODY -->
                <div class="kategori-body">

                    <h5>
                        {{ $item->nama_kategori }}
                    </h5>

                    <p>
                        Kategori laporan siswa
                    </p>

                </div>

                <!-- FOOTER -->
                <div class="kategori-footer">

                    <span class="kategori-badge"
                          style="background: rgba(255,255,255,.7);
                                 color: {{ $color['icon'] }};">

                        Aktif

                    </span>

                    <small>
                        Data kategori
                    </small>

                </div>

            </div>

            <!-- MODAL EDIT -->
            <div class="modal fade"
                 id="editModal{{ $item->id_kategori }}"
                 tabindex="-1">

                <div class="modal-dialog modal-dialog-centered">

                    <div class="modal-content border-0 rounded-4">

                        <div class="modal-header border-0">

                            <h5 class="modal-title">
                                Edit Kategori
                            </h5>

                            <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"></button>

                        </div>

                        <form
                            action="{{ route('kategori.update',$item->id_kategori) }}"
                            method="POST">

                            @csrf
                            @method('PUT')

                            <div class="modal-body">

                                <div class="mb-3">

                                    <label class="form-label">
                                        Nama Kategori
                                    </label>

                                    <input type="text"
                                           name="nama_kategori"
                                           class="form-control modern-input"
                                           value="{{ $item->nama_kategori }}"
                                           required>

                                </div>

                            </div>

                            <div class="modal-footer border-0">

                                <button type="button"
                                        class="btn btn-light"
                                        data-bs-dismiss="modal">

                                    Batal

                                </button>

                                <button class="btn btn-success px-4">

                                    Update

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        @empty

            <!-- EMPTY -->
            <div class="empty-box">

                <div class="empty-icon">

                    <i class="bi bi-folder-x"></i>

                </div>

                <h4>
                    Belum Ada Kategori
                </h4>

                <p>
                    Tambahkan kategori baru untuk laporan siswa
                </p>

            </div>

        @endforelse

    </div>

</div>

<!-- MODAL TAMBAH -->
<div class="modal fade"
     id="modalTambah"
     tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 rounded-4">

            <div class="modal-header border-0">

                <h5 class="modal-title">
                    Tambah Kategori
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"></button>

            </div>

            <form
                action="{{ route('guru.kategori.store') }}"
                method="POST">

                @csrf

                <div class="modal-body">

                    <div class="mb-3">

                        <label class="form-label">
                            Nama Kategori
                        </label>

                        <input type="text"
                               name="nama_kategori"
                               class="form-control modern-input"
                               required>

                    </div>

                </div>

                <div class="modal-footer border-0">

                    <button type="button"
                            class="btn btn-light"
                            data-bs-dismiss="modal">

                        Batal

                    </button>

                    <button class="btn btn-success px-4">

                        Simpan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<style>

/* =========================================================
   BODY
========================================================= */

body{
    background:#f5f7fb;
    overflow:hidden;
}

/* =========================================================
   PAGE
========================================================= */

.kategori-page{
    height:calc(100vh - 95px);
    display:flex;
    flex-direction:column;
    gap:18px;
}

/* =========================================================
   HEADER
========================================================= */

.kategori-header{
    background:white;
    border-radius:18px;
    padding:18px 22px;

    display:flex;
    justify-content:space-between;
    align-items:center;

    border:1px solid #eceff3;

    flex-shrink:0;
}

.kategori-title{
    font-size:22px;
    font-weight:600;
    margin-bottom:4px;
    color:#111827;
}

.kategori-subtitle{
    margin:0;
    color:#6b7280;
    font-size:13px;
}

/* =========================================================
   BUTTON
========================================================= */

.btn-tambah{
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

.btn-tambah:hover{
    background:#15803d;
    color:white;

    transform:translateY(-2px);
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
   CONTENT
========================================================= */

.kategori-content{
    flex:1;

    overflow-y:auto;

    display:grid;

    grid-template-columns:
    repeat(auto-fill,minmax(220px,1fr));

    gap:14px;

    padding-right:4px;
}


/* =========================================================
   CARD
========================================================= */

.kategori-card{
    border-radius:18px;

    padding:14px;

    transition:.25s;

    height:fit-content;

    border:1px solid rgba(255,255,255,.6);
}

.kategori-card:hover{
    transform:translateY(-4px);

    box-shadow:
    0 12px 24px rgba(15,23,42,.08);
}

/* =========================================================
   TOP
========================================================= */

.kategori-top{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;

    margin-bottom:18px;
}

.kategori-icon{
    width:52px;
    height:52px;

    border-radius:16px;

    background:rgba(255,255,255,.65);

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:21px;
}

.btn-action{
    width:36px;
    height:36px;

    border:none;

    border-radius:12px;

    background:rgba(255,255,255,.7);

    color:#6b7280;

    transition:.2s;
}

.btn-action:hover{
    background:white;
}

/* =========================================================
   BODY
========================================================= */

.kategori-body h5{
    font-size:16px;
    margin-bottom:6px;
}

.kategori-body p{
    font-size:12px;

    min-height:36px;
}

/* =========================================================
   FOOTER
========================================================= */

.kategori-footer{
    margin-top:20px;

    display:flex;
    justify-content:space-between;
    align-items:center;
}

.kategori-badge{
    padding:7px 14px;
    border-radius:30px;

    font-size:11px;
    font-weight:700;
}

.kategori-footer small{
    color:#6b7280;
    font-size:12px;
}

/* =========================================================
   EMPTY
========================================================= */

.empty-box{
    grid-column:1/-1;

    background:white;

    border-radius:20px;

    border:1px dashed #d1d5db;

    padding:80px 20px;

    text-align:center;
}

.empty-icon{
    width:80px;
    height:80px;

    border-radius:22px;

    margin:auto auto 20px;

    background:#f3f4f6;

    color:#9ca3af;

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:34px;
}

.empty-box h4{
    font-size:24px;
    font-weight:700;

    color:#111827;

    margin-bottom:10px;
}

.empty-box p{
    color:#6b7280;
    font-size:14px;
    margin:0;
}

/* =========================================================
   INPUT
========================================================= */

.modern-input{
    border-radius:14px;
    border:1px solid #e5e7eb;

    min-height:48px;

    padding:10px 14px;

    font-size:14px;

    box-shadow:none !important;
}

.modern-input:focus{
    border-color:#16a34a;

    box-shadow:
    0 0 0 4px rgba(22,163,74,.08) !important;
}

/* =========================================================
   SCROLLBAR
========================================================= */

.kategori-content::-webkit-scrollbar{
    width:8px;
}

.kategori-content::-webkit-scrollbar-thumb{
    background:#d1d5db;
    border-radius:20px;
}

/* =========================================================
   MOBILE
========================================================= */

@media(max-width:768px){

    body{
        overflow:auto;
    }

    .kategori-page{
        height:auto;
    }

    .kategori-header{
        flex-direction:column;
        align-items:flex-start;
        gap:14px;
    }

    .btn-tambah{
        width:100%;
        justify-content:center;
    }

    .kategori-content{
        grid-template-columns:1fr;
        overflow:visible;
    }

}

</style>

@endsection