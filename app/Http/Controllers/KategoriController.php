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
    $request->validate([
        'nama_kategori' => 'required'
    ]);

    // Gunakan id_kategori sebagai primary key
    $kategori = \App\Models\Kategori::where('id_kategori', $id)->firstOrFail();
    $kategori->nama_kategori = $request->nama_kategori;
    $kategori->save();

    return redirect()->back()->with('success', 'Kategori berhasil diupdate');
}

    public function destroy($id)
    {
        Kategori::findOrFail($id)->delete();

        return back()->with('success', 'Kategori berhasil dihapus');
    }
}