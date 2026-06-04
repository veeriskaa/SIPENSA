@extends('layouts.siswa')

@section('title','Laporan Saya')

@section('content')

<div class="laporan-page">

    <!-- FIX HEADER -->
    <div class="page-header">

        <div>
            <h3 class="page-title">
                Laporan Saya
            </h3>

            <p class="page-subtitle">
                Riwayat laporan yang telah dikirim beserta status penanganannya
            </p>
        </div>

        <div class="header-right">



        </div>

    </div>

    <!-- SCROLL CONTENT -->
    <div class="laporan-content">

        <!-- TOP ACTION -->
        <div class="top-action-card">

            <div class="filter-wrapper">

                <i class="bi bi-funnel"></i>

                <select class="filter-status" id="filterStatus">
                    <option value="semua">Semua Status</option>
                    <option value="proses">Proses</option>
                    <option value="selesai">Selesai</option>
                    <option value="pending">Pending</option>
                </select>

            </div>

            <a href="/buat-laporan"
               class="btn btn-success btn-modern">

                <i class="bi bi-plus-lg"></i>
                Buat Laporan

            </a>

        </div>

        <!-- LIST -->
        <div class="laporan-list">

            @forelse($laporans as $item)

            <div class="laporan-card"
                data-status="{{ strtolower($item->status) }}">

                <!-- TOP -->
                <div class="card-top">

                    <div>

                        <div class="kategori-badge">
                            {{ $item->kategori ?? 'Laporan' }}
                        </div>

                        <h5 class="laporan-title">
                            {{ $item->judul }}
                        </h5>

                    </div>

                    <!-- STATUS -->
                    @if($item->status == 'proses')

                        <span class="status-badge status-warning">
                            <i class="bi bi-clock-history"></i>
                            Proses
                        </span>

                    @elseif($item->status == 'selesai')

                        <span class="status-badge status-success">
                            <i class="bi bi-check-circle"></i>
                            Selesai
                        </span>

                    @else

                        <span class="status-badge status-danger">
                            <i class="bi bi-exclamation-circle"></i>
                            Pending
                        </span>

                    @endif

                </div>

                <!-- DESC -->
                <p class="laporan-desc">

                    {{ \Illuminate\Support\Str::limit($item->deskripsi, 150) }}

                </p>

                <!-- FOOTER -->
                <div class="laporan-footer">

                    <div class="footer-info">

                        <span>
                            <i class="bi bi-calendar-event"></i>

                            {{ $item->created_at->diffForHumans() }}
                        </span>

                    </div>

                    <a href="/pengaduan/{{ $item->id }}" class="detail-btn">

                        <i class="bi bi-eye"></i>
                        Detail

                    </a>

                </div>

            </div>

            @empty

            <div class="empty-state">

                <i class="bi bi-inbox"></i>

                <h5>
                    Belum Ada Laporan
                </h5>

                <p>
                    Laporan yang kamu kirim akan muncul di halaman ini
                </p>

            </div>

            @endforelse

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

    border-radius:18px;

    display:flex;
    justify-content:space-between;
    align-items:center;

    gap:18px;

    margin-bottom:22px;

    border:1px solid #edf1f5;

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
   CONTENT
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

    text-decoration:none;

    color:#374151;

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
   ACTION CARD
========================================================= */

.top-action-card{
    position:sticky;
    top:90px;

    z-index:40;

    background:rgba(255,255,255,0.95);

    backdrop-filter:blur(12px);
    -webkit-backdrop-filter:blur(12px);

    border-radius:18px;
    padding:18px 22px;

    margin-bottom:22px;

    border:1px solid #edf1f5;

    display:flex;
    justify-content:space-between;
    align-items:center;

    flex-wrap:wrap;
    gap:14px;

    box-shadow:
    0 2px 10px rgba(15,23,42,0.04);
}

.filter-wrapper{
    display:flex;
    align-items:center;

    gap:10px;

    background:#f9fafb;

    border:1px solid #e5e7eb;

    border-radius:14px;

    padding:10px 14px;

    color:#6b7280;
}

.filter-status{
    border:none;
    background:transparent;
    outline:none;

    font-size:14px;
    color:#374151;
}

.filter-wrapper{
    position:relative;
    z-index:2;
}

.btn-modern{
    position:relative;
    z-index:2;
}
/* =========================================================
   LIST
========================================================= */

.laporan-list{
    display:flex;
    flex-direction:column;
    gap:18px;
}

/* =========================================================
   CARD
========================================================= */

.laporan-card{
    background:white;

    border-radius:20px;

    padding:22px;

    border:1px solid #edf1f5;

    box-shadow:
    0 2px 12px rgba(15,23,42,0.04);

    transition:.25s;

    overflow:hidden;
}

.laporan-card:hover{
    transform:translateY(-2px);

    box-shadow:
    0 10px 24px rgba(15,23,42,0.08);
}

/* =========================================================
   TOP
========================================================= */

.card-top{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;

    gap:14px;

    flex-wrap:wrap;
}

.kategori-badge{
    display:inline-flex;
    align-items:center;

    background:#ecfdf3;
    color:#15803d;

    padding:6px 12px;

    border-radius:30px;

    font-size:12px;
    font-weight:500;

    margin-bottom:12px;
}

.laporan-title{
    font-size:20px;
    font-weight:600;

    color:#111827;

    margin:0;

    line-height:1.5;

    word-break:break-word;
}

/* =========================================================
   STATUS
========================================================= */

.status-badge{
    padding:8px 14px;

    border-radius:30px;

    font-size:12px;
    font-weight:500;

    display:flex;
    align-items:center;
    gap:6px;

    flex-shrink:0;
}

.status-warning{
    background:#fff7e6;
    color:#b45309;
}

.status-success{
    background:#ecfdf3;
    color:#15803d;
}

.status-danger{
    background:#fef2f2;
    color:#dc2626;
}

/* =========================================================
   DESC
========================================================= */

.laporan-desc{
    margin-top:16px;

    color:#6b7280;

    font-size:14px;

    line-height:1.8;

    word-break:break-word;
}

/* =========================================================
   FOOTER
========================================================= */

.laporan-footer{
    margin-top:20px;

    padding-top:18px;

    border-top:1px solid #f3f4f6;

    display:flex;
    justify-content:space-between;
    align-items:center;

    flex-wrap:wrap;

    gap:12px;
}

.footer-info{
    color:#6b7280;
    font-size:13px;
}

.footer-info span{
    display:flex;
    align-items:center;
    gap:6px;
}

/* =========================================================
   BUTTON
========================================================= */

.btn-modern{
    border-radius:12px;

    padding:10px 18px;

    font-size:14px;
    font-weight:500;
}

.detail-btn{
    background:#16a34a;
    color:white;

    text-decoration:none;

    padding:10px 16px;

    border-radius:12px;

    font-size:13px;
    font-weight:500;

    display:flex;
    align-items:center;
    gap:7px;

    transition:.2s;
}

.detail-btn:hover{
    background:#15803d;
    color:white;
}

/* =========================================================
   EMPTY
========================================================= */

.empty-state{
    background:white;

    border-radius:22px;

    padding:70px 20px;

    text-align:center;

    border:1px dashed #d1d5db;
}

.empty-state i{
    font-size:60px;
    color:#9ca3af;
}

.empty-state h5{
    margin-top:18px;

    font-size:22px;
    font-weight:600;

    color:#374151;
}

.empty-state p{
    color:#6b7280;
    margin-top:8px;
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

    .top-action-card{
        flex-direction:column;
        align-items:stretch;
    }

    .detail-btn,
    .btn-modern{
        width:100%;
        justify-content:center;
    }

    .laporan-footer{
        flex-direction:column;
        align-items:flex-start;
    }

}

/* ===============================
   MOBILE RESPONSIVE
================================= */
@media (max-width: 768px){

    .laporan-page{
        padding:0;
    }

    .page-header{
        padding:16px;
        border-radius:14px;
        margin-bottom:16px;
    }

    .page-title{
        font-size:18px;
    }

    .page-subtitle{
        font-size:12px;
    }

    .top-action-card{
        top:70px;
        padding:14px;
        border-radius:14px;
    }

    .filter-wrapper{
        width:100%;
    }

    .filter-status{
        width:100%;
    }

    .btn-modern{
        width:100%;
    }

    .laporan-card{
        padding:16px;
        border-radius:16px;
    }

    .laporan-title{
        font-size:16px;
        line-height:1.4;
    }

    .laporan-desc{
        font-size:13px;
    }

    .card-top{
        flex-direction:column;
        align-items:flex-start;
    }

    .status-badge{
        align-self:flex-start;
    }

    .laporan-footer{
        flex-direction:column;
        align-items:flex-start;
    }

    .detail-btn{
        width:100%;
        justify-content:center;
    }

}

</style>

<!-- SCRIPT NOTIF REALTIME -->
<script>

function loadNotif() {

    fetch('/notif')
    .then(res => res.json())
    .then(data => {

        const badge = document.getElementById('notif-count');

        if(data.jumlah > 0){

            badge.innerText = data.jumlah;
            badge.style.display = 'flex';

        }else{

            badge.style.display = 'none';
        }

        let html = `
            <li class="px-3 py-2 fw-semibold border-bottom">
                Notifikasi
            </li>
        `;

        if(data.data.length === 0){

            html += `
                <li class="px-3 py-3 text-muted text-center">
                    Tidak ada notifikasi
                </li>
            `;

        }else{

            data.data.forEach(n => {

                html += `
                    <li>
                        <a class="dropdown-item py-3 border-bottom small">
                            ${n.pesan}
                        </a>
                    </li>
                `;
            });
        }

        document.getElementById('notif-list').innerHTML = html;

    })
    .catch(err => console.log(err));
}

loadNotif();

setInterval(loadNotif, 5000);


const filterStatus = document.getElementById('filterStatus');

filterStatus.addEventListener('change', function(){

    const selected = this.value;

    document.querySelectorAll('.laporan-card')
    .forEach(card => {

        const status = card.dataset.status;

        if(selected === 'semua'){
            card.style.display = 'block';
        }
        else if(status === selected){
            card.style.display = 'block';
        }
        else{
            card.style.display = 'none';
        }

    });
    

});

</script>

@endsection