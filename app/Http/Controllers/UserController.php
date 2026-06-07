<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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

    public function gantiPassword(Request $request)
{
    $request->validate([
        'password_lama'         => 'required',
        'password'              => 'required|min:8|confirmed',
        'password_confirmation' => 'required',
    ], [
        'password_lama.required'         => 'Password lama wajib diisi.',
        'password.required'              => 'Password baru wajib diisi.',
        'password.min'                   => 'Password baru minimal 8 karakter.',
        'password.confirmed'             => 'Konfirmasi password tidak cocok.',
        'password_confirmation.required' => 'Konfirmasi password wajib diisi.',
    ]);

    // Cek password lama
    if (!Hash::check($request->password_lama, auth()->user()->password)) {
        return back()
            ->withErrors(['password_lama' => 'Password lama tidak sesuai.'])
            ->with('error', 'Password lama tidak sesuai.');
    }

    $user = User::find(auth()->id());

$user->update([
    'password' => Hash::make($request->password),
]);
    return back()->with([
        'success'      => 'Password berhasil diperbarui!',
        'success_type' => 'password',
    ]);
}
}