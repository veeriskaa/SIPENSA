<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Notifikasi;

class GuruDashboardController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DASHBOARD GURU
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        // TOTAL LAPORAN
        $totalLaporan = Pengaduan::count();

        // STATUS LAPORAN
        $proses = Pengaduan::where('status', 'proses')->count();

        $selesai = Pengaduan::where('status', 'selesai')->count();

        $pending = Pengaduan::where('status', 'pending')->count();

        // NOTIFIKASI
        $notif = Notifikasi::latest()
                    ->take(5)
                    ->get();

        // LAPORAN TERBARU
        $laporanTerbaru = Pengaduan::with('user')
                            ->latest()
                            ->take(5)
                            ->get();

        return view('guru.dashboard', compact(
            'totalLaporan',
            'proses',
            'selesai',
            'pending',
            'notif',
            'laporanTerbaru'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | REALTIME AJAX
    |--------------------------------------------------------------------------
    */
    public function realtime()
{
    /*
    |--------------------------------------------------------------------------
    | STATISTIK MINGGUAN
    |--------------------------------------------------------------------------
    */

    $mingguan = [];

    for ($i = 6; $i >= 0; $i--) {

        $mingguan[] = Pengaduan::whereDate(
            'created_at',
            now()->subDays($i)->toDateString()
        )->count();
    }

    /*
    |--------------------------------------------------------------------------
    | RESPONSE JSON
    |--------------------------------------------------------------------------
    */

    return response()->json([

        // CARD
        'total' => Pengaduan::count(),

        'proses' => Pengaduan::where(
            'status',
            'proses'
        )->count(),

        'selesai' => Pengaduan::where(
            'status',
            'selesai'
        )->count(),

        'pending' => Pengaduan::where(
            'status',
            'pending'
        )->count(),

        // KATEGORI CHART
        'bullying' => Pengaduan::where(
            'kategori',
            'Bullying'
        )->count(),

        'fasilitas' => Pengaduan::where(
            'kategori',
            'Fasilitas'
        )->count(),

        'akademik' => Pengaduan::where(
            'kategori',
            'Akademik'
        )->count(),

        // LINE CHART
        'mingguan' => $mingguan,

        // TABLE
        'laporan' => Pengaduan::with('user')
                        ->latest()
                        ->take(5)
                        ->get()
    ]);
}

    /*
    |--------------------------------------------------------------------------
    | KELOLA LAPORAN
    |--------------------------------------------------------------------------
    */
    public function kelolaLaporan(Request $request)
{
    $query = Pengaduan::with('user');

    /*
    |--------------------------------------------------------------------------
    | FILTER KATEGORI
    |--------------------------------------------------------------------------
    */
    if ($request->kategori) {

        $query->where(
            'kategori',
            $request->kategori
        );
    }

    /*
    |--------------------------------------------------------------------------
    | FILTER STATUS
    |--------------------------------------------------------------------------
    */
    if ($request->status) {

        $query->where(
            'status',
            $request->status
        );
    }

    /*
    |--------------------------------------------------------------------------
    | SEARCH LAPORAN
    |--------------------------------------------------------------------------
    */
    if ($request->search) {

        $query->where(function($q) use ($request){

            $q->where(
                'judul',
                'like',
                '%' . $request->search . '%'
            )

            ->orWhere(
                'deskripsi',
                'like',
                '%' . $request->search . '%'
            );

        });
    }

    /*
    |--------------------------------------------------------------------------
    | LAPORAN TERBARU PALING ATAS
    |--------------------------------------------------------------------------
    */
    $laporan = $query->latest()->get();

    return view(
        'guru.kelola-laporan',
        compact('laporan')
    );
}

    /*
    |--------------------------------------------------------------------------
    | HALAMAN RESPON / TANGGAPI
    |--------------------------------------------------------------------------
    */
    public function respon($id)
    {
        $pengaduan = Pengaduan::with('user')
                        ->findOrFail($id);

        return view(
            'guru.tanggapi-laporan',
            compact('pengaduan')
        );
    }
}