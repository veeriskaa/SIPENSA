<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class GuruUserController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HALAMAN KELOLA USER
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $users = User::latest()->get();

        return view(
            'guru.kelola-user',
            compact('users')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN USER
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role'     => 'required'
        ]);

        $foto = null;

        if ($request->hasFile('foto')) {

            $foto = $request->file('foto')
                    ->store('foto-user', 'public');
        }

        User::create([

            'name'              => $request->name,
            'email'             => $request->email,
            'password'          => Hash::make($request->password),
            'role'              => $request->role,
            'foto'              => $foto,
            'email_verified_at' => now()

        ]);

        return redirect()
            ->back()
            ->with('success', 'User berhasil ditambahkan');
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE USER
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'  => 'required',
            'email' => 'required|email',
            'role'  => 'required'
        ]);

        $data = [

            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role

        ];

        if ($request->password) {

            $data['password'] =
                Hash::make($request->password);
        }

        if ($request->hasFile('foto')) {

            $data['foto'] = $request->file('foto')
                            ->store('foto-user', 'public');
        }

        $user->update($data);

        return redirect()
            ->back()
            ->with('success', 'User berhasil diupdate');
    }

    /*
    |--------------------------------------------------------------------------
    | HAPUS USER
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect()
            ->back()
            ->with('success', 'User berhasil dihapus');
    }
}