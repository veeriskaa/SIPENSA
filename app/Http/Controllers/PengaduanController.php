<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Notifikasi;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | SISWA
    |--------------------------------------------------------------------------
    */

    // HALAMAN LAPORAN SAYA
    public function laporanSaya(Request $request)
    {

        $query = Pengaduan::with('user')
                ->where('user_id', auth()->id());

        // FILTER STATUS
        if($request->status && $request->status != 'semua'){

            $query->where(
                'status',
                $request->status
            );

        }

        $laporans = $query->latest()->get();

        return view(
            'siswa.laporan_saya',
            compact('laporans')
        );
    }

    // FORM BUAT LAPORAN
    public function create()
    {
        return view('siswa.buat-laporan');
    }

    // SIMPAN LAPORAN
    public function store(Request $request)
    {
        $request->validate([

            'kategori'  => 'required',
            'judul'     => 'required',
            'deskripsi' => 'required',
            'lokasi'    => 'required',
            'waktu'     => 'required',

            'bukti'     =>
                'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120'

        ]);

        $file = null;

        // UPLOAD FILE
        if($request->hasFile('bukti')){

            $file = $request->file('bukti')
                    ->store('bukti', 'public');

        }

        // SIMPAN PENGADUAN
        $pengaduan = Pengaduan::create([

            'user_id'   => auth()->id(),
            'kategori'  => $request->kategori,
            'judul'     => $request->judul,
            'deskripsi' => $request->deskripsi,
            'lokasi'    => $request->lokasi,
            'waktu'     => $request->waktu,
            'bukti'     => $file,
            'status'    => 'pending'

        ]);

        // NOTIFIKASI
        Notifikasi::create([

            'user_id' => auth()->id(),
            'judul'   => 'Laporan Baru',
            'pesan'   => $pengaduan->judul,
            'tipe'    => 'laporan',
            'is_read' => false

        ]);

        return redirect('/siswa')
            ->with(
                'success',
                'Laporan berhasil dikirim!'
            );
    }

    // REALTIME LAPORAN TERBARU
    public function getTerbaru()
    {
        $data = Pengaduan::with('user')
                ->where('user_id', auth()->id())
                ->latest()
                ->take(5)
                ->get();

        return response()->json($data);
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL LAPORAN
    |--------------------------------------------------------------------------
    */

    public function show(int $id)
    {
        $pengaduan = Pengaduan::with('user')
                    ->findOrFail($id);

        // SISWA
        if(auth()->user()->role == 'siswa'){

            if($pengaduan->user_id != auth()->id()){

                abort(403);

            }

            return view(
                'siswa.detail-laporan',
                compact('pengaduan')
            );
        }

        // GURU
        return view(
            'guru.detail-laporan',
            compact('pengaduan')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | GURU BK
    |--------------------------------------------------------------------------
    */

    // HALAMAN RESPON
    public function responIndex()
    {
        $laporan = Pengaduan::with('user')
                    ->whereNotNull('tanggapan')
                    ->latest()
                    ->get();

        return view(
            'guru.respon-index',
            compact('laporan')
        );
    }

    // FORM TANGGAPAN
    public function edit(int $id)
    {
        $pengaduan = Pengaduan::with('user')
                    ->findOrFail($id);

        return view(
            'guru.tanggapi-laporan',
            compact('pengaduan')
        );
    }

    // SIMPAN RESPON
    public function storeRespon(Request $request, int $id)
    {
        $request->validate([

            'tanggapan' => 'required',
            'status'    => 'required'

        ]);

        $pengaduan = Pengaduan::findOrFail($id);

        $pengaduan->update([

            'tanggapan' => $request->tanggapan,
            'status'    => $request->status

        ]);

        return redirect('/guru/laporan')
            ->with(
                'success',
                'Tanggapan berhasil dikirim'
            );
    }

    // UPDATE STATUS
    public function updateStatus(Request $request, int $id)
    {
        $request->validate([

            'status' => 'required'

        ]);

        $pengaduan = Pengaduan::findOrFail($id);

        $pengaduan->update([

            'status' => $request->status

        ]);

        return redirect('/guru/laporan')
            ->with(
                'success',
                'Status berhasil diperbarui'
            );
    }

    // HAPUS LAPORAN
    public function destroy(int $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        // HAPUS FILE
        if($pengaduan->bukti){

            Storage::disk('public')
                ->delete($pengaduan->bukti);

        }

        $pengaduan->delete();

        return redirect('/guru/laporan')
            ->with(
                'success',
                'Laporan berhasil dihapus'
            );
    }
}