<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Menampilkan daftar user
    public function index()
    {
        $users = User::all();

        $title = 'Hapus User!';
        $text = "Apa kamu yakin ingin menghapus user ini?";
        confirmDelete($title, $text);
        return view('users.index', compact('users'));
    }

    // Menampilkan form untuk membuat user baru
    public function create()
    {
        return view('users.create');
    }

    // Menyimpan user baru ke database
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }    

        User::create($request->all());

        return redirect()->route('users.index')->withToastSuccess('User berhasil ditambahkan.');
    }


    // Menampilkan form untuk mengedit user
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // Mengupdate data user di database
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email,' . $user->id,
            'name' => 'required',
        ]);

        $user->update($request->all());
        return redirect()->route('users.index')->withToastSuccess('User berhasil diperbarui.');
    }

    // Menghapus user dari database
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->withToastSuccess('User berhasil dihapus');
    }
}

