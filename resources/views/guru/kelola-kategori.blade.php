@extends('layouts.guru')

@section('title','Kelola Kategori')

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

.kk * { box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }

.kk {
    display: flex; flex-direction: column;
    height: 100%; overflow: hidden;
    gap: 14px; animation: kkFade .35s ease both;
}

@keyframes kkFade {
    from { opacity:0; transform:translateY(8px); }
    to   { opacity:1; transform:translateY(0); }
}

/* HEADER */
.kk-header {
    flex-shrink: 0; background: #fff;
    border: 1px solid var(--border); border-radius: 18px;
    padding: 18px 22px; box-shadow: 0 2px 10px rgba(15,23,42,.04);
    display: flex; align-items: center;
    justify-content: space-between; gap: 14px; flex-wrap: wrap;
}

.kk-header-left { display: flex; align-items: center; gap: 14px; }

.kk-header-icon {
    width: 44px; height: 44px; border-radius: 13px;
    background: #f0fdf4; border: 1px solid #bbf7d0;
    color: var(--g1); display: flex; align-items: center;
    justify-content: center; font-size: 20px; flex-shrink: 0;
}

.kk-title { font-size: 18px; font-weight: 700; color: var(--text); margin: 0 0 2px; }
.kk-sub   { font-size: 12px; color: #9ca3af; margin: 0; }

.btn-tambah {
    display: inline-flex; align-items: center; gap: 8px;
    background: linear-gradient(135deg, var(--g1), var(--g2));
    color: white; border: none; padding: 10px 18px;
    border-radius: 12px; font-size: 13px; font-weight: 600;
    font-family: 'Plus Jakarta Sans', sans-serif;
    cursor: pointer; transition: .2s; white-space: nowrap;
    box-shadow: 0 3px 10px rgba(10,127,46,.2);
}
.btn-tambah:hover { transform: translateY(-1px); box-shadow: 0 6px 16px rgba(10,127,46,.28); color: white; }

/* ALERT */
.kk-alert {
    flex-shrink: 0; display: flex; align-items: center; gap: 10px;
    padding: 12px 16px; border-radius: 14px;
    background: #f0fdf4; border: 1px solid #bbf7d0;
    color: #15803d; font-size: 13px; font-weight: 500;
}

/* SCROLL */
.kk-scroll {
    flex: 1; overflow-y: auto; overflow-x: hidden;
    min-height: 0; padding-bottom: 24px;
    scrollbar-width: thin; scrollbar-color: #e5e7eb transparent;
}
.kk-scroll::-webkit-scrollbar { width: 5px; }
.kk-scroll::-webkit-scrollbar-thumb { background: #e5e7eb; border-radius: 99px; }

/* GRID */
.kk-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
    gap: 14px;
}

/* CARD */
.kk-card {
    border-radius: 20px;
    border: 1px solid rgba(255,255,255,.6);
    padding: 20px;
    transition: .25s;
    position: relative;
    overflow: hidden;
    animation: cardIn .3s ease both;
}

@keyframes cardIn {
    from { opacity:0; transform:translateY(6px); }
    to   { opacity:1; transform:translateY(0); }
}

.kk-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 14px 32px rgba(15,23,42,.1);
}

/* card shimmer */
.kk-card::after {
    content: '';
    position: absolute;
    top: 0; right: 0;
    width: 80px; height: 80px;
    border-radius: 50%;
    background: rgba(255,255,255,.18);
    transform: translate(20px,-20px);
    pointer-events: none;
}

/* TOP */
.kk-card-top {
    display: flex; justify-content: space-between;
    align-items: flex-start; margin-bottom: 16px;
}

.kk-icon {
    width: 50px; height: 50px; border-radius: 15px;
    background: rgba(255,255,255,.6);
    display: flex; align-items: center; justify-content: center;
    font-size: 22px;
}

/* KEBAB MENU */
.kk-menu-wrap { position: relative; }

.kk-menu-btn {
    width: 34px; height: 34px; border-radius: 10px;
    border: none; background: rgba(255,255,255,.6);
    color: #6b7280; font-size: 16px; cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    transition: .2s;
}
.kk-menu-btn:hover { background: rgba(255,255,255,.9); }

.kk-dropdown {
    display: none;
    position: absolute; top: calc(100% + 6px); right: 0;
    background: white; border-radius: 14px;
    border: 1px solid #e5e7eb;
    box-shadow: 0 8px 24px rgba(15,23,42,.12);
    min-width: 140px; overflow: hidden;
    z-index: 100; animation: dropIn .15s ease;
}

@keyframes dropIn {
    from { opacity:0; transform:translateY(-6px); }
    to   { opacity:1; transform:translateY(0); }
}

.kk-dropdown.open { display: block; }

.kk-dropdown-item {
    display: flex; align-items: center; gap: 9px;
    padding: 11px 16px; font-size: 13px; font-weight: 500;
    color: #374151; cursor: pointer; transition: .15s;
    background: none; border: none; width: 100%; text-align: left;
    font-family: 'Plus Jakarta Sans', sans-serif;
}
.kk-dropdown-item:hover { background: #f9fafb; }
.kk-dropdown-item.danger { color: #dc2626; }
.kk-dropdown-item.danger:hover { background: #fef2f2; }

/* BODY */
.kk-card-name { font-size: 17px; font-weight: 700; color: #111827; margin: 0 0 4px; }
.kk-card-desc { font-size: 12px; color: rgba(0,0,0,.45); margin: 0; }

/* FOOTER */
.kk-card-footer {
    display: flex; justify-content: space-between; align-items: center;
    margin-top: 18px; padding-top: 14px;
    border-top: 1px solid rgba(255,255,255,.5);
}

.kk-badge {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 5px 12px; border-radius: 30px;
    background: rgba(255,255,255,.7);
    font-size: 11px; font-weight: 700;
}

.kk-dot { width: 6px; height: 6px; border-radius: 50%; animation: dotPulse 2s infinite; }
@keyframes dotPulse { 0%,100%{opacity:1;}50%{opacity:.4;} }

.kk-laporan-count { font-size: 12px; color: rgba(0,0,0,.45); }

/* EMPTY */
.kk-empty {
    grid-column: 1 / -1; text-align: center;
    padding: 70px 20px; background: white;
    border-radius: 20px; border: 1px dashed #d1d5db;
    display: flex; flex-direction: column; align-items: center;
}
.kk-empty-icon {
    width: 72px; height: 72px; border-radius: 50%;
    background: #f9fafb; border: 1px solid #f3f4f6;
    display: flex; align-items: center; justify-content: center;
    font-size: 30px; color: #d1d5db; margin-bottom: 16px;
}
.kk-empty h4 { font-size: 18px; font-weight: 700; color: #374151; margin: 0 0 6px; }
.kk-empty p  { font-size: 13px; color: #9ca3af; margin: 0; }

/* OVERLAY */
.kk-overlay {
    display: none; position: fixed; inset: 0;
    background: rgba(0,0,0,.5); z-index: 99999;
    align-items: center; justify-content: center; padding: 20px;
}
.kk-overlay.active { display: flex; }

.kk-modal {
    background: white; border-radius: 20px;
    width: 100%; max-width: 440px; overflow: hidden;
    box-shadow: 0 24px 64px rgba(0,0,0,.25);
    animation: modalIn .2s ease both;
}
@keyframes modalIn {
    from { opacity:0; transform:scale(.96) translateY(10px); }
    to   { opacity:1; transform:scale(1) translateY(0); }
}

.kk-modal-head {
    background: #f9fafb; border-bottom: 1px solid #f3f4f6;
    padding: 18px 22px; display: flex;
    justify-content: space-between; align-items: center;
}
.kk-modal-head h5 { font-size: 15px; font-weight: 700; color: #111827; margin: 0; }
.kk-modal-close {
    background: none; border: none; font-size: 22px;
    color: #9ca3af; cursor: pointer; line-height: 1; padding: 0;
}
.kk-modal-close:hover { color: #374151; }

.kk-modal-body { padding: 22px; }

.kk-form-label { font-size: 12px; font-weight: 600; color: #374151; display: block; margin-bottom: 6px; }

.kk-form-input {
    width: 100%; height: 44px; padding: 0 14px;
    border: 1.5px solid #e5e7eb; border-radius: 12px;
    font-size: 14px; outline: none;
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: #f9fafb; color: #111827;
    transition: .2s; box-sizing: border-box; margin-bottom: 20px;
}
.kk-form-input:focus { border-color: var(--g1); background: white; box-shadow: 0 0 0 3px rgba(10,127,46,.07); }

.kk-modal-footer { display: flex; gap: 10px; }

.kk-btn-cancel {
    flex: 1; height: 42px; border-radius: 11px;
    border: 1.5px solid #e5e7eb; background: white;
    font-size: 13px; font-weight: 600;
    font-family: 'Plus Jakarta Sans', sans-serif; cursor: pointer;
}
.kk-btn-cancel:hover { background: #f9fafb; }

.kk-btn-save {
    flex: 1; height: 42px; border-radius: 11px; border: none;
    background: linear-gradient(135deg, var(--g1), var(--g2));
    color: white; font-size: 13px; font-weight: 700;
    font-family: 'Plus Jakarta Sans', sans-serif; cursor: pointer;
    box-shadow: 0 3px 10px rgba(10,127,46,.2);
}
.kk-btn-save:hover { box-shadow: 0 6px 16px rgba(10,127,46,.3); }

/* DELETE MODAL */
.kk-del-icon {
    width: 58px; height: 58px; border-radius: 50%;
    background: #fef2f2; border: 1px solid #fecaca;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 16px; font-size: 26px; color: #dc2626;
}
.kk-btn-del {
    flex: 1; height: 42px; border-radius: 11px; border: none;
    background: #ef4444; color: white; font-size: 13px; font-weight: 700;
    font-family: 'Plus Jakarta Sans', sans-serif; cursor: pointer;
}
.kk-btn-del:hover { background: #dc2626; }

/* RESPONSIVE */
@media (max-width: 768px) {
    .kk { gap: 12px; }
    .kk-header { padding: 14px 16px; border-radius: 14px; }
    .kk-header-icon { width: 38px; height: 38px; font-size: 17px; }
    .kk-title { font-size: 16px; }
    .btn-tambah { width: 100%; justify-content: center; }
    .kk-grid { grid-template-columns: 1fr 1fr; gap: 10px; }
}

@media (max-width: 480px) {
    .kk-grid { grid-template-columns: 1fr; }
}

</style>

<div class="kk">

    {{-- HEADER --}}
    <div class="kk-header">
        <div class="kk-header-left">
            <div class="kk-header-icon">
                <i class="bi bi-folder2-open"></i>
            </div>
            <div>
                <h3 class="kk-title">Kelola Kategori</h3>
                <p class="kk-sub">Tambahkan dan kelola kategori laporan siswa</p>
            </div>
        </div>
        <button class="btn-tambah" onclick="openTambah()">
            <i class="bi bi-plus-lg"></i>
            Tambah Kategori
        </button>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
    <div class="kk-alert">
        <i class="bi bi-check-circle-fill"></i>
        {{ session('success') }}
    </div>
    @endif

    {{-- SCROLL --}}
    <div class="kk-scroll">
        <div class="kk-grid">

            @php
                $palettes = [
                    ['card' => '#fef2f2', 'icon_bg' => 'rgba(255,255,255,.65)', 'icon_color' => '#ef4444', 'dot' => '#ef4444'],
                    ['card' => '#f0fdf4', 'icon_bg' => 'rgba(255,255,255,.65)', 'icon_color' => '#16a34a', 'dot' => '#16a34a'],
                    ['card' => '#eff6ff', 'icon_bg' => 'rgba(255,255,255,.65)', 'icon_color' => '#3b82f6', 'dot' => '#3b82f6'],
                    ['card' => '#fffbeb', 'icon_bg' => 'rgba(255,255,255,.65)', 'icon_color' => '#f59e0b', 'dot' => '#f59e0b'],
                    ['card' => '#f5f3ff', 'icon_bg' => 'rgba(255,255,255,.65)', 'icon_color' => '#8b5cf6', 'dot' => '#8b5cf6'],
                    ['card' => '#fff1f2', 'icon_bg' => 'rgba(255,255,255,.65)', 'icon_color' => '#f43f5e', 'dot' => '#f43f5e'],
                ];
            @endphp

            @forelse($kategori as $item)

            @php $p = $palettes[$loop->index % count($palettes)]; @endphp

            <div class="kk-card" style="background:{{ $p['card'] }};">

                <div class="kk-card-top">
                    <div class="kk-icon" style="color:{{ $p['icon_color'] }};">
                        <i class="bi bi-folder2-open"></i>
                    </div>

                    <div class="kk-menu-wrap">
                        <button class="kk-menu-btn" onclick="toggleMenu({{ $item->id_kategori }})">
                            <i class="bi bi-three-dots"></i>
                        </button>
                        <div class="kk-dropdown" id="menu-{{ $item->id_kategori }}">
                            <button class="kk-dropdown-item"
                                onclick="openEdit({{ $item->id_kategori }}, '{{ addslashes($item->nama_kategori) }}')">
                                <i class="bi bi-pencil"></i> Edit
                            </button>
                            <button class="kk-dropdown-item danger"
                                onclick="openDelete({{ $item->id_kategori }}, '{{ addslashes($item->nama_kategori) }}')">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </div>
                    </div>
                </div>

                <p class="kk-card-name">{{ $item->nama_kategori }}</p>
                <p class="kk-card-desc">Kategori laporan siswa</p>

                <div class="kk-card-footer">
                    <span class="kk-badge" style="color:{{ $p['icon_color'] }};">
                        <span class="kk-dot" style="background:{{ $p['dot'] }};"></span>
                        Aktif
                    </span>
                    <span class="kk-laporan-count">
                        {{ \App\Models\Pengaduan::where('kategori', $item->nama_kategori)->count() }} laporan
                    </span>
                </div>

                {{-- Hidden form hapus --}}
                <form id="del-kat-{{ $item->id_kategori }}"
                      action="{{ route('kategori.destroy', $item->id_kategori) }}"
                      method="POST" style="display:none;">
                    @csrf
                    @method('DELETE')
                </form>

            </div>

            @empty

            <div class="kk-empty">
                <div class="kk-empty-icon"><i class="bi bi-folder-x"></i></div>
                <h4>Belum Ada Kategori</h4>
                <p>Tambahkan kategori baru untuk laporan siswa</p>
            </div>

            @endforelse

        </div>
    </div>

</div>

{{-- MODAL TAMBAH --}}
<div class="kk-overlay" id="tambahOverlay">
    <div class="kk-modal">
        <div class="kk-modal-head">
            <h5><i class="bi bi-plus-circle" style="color:#16a34a;margin-right:8px;"></i>Tambah Kategori</h5>
            <button class="kk-modal-close" onclick="closeTambah()">&times;</button>
        </div>
        <div class="kk-modal-body">
            <form action="{{ route('guru.kategori.store') }}" method="POST">
                @csrf
                <label class="kk-form-label">Nama Kategori</label>
                <input type="text" name="nama_kategori" class="kk-form-input"
                       placeholder="Contoh: Bullying, Fasilitas..." required>
                <div class="kk-modal-footer">
                    <button type="button" class="kk-btn-cancel" onclick="closeTambah()">Batal</button>
                    <button type="submit" class="kk-btn-save">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL EDIT --}}
<div class="kk-overlay" id="editOverlay">
    <div class="kk-modal">
        <div class="kk-modal-head">
            <h5><i class="bi bi-pencil-square" style="color:#16a34a;margin-right:8px;"></i>Edit Kategori</h5>
            <button class="kk-modal-close" onclick="closeEdit()">&times;</button>
        </div>
        <div class="kk-modal-body">
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <label class="kk-form-label">Nama Kategori</label>
                <input type="text" name="nama_kategori" id="editNama" class="kk-form-input" required>
                <div class="kk-modal-footer">
                    <button type="button" class="kk-btn-cancel" onclick="closeEdit()">Batal</button>
                    <button type="submit" class="kk-btn-save">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL HAPUS --}}
<div class="kk-overlay" id="deleteOverlay">
    <div class="kk-modal" style="max-width:360px;">
        <div class="kk-modal-body" style="text-align:center;padding:32px 28px;">
            <div class="kk-del-icon"><i class="bi bi-trash"></i></div>
            <h5 style="font-size:16px;font-weight:700;color:#111827;margin:0 0 8px;">Hapus Kategori?</h5>
            <p style="font-size:13px;color:#6b7280;margin:0 0 24px;line-height:1.6;">
                Kategori <strong id="deleteKatName"></strong> akan dihapus permanen.
            </p>
            <div class="kk-modal-footer">
                <button type="button" class="kk-btn-cancel" onclick="closeDelete()">Batal</button>
                <button type="button" class="kk-btn-del" id="confirmDeleteBtn">Hapus</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    /* =============================================
       DROPDOWN KEBAB MENU
    ============================================= */
    window.toggleMenu = function(id) {
        var all = document.querySelectorAll('.kk-dropdown');
        all.forEach(function(d) {
            if (d.id !== 'menu-' + id) d.classList.remove('open');
        });
        document.getElementById('menu-' + id).classList.toggle('open');
    };

    // Klik luar dropdown = tutup semua
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.kk-menu-wrap')) {
            document.querySelectorAll('.kk-dropdown').forEach(function(d) {
                d.classList.remove('open');
            });
        }
    });

    /* =============================================
       MODAL TAMBAH
    ============================================= */
    window.openTambah = function() {
        document.getElementById('tambahOverlay').classList.add('active');
    };

    window.closeTambah = function() {
        document.getElementById('tambahOverlay').classList.remove('active');
    };

    document.getElementById('tambahOverlay').addEventListener('click', function(e) {
        if (e.target === this) window.closeTambah();
    });

    /* =============================================
       MODAL EDIT
    ============================================= */
    window.openEdit = function(id, nama) {
        document.querySelectorAll('.kk-dropdown').forEach(function(d) { d.classList.remove('open'); });
        document.getElementById('editForm').action = '/kategori/update/' + id;
        document.getElementById('editNama').value  = nama;
        document.getElementById('editOverlay').classList.add('active');
    };

    window.closeEdit = function() {
        document.getElementById('editOverlay').classList.remove('active');
    };

    document.getElementById('editOverlay').addEventListener('click', function(e) {
        if (e.target === this) window.closeEdit();
    });

    /* =============================================
       MODAL HAPUS
    ============================================= */
    window.openDelete = function(id, nama) {
        document.querySelectorAll('.kk-dropdown').forEach(function(d) { d.classList.remove('open'); });
        document.getElementById('deleteKatName').textContent = nama;
        document.getElementById('confirmDeleteBtn').onclick = function() {
            document.getElementById('del-kat-' + id).submit();
        };
        document.getElementById('deleteOverlay').classList.add('active');
    };

    window.closeDelete = function() {
        document.getElementById('deleteOverlay').classList.remove('active');
    };

    document.getElementById('deleteOverlay').addEventListener('click', function(e) {
        if (e.target === this) window.closeDelete();
    });

    /* ESC tutup semua */
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            window.closeTambah();
            window.closeEdit();
            window.closeDelete();
        }
    });

});
</script>

@endsection