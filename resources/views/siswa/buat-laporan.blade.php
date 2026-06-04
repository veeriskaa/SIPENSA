@extends('layouts.siswa')

@section('title','Buat Laporan')

@section('content')

<div class="laporan-page">

    <!-- FIX HEADER -->
    <div class="page-header">

        <div>
            <h3 class="page-title">
                Buat Laporan Baru
            </h3>

            <p class="page-subtitle">
                Sampaikan laporan atau permasalahan yang terjadi dengan detail dan jelas
            </p>
        </div>

        <div class="header-right">


        </div>

    </div>

    <!-- CONTENT -->
    <div class="laporan-content">

        <!-- FORM CARD -->
        <div class="report-card">

            <div class="card-header-custom">

                <div class="header-icon">
                    <i class="bi bi-file-earmark-text"></i>
                </div>

                <div>
                    <h5 class="mb-1">
                        Form Pengaduan
                    </h5>

                    <small>
                        Isi seluruh data laporan dengan lengkap
                    </small>
                </div>

            </div>

            <form action="{{ route('laporan.store') }}"
                  method="POST"
                  enctype="multipart/form-data"
                  id="laporanForm">

                @csrf

                <div class="row g-4">

                    <!-- KATEGORI -->
                    <div class="col-md-6">

                        <label class="form-label">
                            Kategori Masalah
                        </label>

                        <select name="kategori"
                                class="form-select modern-input"
                                required>

                            <option value="">
                                Pilih Kategori
                            </option>

                            <option value="Bullying">
                                Bullying
                            </option>

                            <option value="Fasilitas">
                                Fasilitas
                            </option>

                            <option value="Akademik">
                                Akademik
                            </option>

                        </select>

                    </div>

                    <!-- LOKASI -->
                    <div class="col-md-6">

                        <label class="form-label">
                            Lokasi Kejadian
                        </label>

                        <input type="text"
                               name="lokasi"
                               class="form-control modern-input"
                               placeholder="Contoh: Ruang Kelas XI TKJ">

                    </div>

                    <!-- JUDUL -->
                    <div class="col-12">

                        <label class="form-label">
                            Judul Laporan
                        </label>

                        <input type="text"
                               name="judul"
                               class="form-control modern-input"
                               placeholder="Masukkan judul laporan"
                               required>

                    </div>

                    <!-- WAKTU -->
                    <div class="col-md-6">

                        <label class="form-label">
                            Waktu Kejadian
                        </label>

                        <input type="datetime-local"
                               name="waktu"
                               class="form-control modern-input">

                    </div>

                    <!-- FILE -->
                    <div class="col-md-6">

                        <label class="form-label">
                            Bukti Pendukung
                        </label>

                        <input type="file"
                               name="bukti"
                               class="form-control modern-input">

                        <small class="text-muted mt-1 d-block">
                            JPG, PNG, PDF • Maksimal 5MB
                        </small>

                    </div>

                    <!-- DESKRIPSI -->
                    <div class="col-12">

                        <label class="form-label">
                            Deskripsi Detail
                        </label>

                        <textarea name="deskripsi"
                                  rows="6"
                                  class="form-control modern-input textarea-input"
                                  placeholder="Jelaskan kejadian secara lengkap..."
                                  required></textarea>

                    </div>

                </div>

                <!-- BUTTON -->
                <div class="action-wrapper">

                    <a href="/siswa"
                       class="btn btn-light btn-modern border">

                        Batal

                    </a>

                    <button type="submit"
                            id="submitBtn"
                            class="btn btn-success btn-modern">

                        <i class="bi bi-send"></i>
                        Kirim Laporan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<style>

/* =========================================================
   PAGE
========================================================= */

.laporan-page{
    display:flex;
    flex-direction:column;
    height:100%;
    min-height:100%;
}

/* =========================================================
   FIX HEADER
========================================================= */

.page-header{
    position:sticky;
    top:0;

    z-index:100;

    background:rgba(255,255,255,.96);

    backdrop-filter:blur(10px);
    -webkit-backdrop-filter:blur(10px);

    padding:22px 26px;

    border:1px solid #edf1f5;
    border-radius:18px;

    display:flex;
    justify-content:space-between;
    align-items:center;

    gap:20px;

    margin-bottom:20px;

    box-shadow:
    0 2px 10px rgba(15,23,42,0.04);

    flex-shrink:0;
}

.page-title{
    font-size:22px;
    font-weight:600;
    color:#111827;
    margin-bottom:4px;
}

.page-subtitle{
    margin:0;
    font-size:13px;
    color:#6b7280;
}

.header-right{
    display:flex;
    align-items:center;
    gap:14px;
}

/* =========================================================
   CONTENT AREA
========================================================= */

.laporan-content{
    flex:1;
    min-height:0;
}

/* =========================================================
   NOTIF
========================================================= */

.notif-btn{
    width:44px;
    height:44px;

    border-radius:14px;

    background:white;

    border:1px solid #e5e7eb;

    display:flex;
    align-items:center;
    justify-content:center;

    color:#374151;
    text-decoration:none;

    font-size:18px;

    transition:.2s;
}

.notif-btn:hover{
    background:#f9fafb;
}

.notif-badge{
    position:absolute;

    top:-5px;
    right:-5px;

    background:#dc3545;
    color:white;

    width:18px;
    height:18px;

    border-radius:50%;

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:10px;
    font-weight:600;
}

.notif-dropdown{
    width:290px;
    border-radius:16px;
    overflow:hidden;
}

/* =========================================================
   PROFILE
========================================================= */

.profile-img{
    width:44px;
    height:44px;

    border-radius:50%;
    object-fit:cover;

    border:2px solid #f3f4f6;
}

/* =========================================================
   CARD
========================================================= */

.report-card{
    background:white;

    border-radius:20px;

    padding:28px;

    border:1px solid #edf1f5;

    box-shadow:
    0 3px 12px rgba(15,23,42,0.04);

    overflow:hidden;
}

/* =========================================================
   CARD HEADER
========================================================= */

.card-header-custom{
    display:flex;
    align-items:center;
    gap:16px;

    padding-bottom:22px;
    margin-bottom:26px;

    border-bottom:1px solid #f1f3f5;
}

.header-icon{
    width:56px;
    height:56px;

    border-radius:16px;

    background:#ecfdf3;
    color:#16a34a;

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:22px;

    flex-shrink:0;
}

.card-header-custom h5{
    font-size:18px;
    font-weight:600;
    color:#111827;
}

.card-header-custom small{
    color:#6b7280;
}

/* =========================================================
   INPUT
========================================================= */

.form-label{
    font-size:14px;
    font-weight:500;
    color:#374151;
    margin-bottom:10px;
}

.modern-input{
    border-radius:14px !important;

    border:1px solid #e5e7eb !important;

    padding:13px 16px !important;

    font-size:14px;

    box-shadow:none !important;

    transition:.2s;
}

.modern-input:focus{
    border-color:#16a34a !important;

    box-shadow:
    0 0 0 3px rgba(22,163,74,0.08) !important;
}

.textarea-input{
    resize:none;
    min-height:170px;
}

/* =========================================================
   BUTTON
========================================================= */

.action-wrapper{
    margin-top:30px;

    display:flex;
    justify-content:flex-end;

    gap:12px;

    flex-wrap:wrap;
}

.btn-modern{
    border-radius:12px;

    padding:11px 22px;

    font-size:14px;
    font-weight:500;
}

/* =========================================================
   RESPONSIVE
========================================================= */

@media(max-width:768px){

    .page-header{
        flex-direction:column;
        align-items:flex-start;
    }

    .header-right{
        width:100%;
        justify-content:flex-start;
    }

    .report-card{
        padding:20px;
    }

    .action-wrapper{
        flex-direction:column;
    }

    .btn-modern{
        width:100%;
    }

}

</style>

<script>

document.getElementById('laporanForm')
.addEventListener('submit', function(){

    const btn = document.getElementById('submitBtn');

    btn.disabled = true;

    btn.innerHTML = `
        <span class="spinner-border spinner-border-sm me-2"></span>
        Mengirim...
    `;
});

</script>

@endsection