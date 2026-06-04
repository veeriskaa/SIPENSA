<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
{
    $kategori = Kategori::all();

    return view('guru.kelola-kategori', compact('kategori'));
}

    public function store(Request $request)
{
    $request->validate([
        'nama_kategori' => 'required'
    ]);

    Kategori::create([
        'nama_kategori' => $request->nama_kategori
    ]);

    return redirect()->back()->with('success', 'Kategori berhasil ditambahkan');
}

    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);

        $kategori->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'warna' => $request->warna,
        ]);

        return back()->with('success', 'Kategori berhasil diupdate');
    }

    public function destroy($id)
    {
        Kategori::findOrFail($id)->delete();

        return back()->with('success', 'Kategori berhasil dihapus');
    }
}