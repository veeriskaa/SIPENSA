<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Notifikasi;

class SiswaDashboardController extends Controller
{
    // HALAMAN DASHBOARD SISWA
    public function index()
    {
        $total = Pengaduan::where('user_id', auth()->id())->count();

        $proses = Pengaduan::where('user_id', auth()->id())
                    ->where('status', 'proses')
                    ->count();

        $selesai = Pengaduan::where('user_id', auth()->id())
                    ->where('status', 'selesai')
                    ->count();

        $pending = Pengaduan::where('user_id', auth()->id())
                    ->where('status', 'pending')
                    ->count();

        $laporan = Pengaduan::where('user_id', auth()->id())
                    ->latest()
                    ->take(5)
                    ->get();

        $notif = Notifikasi::latest()
                    ->take(5)
                    ->get();

        return view('siswa.dashboard', compact(
            'total',
            'proses',
            'selesai',
            'pending',
            'laporan',
            'notif'
        ));
    }

    // REALTIME AJAX
    public function realtime()
    {
        return response()->json([

            'total' => Pengaduan::where(
                'user_id',
                auth()->id()
            )->count(),

            'proses' => Pengaduan::where(
                'user_id',
                auth()->id()
            )->where(
                'status',
                'proses'
            )->count(),

            'selesai' => Pengaduan::where(
                'user_id',
                auth()->id()
            )->where(
                'status',
                'selesai'
            )->count(),

            'pending' => Pengaduan::where(
                'user_id',
                auth()->id()
            )->where(
                'status',
                'pending'
            )->count(),

            'laporan' => Pengaduan::where(
                'user_id',
                auth()->id()
            )->latest()->take(5)->get(),

            'notif' => Notifikasi::latest()
                        ->take(5)
                        ->get()
        ]);
    }
}