@extends('layouts.guru')

@section('title','Kelola User')

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

.ku * { box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }

.ku {
    display: flex; flex-direction: column;
    height: 100%; overflow: hidden;
    gap: 14px; animation: kuFade .35s ease both;
}

@keyframes kuFade {
    from { opacity:0; transform:translateY(8px); }
    to   { opacity:1; transform:translateY(0); }
}

.ku-header {
    flex-shrink: 0; background: #fff;
    border: 1px solid var(--border); border-radius: 18px;
    padding: 18px 22px; box-shadow: 0 2px 10px rgba(15,23,42,.04);
    display: flex; align-items: center;
    justify-content: space-between; gap: 14px; flex-wrap: wrap;
}

.ku-header-left { display: flex; align-items: center; gap: 14px; }

.ku-header-icon {
    width: 44px; height: 44px; border-radius: 13px;
    background: #f0fdf4; border: 1px solid #bbf7d0;
    color: var(--g1); display: flex; align-items: center;
    justify-content: center; font-size: 20px; flex-shrink: 0;
}

.ku-title { font-size: 18px; font-weight: 700; color: var(--text); margin: 0 0 2px; }
.ku-sub   { font-size: 12px; color: #9ca3af; margin: 0; }

.btn-add {
    display: inline-flex; align-items: center; gap: 8px;
    background: linear-gradient(135deg, var(--g1), var(--g2));
    color: white; text-decoration: none;
    padding: 10px 18px; border-radius: 12px;
    font-size: 13px; font-weight: 600;
    transition: .2s; white-space: nowrap;
    box-shadow: 0 3px 10px rgba(10,127,46,.2);
}
.btn-add:hover { transform: translateY(-1px); color: white; }

.ku-alert {
    flex-shrink: 0; display: flex; align-items: center; gap: 10px;
    padding: 12px 16px; border-radius: 14px;
    background: #f0fdf4; border: 1px solid #bbf7d0;
    color: #15803d; font-size: 13px; font-weight: 500;
}

.ku-filter {
    flex-shrink: 0; background: #fff;
    border: 1px solid var(--border); border-radius: 16px;
    padding: 14px 18px; box-shadow: 0 2px 8px rgba(15,23,42,.03);
    display: flex; align-items: center; gap: 10px; flex-wrap: wrap;
}

.ku-search {
    flex: 1; min-width: 180px; height: 40px; padding: 0 14px;
    border: 1.5px solid var(--border); border-radius: 11px;
    font-size: 13px; font-family: 'Plus Jakarta Sans', sans-serif;
    color: var(--text); background: #f9fafb; outline: none; transition: .2s;
}
.ku-search:focus { border-color: var(--g1); background: white; box-shadow: 0 0 0 3px rgba(10,127,46,.07); }
.ku-search::placeholder { color: #b0b8c1; }

.ku-select {
    height: 40px; padding: 0 32px 0 12px;
    border: 1.5px solid var(--border); border-radius: 11px;
    font-size: 13px; font-family: 'Plus Jakarta Sans', sans-serif;
    color: var(--text); background: #f9fafb; outline: none;
    cursor: pointer; transition: .2s; appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' fill='none'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%239ca3af' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
    background-repeat: no-repeat; background-position: right 12px center;
    min-width: 140px;
}
.ku-select:focus { border-color: var(--g1); background-color: white; }

.ku-count { font-size: 12px; color: #9ca3af; margin-left: auto; white-space: nowrap; }

.ku-table-card {
    flex: 1; min-height: 0; background: white;
    border: 1px solid var(--border); border-radius: 18px;
    overflow: hidden; box-shadow: 0 2px 10px rgba(15,23,42,.04);
    display: flex; flex-direction: column;
}

.ku-table-scroll {
    flex: 1; overflow-y: auto; overflow-x: auto;
    scrollbar-width: thin; scrollbar-color: #e5e7eb transparent;
}
.ku-table-scroll::-webkit-scrollbar { width: 5px; height: 5px; }
.ku-table-scroll::-webkit-scrollbar-thumb { background: #e5e7eb; border-radius: 99px; }

.ku-table { margin: 0; min-width: 640px; width: 100%; border-collapse: collapse; }

.ku-table thead th {
    position: sticky; top: 0; z-index: 5;
    background: #f9fafb; padding: 12px 16px;
    font-size: 11px; font-weight: 700; color: #9ca3af;
    text-transform: uppercase; letter-spacing: .5px;
    border: none; border-bottom: 1px solid #f3f4f6; white-space: nowrap;
}

.ku-table tbody td {
    padding: 14px 16px; border-top: 1px solid #f9fafb;
    font-size: 13px; vertical-align: middle; color: var(--text);
}

.ku-table tbody tr { transition: .15s; }
.ku-table tbody tr:hover { background: #fafcfa; }

.user-cell { display: flex; align-items: center; gap: 12px; }

.user-ava {
    width: 40px; height: 40px; border-radius: 12px;
    background: linear-gradient(135deg, var(--g1), var(--g2));
    color: white; font-size: 15px; font-weight: 700;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; overflow: hidden;
}
.user-ava img { width: 100%; height: 100%; object-fit: cover; }

.user-name { font-size: 13.5px; font-weight: 700; color: var(--text); margin: 0 0 1px; }
.user-id   { font-size: 11px; color: #9ca3af; }

.role-pill { display: inline-flex; align-items: center; gap: 5px; padding: 5px 11px; border-radius: 30px; font-size: 11px; font-weight: 700; }
.role-siswa { background: #dbeafe; color: #1d4ed8; }
.role-guru  { background: #fef3c7; color: #b45309; }

.status-pill {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 5px 11px; border-radius: 30px;
    font-size: 11px; font-weight: 700;
    background: #dcfce7; color: #15803d;
}
.status-dot { width: 6px; height: 6px; border-radius: 50%; background: #16a34a; animation: dotPulse 2s infinite; }
@keyframes dotPulse { 0%,100%{opacity:1;}50%{opacity:.4;} }

.action-cell { display: flex; align-items: center; justify-content: center; gap: 6px; }

.btn-edit-user {
    width: 34px; height: 34px; border-radius: 10px;
    border: 1px solid #e5e7eb; background: white;
    color: #6b7280; font-size: 14px; cursor: pointer;
    display: flex; align-items: center; justify-content: center; transition: .2s;
}
.btn-edit-user:hover { background: #f3f4f6; color: var(--text); border-color: #9ca3af; }

.btn-del-user {
    width: 34px; height: 34px; border-radius: 10px;
    border: 1px solid #fecaca; background: #fef2f2;
    color: #dc2626; font-size: 14px; cursor: pointer;
    display: flex; align-items: center; justify-content: center; transition: .2s;
}
.btn-del-user:hover { background: #ef4444; color: white; border-color: #ef4444; }

.ku-empty { text-align: center; padding: 60px 20px; color: #9ca3af; }
.ku-empty i { font-size: 32px; display: block; margin-bottom: 10px; color: #e5e7eb; }
.ku-empty p { font-size: 13px; margin: 0; }

/* OVERLAY MODAL */
.ku-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.5);
    z-index: 99999;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.ku-overlay.active { display: flex; }

.ku-modal {
    background: white;
    border-radius: 20px;
    width: 100%;
    max-width: 460px;
    overflow: hidden;
    box-shadow: 0 24px 64px rgba(0,0,0,.25);
    animation: modalIn .2s ease both;
}

@keyframes modalIn {
    from { opacity:0; transform:scale(.96) translateY(10px); }
    to   { opacity:1; transform:scale(1) translateY(0); }
}

.ku-modal-head {
    background: #f9fafb;
    border-bottom: 1px solid #f3f4f6;
    padding: 18px 22px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.ku-modal-head h5 {
    font-size: 15px; font-weight: 700; color: #111827; margin: 0;
}

.ku-modal-close {
    background: none; border: none;
    font-size: 22px; color: #9ca3af;
    cursor: pointer; line-height: 1; padding: 0;
    transition: .2s;
}
.ku-modal-close:hover { color: #374151; }

.ku-modal-body { padding: 22px; }

.ku-form-group { margin-bottom: 14px; }
.ku-form-group:last-of-type { margin-bottom: 20px; }

.ku-label {
    font-size: 12px; font-weight: 600; color: #374151;
    display: block; margin-bottom: 6px;
}

.ku-label span { color: #9ca3af; font-weight: 400; }

.ku-input, .ku-select-input {
    width: 100%; height: 42px;
    border: 1.5px solid #e5e7eb; border-radius: 11px;
    padding: 0 14px; font-size: 13px; outline: none;
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: #f9fafb; color: #111827; transition: .2s;
    box-sizing: border-box;
}

.ku-input:focus, .ku-select-input:focus {
    border-color: var(--g1); background: white;
    box-shadow: 0 0 0 3px rgba(10,127,46,.07);
}

.ku-select-input { appearance: none; cursor: pointer; }

.ku-modal-footer { display: flex; gap: 10px; }

.ku-btn-cancel {
    flex: 1; height: 42px; border-radius: 11px;
    border: 1.5px solid #e5e7eb; background: white;
    font-size: 13px; font-weight: 600;
    font-family: 'Plus Jakarta Sans', sans-serif;
    cursor: pointer; transition: .2s;
}
.ku-btn-cancel:hover { background: #f9fafb; }

.ku-btn-save {
    flex: 1; height: 42px; border-radius: 11px; border: none;
    background: linear-gradient(135deg, var(--g1), var(--g2));
    color: white; font-size: 13px; font-weight: 700;
    font-family: 'Plus Jakarta Sans', sans-serif;
    cursor: pointer; transition: .2s;
    box-shadow: 0 3px 10px rgba(10,127,46,.2);
}
.ku-btn-save:hover { box-shadow: 0 6px 16px rgba(10,127,46,.3); }

.ku-btn-del {
    flex: 1; height: 42px; border-radius: 11px; border: none;
    background: #ef4444; color: white;
    font-size: 13px; font-weight: 700;
    font-family: 'Plus Jakarta Sans', sans-serif;
    cursor: pointer; transition: .2s;
}
.ku-btn-del:hover { background: #dc2626; }

@media (max-width: 768px) {
    .ku { gap: 12px; }
    .ku-header { padding: 14px 16px; border-radius: 14px; }
    .ku-header-icon { width: 38px; height: 38px; font-size: 17px; }
    .ku-title { font-size: 16px; }
    .btn-add { width: 100%; justify-content: center; }
    .ku-filter { flex-direction: column; align-items: stretch; }
    .ku-search, .ku-select { width: 100%; }
    .ku-count { margin-left: 0; }
}

</style>

<div class="ku">

    {{-- HEADER --}}
    <div class="ku-header">
        <div class="ku-header-left">
            <div class="ku-header-icon">
                <i class="bi bi-people-fill"></i>
            </div>
            <div>
                <h3 class="ku-title">Kelola Akun Pengguna</h3>
                <p class="ku-sub">Manajemen data siswa & Guru BK sistem SIPENSA</p>
            </div>
        </div>
        <a href="/tambah-user" class="btn-add">
            <i class="bi bi-plus-lg"></i>
            Tambah User
        </a>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
    <div class="ku-alert">
        <i class="bi bi-check-circle-fill"></i>
        {{ session('success') }}
    </div>
    @endif

    {{-- FILTER --}}
    <div class="ku-filter">
        <input type="text" id="searchInput" class="ku-search"
               placeholder="🔍 Cari nama atau email...">
        <select id="roleFilter" class="ku-select">
            <option value="">Semua Role</option>
            <option value="siswa">Siswa</option>
            <option value="guru_bk">Guru BK</option>
        </select>
        <span class="ku-count" id="userCount">{{ count($users) }} pengguna</span>
    </div>

    {{-- TABLE --}}
    <div class="ku-table-card">
        <div class="ku-table-scroll">
            <table class="ku-table">
                <thead>
                    <tr>
                        <th>Pengguna</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th style="text-align:center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="userTable">

                @forelse($users as $user)
                <tr data-name="{{ strtolower($user->name) }}"
                    data-email="{{ strtolower($user->email) }}"
                    data-role="{{ $user->role }}">
                    <td>
                        <div class="user-cell">
                            <div class="user-ava">
                                @if($user->foto)
                                    <img src="{{ asset('storage/'.$user->foto) }}" alt="">
                                @else
                                    {{ strtoupper(substr($user->name,0,1)) }}
                                @endif
                            </div>
                            <div>
                                <p class="user-name">{{ $user->name }}</p>
                                <p class="user-id">ID #{{ $user->id }}</p>
                            </div>
                        </div>
                    </td>
                    <td style="color:#6b7280">{{ $user->email }}</td>
                    <td>
                        <span class="role-pill {{ $user->role == 'guru_bk' ? 'role-guru' : 'role-siswa' }}">
                            @if($user->role == 'guru_bk')
                                <i class="bi bi-mortarboard-fill"></i> Guru BK
                            @else
                                <i class="bi bi-person-fill"></i> Siswa
                            @endif
                        </span>
                    </td>
                    <td>
                        <span class="status-pill">
                            <span class="status-dot"></span> Aktif
                        </span>
                    </td>
                    <td>
                        <div class="action-cell">
                            <button class="btn-edit-user" title="Edit"
                                onclick="openEdit({{ $user->id }}, '{{ addslashes($user->name) }}', '{{ addslashes($user->email) }}', '{{ $user->role }}')">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn-del-user" title="Hapus"
                                onclick="openDelete({{ $user->id }}, '{{ addslashes($user->name) }}')">
                                <i class="bi bi-trash"></i>
                            </button>
                            <form id="del-{{ $user->id }}" action="/kelola-user/delete/{{ $user->id }}" method="POST" style="display:none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">
                        <div class="ku-empty">
                            <i class="bi bi-people"></i>
                            <p>Belum ada pengguna terdaftar</p>
                        </div>
                    </td>
                </tr>
                @endforelse

                </tbody>
            </table>
        </div>
    </div>

</div>

{{-- MODAL EDIT --}}
<div class="ku-overlay" id="editOverlay">
    <div class="ku-modal">
        <div class="ku-modal-head">
            <h5><i class="bi bi-pencil-square" style="color:#16a34a;margin-right:8px;"></i>Edit Pengguna</h5>
            <button class="ku-modal-close" onclick="closeEdit()">&times;</button>
        </div>
        <div class="ku-modal-body">
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="ku-form-group">
                    <label class="ku-label">Nama Lengkap</label>
                    <input type="text" name="name" id="editName" class="ku-input" required>
                </div>
                <div class="ku-form-group">
                    <label class="ku-label">Email</label>
                    <input type="email" name="email" id="editEmail" class="ku-input" required>
                </div>
                <div class="ku-form-group">
                    <label class="ku-label">Role</label>
                    <select name="role" id="editRole" class="ku-select-input">
                        <option value="siswa">Siswa</option>
                        <option value="guru_bk">Guru BK</option>
                    </select>
                </div>
                <div class="ku-form-group">
                    <label class="ku-label">Password Baru <span>(kosongkan jika tidak diubah)</span></label>
                    <input type="password" name="password" id="editPassword" class="ku-input" placeholder="Min. 6 karakter">
                </div>
                <div class="ku-modal-footer">
                    <button type="button" class="ku-btn-cancel" onclick="closeEdit()">Batal</button>
                    <button type="submit" class="ku-btn-save">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL HAPUS --}}
<div class="ku-overlay" id="deleteOverlay">
    <div class="ku-modal" style="max-width:360px;">
        <div class="ku-modal-body" style="text-align:center;padding:32px 28px;">
            <div style="width:58px;height:58px;border-radius:50%;background:#fef2f2;border:1px solid #fecaca;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:26px;color:#dc2626;">
                <i class="bi bi-trash"></i>
            </div>
            <h5 style="font-size:16px;font-weight:700;color:#111827;margin:0 0 8px;">Hapus Pengguna?</h5>
            <p style="font-size:13px;color:#6b7280;margin:0 0 24px;line-height:1.6;">
                Akun <strong id="deleteUserName"></strong> akan dihapus permanen.
            </p>
            <div class="ku-modal-footer">
                <button type="button" class="ku-btn-cancel" onclick="closeDelete()">Batal</button>
                <button type="button" class="ku-btn-del" id="confirmDeleteBtn">Hapus</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    /* SEARCH & FILTER */
    var searchInput = document.getElementById('searchInput');
    var roleFilter  = document.getElementById('roleFilter');
    var userCount   = document.getElementById('userCount');

    function filterTable() {
        var q    = searchInput.value.toLowerCase();
        var role = roleFilter.value;
        var rows = document.querySelectorAll('#userTable tr[data-name]');
        var n    = 0;
        rows.forEach(function(row) {
            var ok = (row.dataset.name.includes(q) || row.dataset.email.includes(q))
                  && (!role || row.dataset.role === role);
            row.style.display = ok ? '' : 'none';
            if (ok) n++;
        });
        userCount.textContent = n + ' pengguna';
    }

    searchInput.addEventListener('input', filterTable);
    roleFilter.addEventListener('change', filterTable);

    /* EDIT */
    window.openEdit = function(id, name, email, role) {
        document.getElementById('editForm').action = '/kelola-user/update/' + id;
        document.getElementById('editName').value   = name;
        document.getElementById('editEmail').value  = email;
        document.getElementById('editRole').value   = role;
        document.getElementById('editPassword').value = '';
        document.getElementById('editOverlay').classList.add('active');
    };

    window.closeEdit = function() {
        document.getElementById('editOverlay').classList.remove('active');
    };

    document.getElementById('editOverlay').addEventListener('click', function(e) {
        if (e.target === this) window.closeEdit();
    });

    /* DELETE */
    window.openDelete = function(id, name) {
        document.getElementById('deleteUserName').textContent = name;
        document.getElementById('confirmDeleteBtn').onclick = function() {
            document.getElementById('del-' + id).submit();
        };
        document.getElementById('deleteOverlay').classList.add('active');
    };

    window.closeDelete = function() {
        document.getElementById('deleteOverlay').classList.remove('active');
    };

    document.getElementById('deleteOverlay').addEventListener('click', function(e) {
        if (e.target === this) window.closeDelete();
    });

    /* ESC */
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') { window.closeEdit(); window.closeDelete(); }
    });

});
</script>

@endsection