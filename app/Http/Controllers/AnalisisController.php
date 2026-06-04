<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Kategori;
use Barryvdh\DomPDF\Facade\Pdf;

class AnalisisController extends Controller
{
    public function index()
    {
        // TOTAL LAPORAN
        $totalLaporan = Pengaduan::count();

        // STATUS
        $selesai = Pengaduan::where('status', 'selesai')->count();

        $diproses = Pengaduan::where('status', 'diproses')->count();

        $pending = Pengaduan::where('status', 'pending')->count();

        // KATEGORI TERBANYAK
        $kategoriTerbanyak = Kategori::withCount('pengaduan')
            ->orderBy('pengaduan_count', 'desc')
            ->first();

        // LAPORAN TERBARU
        $laporanTerbaru = Pengaduan::take(5)->get();

        return view('guru.analisis', compact(
            'totalLaporan',
            'selesai',
            'diproses',
            'pending',
            'kategoriTerbanyak',
            'laporanTerbaru'
        ));
    }

    public function exportPdf()
{
    $totalLaporan = Pengaduan::count();

    $selesai = Pengaduan::where('status', 'selesai')->count();

    $diproses = Pengaduan::where('status', 'diproses')->count();

    $pending = Pengaduan::where('status', 'pending')->count();

    $kategoriTerbanyak = Kategori::withCount('pengaduan')
        ->orderBy('pengaduan_count', 'desc')
        ->first();

    $laporanTerbaru = Pengaduan::latest()
        ->take(10)
        ->get();

    $pdf = Pdf::loadView('guru.analisis-pdf', compact(
        'totalLaporan',
        'selesai',
        'diproses',
        'pending',
        'kategoriTerbanyak',
        'laporanTerbaru'
    ));

    return $pdf->download('laporan-analisis.pdf');
}
}