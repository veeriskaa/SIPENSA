@extends('layouts.guru')

@section('title','Tanggapi Laporan')

@section('content')

<div class="tanggapi-page">

    <!-- HEADER -->
    <div class="tanggapi-header">

        <div>
            <h3 class="header-title">
                Respon Laporan
            </h3>

            <p class="header-subtitle">
                Berikan tanggapan dan tindak lanjut laporan siswa
            </p>
        </div>

        <div class="header-right">

            <!-- DATE -->
            <div class="date-box">

                <i class="bi bi-calendar3"></i>

                {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}

            </div>

            <!-- NOTIF -->
            <div class="notif-box">

                <i class="bi bi-bell"></i>

                <span class="notif-badge">
                    {{ $notifCount ?? 0 }}
                </span>

            </div>

            <!-- PROFILE -->
            <img src="{{ auth()->user()->foto
                ? asset('storage/' . auth()->user()->foto)
                : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}"
                class="profile-img">

        </div>

    </div>

    <!-- SCROLL -->
    <div class="tanggapi-scroll">

        <div class="row g-4">

            <!-- DETAIL -->
            <div class="col-lg-4">

                <div class="detail-card">

                    <!-- BADGE -->
                    <div class="detail-top">

                        <span class="kategori-badge">
                            {{ $pengaduan->kategori }}
                        </span>

                        <span class="
                            status-badge
                            @if($pengaduan->status == 'pending') status-danger
                            @elseif($pengaduan->status == 'proses') status-warning
                            @else status-success
                            @endif
                        ">
                            {{ ucfirst($pengaduan->status) }}
                        </span>

                    </div>

                    <!-- TITLE -->
                    <h4 class="detail-title">
                        {{ $pengaduan->judul }}
                    </h4>

                    <!-- META -->
                    <div class="meta-list">

                        <div class="meta-item">

                            <div class="meta-icon">
                                <i class="bi bi-person-circle"></i>
                            </div>

                            <div>
                                <small>Pelapor</small>

                                <h6>
                                    {{ $pengaduan->user->name ?? '-' }}
                                </h6>
                            </div>

                        </div>

                        <div class="meta-item">

                            <div class="meta-icon">
                                <i class="bi bi-geo-alt"></i>
                            </div>

                            <div>
                                <small>Lokasi</small>

                                <h6>
                                    {{ $pengaduan->lokasi }}
                                </h6>
                            </div>

                        </div>

                        <div class="meta-item">

                            <div class="meta-icon">
                                <i class="bi bi-calendar-event"></i>
                            </div>

                            <div>
                                <small>Tanggal</small>

                                <h6>
                                    {{ \Carbon\Carbon::parse($pengaduan->created_at)->translatedFormat('d F Y') }}
                                </h6>
                            </div>

                        </div>

                    </div>

                    <!-- DESC -->
                    <div class="laporan-box">

                        <h6>
                            Deskripsi Laporan
                        </h6>

                        <p>
                            {{ $pengaduan->deskripsi }}
                        </p>

                    </div>

                    <!-- IMAGE -->
                    @if($pengaduan->bukti)

                    <div class="bukti-box">

                        <img src="{{ asset('storage/' . $pengaduan->bukti) }}"
                             class="img-fluid">

                    </div>

                    @endif

                </div>

            </div>

            <!-- FORM -->
            <div class="col-lg-8">

                <div class="respon-card">

                    <!-- TOP -->
                    <div class="respon-top">

                        <div>

                            <h4>
                                Tanggapi Laporan
                            </h4>

                            <p>
                                Isi respon dan ubah status laporan
                            </p>

                        </div>

                        <div class="header-icon">

                            <i class="bi bi-chat-left-text"></i>

                        </div>

                    </div>

                    <!-- FORM -->
                    <form action="{{ route('guru.respon.store', $pengaduan->id) }}"
                          method="POST">

                        @csrf

                        <!-- TEXTAREA -->
                        <div class="mb-4">

                            <label class="form-label">
                                Isi Tanggapan
                            </label>

                            <textarea
                                name="tanggapan"
                                rows="7"
                                class="form-control modern-input"
                                placeholder="Tuliskan tindak lanjut atau respon terhadap laporan ini..."
                                required></textarea>

                        </div>

                        <!-- STATUS -->
                        <div class="mb-4">

                            <label class="form-label">
                                Status Laporan
                            </label>

                            <select
                                name="status"
                                class="form-select modern-input"
                                required>

                                <option value="pending">
                                    Pending
                                </option>

                                <option value="proses">
                                    Proses
                                </option>

                                <option value="selesai">
                                    Selesai
                                </option>

                            </select>

                        </div>

                        <!-- BUTTON -->
                        <div class="button-group">

                            <a href="{{ url()->previous() }}"
                               class="btn btn-light btn-modern">

                                Kembali

                            </a>

                            <button type="submit"
                                    class="btn btn-success btn-modern">

                                <i class="bi bi-send-check"></i>

                                Simpan Respon

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<style>

/* =========================================================
   ROOT
========================================================= */

:root{
    --bg:#f5f7fa;
    --surface:#ffffff;

    --border:#e9edf2;

    --text-1:#1f2937;
    --text-2:#4b5563;
    --text-3:#9ca3af;

    --green:#2f6f57;
    --green-soft:#edf5f1;

    --red:#c65b5b;
    --red-soft:#fdf1f1;

    --orange:#c79b46;
    --orange-soft:#fbf6eb;

    --shadow:
    0 1px 2px rgba(15,23,42,.03),
    0 8px 20px rgba(15,23,42,.03);
}

/* =========================================================
   BODY
========================================================= */

body{
    background:var(--bg);
    overflow:hidden;
    color:var(--text-1);
}

/* =========================================================
   PAGE
========================================================= */

.tanggapi-page{
    height:calc(100vh - 90px);

    display:flex;
    flex-direction:column;

    gap:18px;
}

/* =========================================================
   HEADER
========================================================= */

.tanggapi-header{
    background:#fff;

    border:1px solid var(--border);

    border-radius:16px;

    padding:18px 22px;

    display:flex;
    justify-content:space-between;
    align-items:center;

    gap:16px;
    flex-wrap:wrap;

    flex-shrink:0;

    box-shadow:var(--shadow);
}

.header-title{
    font-size:24px;
    font-weight:700;

    margin-bottom:3px;
}

.header-subtitle{
    margin:0;

    color:var(--text-3);

    font-size:13px;
}

.header-right{
    display:flex;
    align-items:center;
    gap:12px;

    flex-wrap:wrap;
}

/* DATE */

.date-box{
    height:40px;

    padding:0 14px;

    border-radius:10px;

    border:1px solid var(--border);

    background:#fafbfc;

    display:flex;
    align-items:center;
    gap:8px;

    font-size:12px;
    color:var(--text-2);
}

/* NOTIF */

.notif-box{
    width:40px;
    height:40px;

    border-radius:10px;

    border:1px solid var(--border);

    background:#fff;

    display:flex;
    align-items:center;
    justify-content:center;

    position:relative;

    color:var(--text-2);

    font-size:17px;
}

.notif-badge{
    position:absolute;

    top:-4px;
    right:-4px;

    width:18px;
    height:18px;

    border-radius:50%;

    background:#dc3545;
    color:#fff;

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:10px;
}

/* PROFILE */

.profile-img{
    width:42px;
    height:42px;

    border-radius:50%;

    object-fit:cover;

    border:2px solid #f3f4f6;
}

/* =========================================================
   SCROLL
========================================================= */

.tanggapi-scroll{
    flex:1;

    overflow-y:auto;
    overflow-x:hidden;

    padding-right:4px;
}

/* SCROLLBAR */

.tanggapi-scroll::-webkit-scrollbar{
    width:8px;
}

.tanggapi-scroll::-webkit-scrollbar-thumb{
    background:#d1d5db;
    border-radius:20px;
}

/* =========================================================
   CARD
========================================================= */

.detail-card,
.respon-card{
    background:#fff;

    border:1px solid var(--border);

    border-radius:16px;

    padding:22px;

    box-shadow:var(--shadow);
}

/* =========================================================
   DETAIL
========================================================= */

.detail-top{
    display:flex;
    justify-content:space-between;
    align-items:center;

    gap:10px;
    flex-wrap:wrap;
}

/* BADGE */

.kategori-badge{
    background:var(--green-soft);
    color:var(--green);

    padding:6px 12px;

    border-radius:30px;

    font-size:11px;
    font-weight:600;
}

.status-badge{
    padding:6px 12px;

    border-radius:30px;

    font-size:11px;
    font-weight:600;
}

.status-danger{
    background:var(--red-soft);
    color:var(--red);
}

.status-warning{
    background:var(--orange-soft);
    color:var(--orange);
}

.status-success{
    background:var(--green-soft);
    color:var(--green);
}

/* TITLE */

.detail-title{
    font-size:24px;
    font-weight:700;

    line-height:1.5;

    margin-top:24px;
    margin-bottom:24px;
}

/* META */

.meta-list{
    display:flex;
    flex-direction:column;
    gap:18px;
}

.meta-item{
    display:flex;
    align-items:flex-start;
    gap:14px;
}

.meta-icon{
    width:42px;
    height:42px;

    border-radius:12px;

    background:#f8fafc;

    border:1px solid #edf2f7;

    display:flex;
    align-items:center;
    justify-content:center;

    color:var(--green);

    flex-shrink:0;
}

.meta-item small{
    color:var(--text-3);

    font-size:11px;
}

.meta-item h6{
    margin-top:4px;
    margin-bottom:0;

    font-size:14px;
    font-weight:600;

    color:var(--text-1);
}

/* DESC */

.laporan-box{
    margin-top:24px;

    padding-top:20px;

    border-top:1px solid #f1f3f5;
}

.laporan-box h6{
    font-size:14px;
    font-weight:600;

    margin-bottom:10px;
}

.laporan-box p{
    font-size:13px;

    line-height:1.8;

    color:var(--text-2);

    margin:0;
}

/* IMAGE */

.bukti-box{
    margin-top:22px;
}

.bukti-box img{
    width:100%;

    max-height:300px;

    object-fit:cover;

    border-radius:14px;

    border:1px solid #e5e7eb;
}

/* =========================================================
   RESPON
========================================================= */

.respon-top{
    display:flex;
    justify-content:space-between;
    align-items:center;

    gap:14px;

    padding-bottom:18px;

    border-bottom:1px solid #f1f3f5;

    margin-bottom:24px;
}

.respon-top h4{
    font-size:22px;
    font-weight:700;

    margin-bottom:4px;
}

.respon-top p{
    margin:0;

    font-size:13px;

    color:var(--text-3);
}

/* ICON */

.header-icon{
    width:56px;
    height:56px;

    border-radius:16px;

    background:var(--green-soft);

    color:var(--green);

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:22px;

    flex-shrink:0;
}

/* =========================================================
   FORM
========================================================= */

.form-label{
    font-size:13px;
    font-weight:600;

    margin-bottom:10px;

    color:#374151;
}

.modern-input{
    border:1px solid #e5e7eb;

    border-radius:12px;

    padding:12px 14px;

    font-size:13px;

    box-shadow:none !important;
}

.modern-input:focus{
    border-color:var(--green);
}

textarea.modern-input{
    min-height:180px;
    resize:none;
}

/* =========================================================
   BUTTON
========================================================= */

.button-group{
    display:flex;
    justify-content:flex-end;
    gap:12px;

    flex-wrap:wrap;
}

.btn-modern{
    border-radius:10px;

    padding:10px 18px;

    font-size:13px;
    font-weight:500;
}

/* =========================================================
   RESPONSIVE
========================================================= */

@media(max-width:992px){

    body{
        overflow:auto;
    }

    .tanggapi-page{
        height:auto;
    }

    .tanggapi-scroll{
        overflow:visible;
    }

}

@media(max-width:768px){

    .tanggapi-header{
        flex-direction:column;
        align-items:flex-start;
    }

    .header-right{
        width:100%;
    }

    .respon-top{
        flex-direction:column;
        align-items:flex-start;
    }

    .button-group{
        flex-direction:column;
    }

    .button-group .btn{
        width:100%;
    }

}

</style>

@endsection