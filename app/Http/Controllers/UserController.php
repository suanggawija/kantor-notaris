<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('pages.dashboard.user.index', ['user' => $user]);
    }

    public function create()
    {
        return view('pages.dashboard.user.create');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'nama_user' => 'required|string',
            'jabatan_user' => 'required|in:admin,user',
            'no_telp_user' => 'required|string|max:15',
            'alamat_user' => 'required|string',
            'foto_user' => 'nullable|file|mimes:jpeg,jpg,png'
        ]);

        if ($request->hasFile('foto_user')) {
            $file = $request->file('foto_user');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads/foto_user', $filename, 'public');
            $validate['foto_user'] = $path;
        }

        $validate['password'] = Hash::make($validate['password']);

        User::create($validate);

        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('pages.dashboard.user.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pages.dashboard.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable',
            'nama_user' => 'required|string',
            'jabatan_user' => 'required|in:admin,user',
            'no_telp_user' => 'required|string|max:15',
            'alamat_user' => 'required|string',
            'foto_user' => 'nullable|file|mimes:jpeg,jpg,png'
        ]);

        if ($request->hasFile('foto_user')) {
            $user = User::findOrFail($id);
            // Hapus file lama jika ada
            if ($user->foto_user && Storage::disk('public')->exists($user->foto_user)) {
                Storage::disk('public')->delete($user->foto_user);
            }

            $file = $request->file('foto_user');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads/foto_user', $filename, 'public');
            $validate['foto_user'] = $path;
        }

        if ($request->filled('password')) {
            $validate['password'] = Hash::make($request->password);
        } else {
            unset($validate['password']);
        }

        $user = User::findOrFail($id);
        $user->update($validate);

        return redirect()->route('user.index')->with('success', 'User berhasil di ubah.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')->with('success', 'User berhasil dihapus.');
    }
}
