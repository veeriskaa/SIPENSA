<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function uploadFoto(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $path = $request->file('foto')->store('foto-user', 'public');

        User::where('id', auth()->id())->update([
            'foto' => $path
        ]);

        return back()->with('success', 'Foto berhasil diupload');
    }
}