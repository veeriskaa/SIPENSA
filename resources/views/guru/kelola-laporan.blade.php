@extends('layouts.guru')

@section('title','Kelola Laporan')

@section('content')

<div class="laporan-page">

    <!-- TOPBAR -->
    <div class="topbar">

        <div>
            <h3 class="fw-bold mb-1">Kelola Laporan</h3>

            <small class="text-muted">
                Kelola seluruh laporan siswa secara realtime
            </small>
        </div>

        <div class="topbar-right">

            <!-- DATE -->
            <div class="date-box">
                <i class="bi bi-calendar3"></i>

                {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
            </div>

            <!-- NOTIF -->
            <div class="notif-box position-relative">

                <i class="bi bi-bell"></i>

                <span class="notif-badge">
                    {{ \App\Models\Pengaduan::where('status','pending')->count() }}
                </span>

            </div>

            <!-- PROFILE -->
            <img src="{{ auth()->user()->foto
                ? asset('storage/' . auth()->user()->foto)
                : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}"
                class="top-profile">

        </div>

    </div>

    <!-- FILTER -->
    <form method="GET" action="{{ route('guru.laporan') }}">

        <div class="filter-card">

            <div class="row g-3">

                <!-- KATEGORI -->
                <div class="col-md-4">

                    <select name="kategori"
                            class="form-select modern-select">

                        <option value="">Semua Kategori</option>

                        <option value="Bullying"
                            {{ request('kategori') == 'Bullying' ? 'selected' : '' }}>
                            Bullying
                        </option>

                        <option value="Fasilitas"
                            {{ request('kategori') == 'Fasilitas' ? 'selected' : '' }}>
                            Fasilitas
                        </option>

                        <option value="Akademik"
                            {{ request('kategori') == 'Akademik' ? 'selected' : '' }}>
                            Akademik
                        </option>

                    </select>

                </div>

                <!-- STATUS -->
                <div class="col-md-4">

                    <select name="status"
                            class="form-select modern-select">

                        <option value="">Semua Status</option>

                        <option value="pending"
                            {{ request('status') == 'pending' ? 'selected' : '' }}>
                            Pending
                        </option>

                        <option value="proses"
                            {{ request('status') == 'proses' ? 'selected' : '' }}>
                            Proses
                        </option>

                        <option value="selesai"
                            {{ request('status') == 'selesai' ? 'selected' : '' }}>
                            Selesai
                        </option>

                    </select>

                </div>

                <!-- SEARCH -->
                <div class="col-md-4">

                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           class="form-control modern-input"
                           placeholder="Cari laporan...">

                </div>

            </div>

            <!-- BUTTON -->
            <div class="mt-3 d-flex gap-2">

                <button class="btn btn-success">
                    <i class="bi bi-search"></i>
                    Filter
                </button>

                <a href="{{ route('guru.laporan') }}"
                   class="btn btn-light border">

                    Reset

                </a>

            </div>

        </div>

    </form>

    <!-- SCROLL AREA -->
    <div class="laporan-scroll">

        <!-- LIST LAPORAN -->
        <div class="laporan-wrapper">

            @forelse($laporan as $item)

            <div class="laporan-card">

                <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">

                    <!-- LEFT -->
                    <div class="laporan-content">

                        <div class="d-flex align-items-center gap-2 mb-2 flex-wrap">

                            <h5 class="fw-bold mb-0">
                                {{ $item->judul }}
                            </h5>

                            <!-- BADGE -->
                            @if($item->kategori == 'Bullying')

                                <span class="badge bg-danger-subtle text-danger">
                                    {{ $item->kategori }}
                                </span>

                            @elseif($item->kategori == 'Fasilitas')

                                <span class="badge bg-primary-subtle text-primary">
                                    {{ $item->kategori }}
                                </span>

                            @else

                                <span class="badge bg-success-subtle text-success">
                                    {{ $item->kategori }}
                                </span>

                            @endif

                        </div>

                        <!-- META -->
                        <div class="laporan-meta">

                            <span>
                                <i class="bi bi-person"></i>
                                {{ $item->user->name ?? 'Siswa' }}
                            </span>

                            <span>
                                <i class="bi bi-calendar"></i>
                                {{ $item->created_at->format('d M Y') }}
                            </span>

                        </div>

                        <!-- DESC -->
                        <p class="laporan-desc">

                            {{ \Illuminate\Support\Str::limit($item->deskripsi, 150) }}

                        </p>

                    </div>

                    <!-- STATUS -->
                    <div>

                        @if($item->status == 'selesai')

                            <span class="status-badge status-success">
                                <i class="bi bi-check-circle"></i>
                                Selesai
                            </span>

                        @elseif($item->status == 'proses')

                            <span class="status-badge status-warning">
                                <i class="bi bi-clock-history"></i>
                                Dalam Proses
                            </span>

                        @else

                            <span class="status-badge status-danger">
                                <i class="bi bi-exclamation-circle"></i>
                                Pending
                            </span>

                        @endif

                    </div>

                </div>

                <!-- FOOTER -->
                <div class="laporan-footer">

                    <div class="laporan-info">

                        <span>
                            <i class="bi bi-building"></i>

                            {{ $item->lokasi ?? 'SMKN 2 Marabahan' }}
                        </span>

                    </div>

                    <div class="laporan-action">

                        <a href="{{ route('pengaduan.show', $item->id) }}"
                            class="btn btn-outline-success">

                            <i class="bi bi-eye"></i>
                            Detail

                        </a>

                        <a href="{{ route('guru.respon', $item->id) }}"
                            class="btn btn-success">

                            <i class="bi bi-reply"></i>
                            Tanggapi

                        </a>

                    </div>

                </div>

            </div>

            @empty

            <div class="empty-state">

                <i class="bi bi-inbox"></i>

                <h5 class="mt-3">
                    Belum Ada Laporan
                </h5>

                <small class="text-muted">
                    Laporan siswa akan muncul di sini
                </small>

            </div>

            @endforelse

        </div>

    </div>

</div>

<style>

/* =========================================================
   ROOT
========================================================= */

:root{
    --bg:#f6f8fb;
    --surface:#ffffff;
    --border:#e8edf3;

    --text-1:#1f2937;
    --text-2:#4b5563;
    --text-3:#9ca3af;

    --green:#2f6f57;
    --green-soft:#edf5f1;

    --red:#c65b5b;
    --red-soft:#fdf1f1;

    --orange:#c79b46;
    --orange-soft:#fbf6eb;

    --blue:#5d7fa3;
    --blue-soft:#eff4f8;

    --shadow:
    0 1px 2px rgba(15,23,42,.02),
    0 8px 18px rgba(15,23,42,.03);
}

/* =========================================================
   GLOBAL FIX
========================================================= */

html,
body{
    height:100%;
    overflow:hidden;
    background:var(--bg);
}

.content{
    height:calc(100vh - 70px);
    overflow:hidden;
}

/* =========================================================
   PAGE
========================================================= */

.laporan-page{
    height:100%;
    display:flex;
    flex-direction:column;
    gap:16px;
    overflow:hidden;
}

/* =========================================================
   TOPBAR
========================================================= */

.topbar{
    background:#fff;
    border:1px solid var(--border);
    border-radius:12px;
    padding:18px 22px;

    display:flex;
    justify-content:space-between;
    align-items:center;

    box-shadow:var(--shadow);

    flex-shrink:0;
}

/* TITLE */

.topbar h3{
    font-size:22px;
    font-weight:600;
    margin-bottom:2px;
}

.topbar small{
    color:var(--text-3);
    font-size:12px;
}

.topbar-right{
    display:flex;
    align-items:center;
    gap:10px;
}

/* DATE */

.date-box{
    height:38px;
    padding:0 14px;

    border:1px solid var(--border);
    border-radius:10px;

    background:#fafbfc;

    display:flex;
    align-items:center;
    gap:8px;

    font-size:12px;
    color:var(--text-2);
}

/* NOTIF */

.notif-box{
    width:38px;
    height:38px;

    border:1px solid var(--border);
    border-radius:10px;

    display:flex;
    align-items:center;
    justify-content:center;

    background:#fff;

    position:relative;

    font-size:16px;
    color:var(--text-2);
}

.notif-badge{
    position:absolute;
    top:-4px;
    right:-4px;

    width:16px;
    height:16px;

    border-radius:50%;

    background:#dc3545;
    color:white;

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:9px;
}

/* PROFILE */

.top-profile{
    width:38px;
    height:38px;
    border-radius:50%;
    object-fit:cover;
}

/* =========================================================
   FILTER
========================================================= */

.filter-card{
    background:#fff;
    border:1px solid var(--border);
    border-radius:12px;

    padding:18px;

    box-shadow:var(--shadow);

    flex-shrink:0;
}

/* INPUT */

.modern-select,
.modern-input{
    height:42px;

    border:1px solid var(--border);
    border-radius:10px;

    font-size:13px;

    box-shadow:none !important;
}

.modern-select:focus,
.modern-input:focus{
    border-color:#bfd7ca;
}

/* =========================================================
   SCROLL AREA
========================================================= */

.laporan-scroll{
    flex:1;

    overflow-y:auto;
    overflow-x:hidden;

    padding-right:4px;
    padding-bottom:20px;

    scrollbar-width:thin;
}

.laporan-scroll::-webkit-scrollbar{
    width:7px;
}

.laporan-scroll::-webkit-scrollbar-thumb{
    background:#d1d5db;
    border-radius:20px;
}

/* =========================================================
   WRAPPER
========================================================= */

.laporan-wrapper{
    display:flex;
    flex-direction:column;
    gap:14px;
}

/* =========================================================
   CARD
========================================================= */

.laporan-card{
    background:#fff;

    border:1px solid var(--border);
    border-radius:12px;

    padding:18px;

    transition:.2s;

    box-shadow:var(--shadow);
}

.laporan-card:hover{
    transform:translateY(-2px);
}

/* TITLE */

.laporan-card h5{
    font-size:17px;
    font-weight:600;
    margin:0;
}

/* BADGE */

.badge{
    font-size:10px !important;
    font-weight:500 !important;

    padding:5px 9px;

    border-radius:8px;
}

/* META */

.laporan-meta{
    display:flex;
    align-items:center;
    gap:14px;

    flex-wrap:wrap;

    margin-top:8px;

    font-size:12px;
    color:var(--text-3);
}

/* DESC */

.laporan-desc{
    margin-top:12px;
    margin-bottom:0;

    font-size:13px;
    line-height:1.6;

    color:var(--text-2);

    max-width:760px;
}

/* =========================================================
   STATUS
========================================================= */

.status-badge{
    padding:6px 11px;

    border-radius:8px;

    font-size:11px;
    font-weight:500;

    display:flex;
    align-items:center;
    gap:5px;
}

.status-warning{
    background:var(--orange-soft);
    color:var(--orange);
}

.status-success{
    background:var(--green-soft);
    color:var(--green);
}

.status-danger{
    background:var(--red-soft);
    color:var(--red);
}

/* =========================================================
   FOOTER
========================================================= */

.laporan-footer{
    margin-top:16px;
    padding-top:14px;

    border-top:1px solid #f1f3f5;

    display:flex;
    justify-content:space-between;
    align-items:center;

    flex-wrap:wrap;
    gap:12px;
}

/* INFO */

.laporan-info{
    font-size:12px;
    color:var(--text-3);
}

/* =========================================================
   BUTTON
========================================================= */

.laporan-action{
    display:flex;
    gap:8px;
}

.btn{
    border-radius:8px !important;

    padding:7px 13px;

    font-size:12px;
    font-weight:500;
}

/* =========================================================
   EMPTY
========================================================= */

.empty-state{
    background:#fff;

    border:1px solid var(--border);
    border-radius:12px;

    padding:50px 20px;

    text-align:center;

    box-shadow:var(--shadow);
}

.empty-state i{
    font-size:52px;
    color:#cbd5e1;
}

.empty-state h5{
    font-size:18px;
    font-weight:600;
}

/* =========================================================
   RESPONSIVE
========================================================= */

@media(max-width:768px){

    html,
    body{
        overflow:auto;
    }

    .content{
        height:auto;
        overflow:visible;
    }

    .laporan-page{
        height:auto;
    }

    .laporan-scroll{
        overflow:visible;
        padding-bottom:30px;
    }

    .topbar{
        flex-direction:column;
        align-items:flex-start;
        gap:14px;
    }

    .laporan-footer{
        flex-direction:column;
        align-items:flex-start;
    }

    .laporan-action{
        width:100%;
    }

    .laporan-action .btn{
        flex:1;
    }

}

</style>

@endsection