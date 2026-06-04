<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    // HALAMAN NOTIFIKASI
    public function index()
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        $notifs = Notifikasi::where('user_id', auth()->id())
                    ->latest()
                    ->get();

        return view('notifikasi', compact('notifs'));
    }

    // DROPDOWN LONCENG
    public function getNotif()
    {
        if (!auth()->check()) {
            return response()->json([
                'data' => [],
                'jumlah' => 0
            ]);
        }

        $notif = Notifikasi::where('user_id', auth()->id())
                    ->latest()
                    ->take(5)
                    ->get();

        $jumlah = Notifikasi::where('user_id', auth()->id())
                    ->where('is_read', false)
                    ->count();

        return response()->json([
            'data' => $notif,
            'jumlah' => $jumlah
        ]);
    }

    // DASHBOARD
    public function notifDashboard()
    {
        if (!auth()->check()) {
            return response()->json([]);
        }

        $notif = Notifikasi::where('user_id', auth()->id())
                    ->latest()
                    ->take(3)
                    ->get(['pesan', 'status']);

        return response()->json($notif);
    }

    // BADGE ANGKA
    public function count()
    {
        if (!auth()->check()) {
            return response()->json(['total' => 0]);
        }

        $jumlah = Notifikasi::where('user_id', auth()->id())
                    ->where('is_read', false)
                    ->count();

        return response()->json([
            'total' => $jumlah
        ]);
    }

    // ✅ SATU SAJA (HAPUS readAll)
    public function markAsRead(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['status' => 'unauthorized'], 401);
        }

        Notifikasi::where('user_id', auth()->id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json(['status' => 'ok']);
    }
}