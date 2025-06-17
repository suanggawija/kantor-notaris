<?php

namespace App\Http\Controllers;

use App\Models\Klien;
use Illuminate\Http\Request;

class KlienController extends Controller
{
    public function index()
    {
        $klien = Klien::all();

        return view('pages.dashboard.klien.index', ['klien' => $klien]);
    }

    public function create()
    {
        return view('pages.dashboard.klien.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_klien' => 'required|string',
            'email_klien' => 'required|email|unique:klien,email_klien',
            'no_telp_klien' => 'required|string|max:13|min:10',
            'alamat_klien' => 'required|string',
            'nik_klien' => 'required|max:16|min:16|unique:klien,nik_klien'
        ]);

        Klien::create($validated);

        return redirect()->route('klien.index')->with('success', 'Klien berhasil di tambah.');
    }

    public function show($id)
    {
        $klien = Klien::findOrFail($id);

        return view('pages.dashboard.klien.show', ['klien' => $klien]);
    }

    public function edit($id)
    {
        $klien = Klien::findOrFail($id);

        return view('pages.dashboard.klien.edit', ['klien' => $klien]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_klien' => 'required|string',
            'email_klien' => 'required|email|unique:klien,email_klien,' . $id,
            'no_telp_klien' => 'required|string|max:13|min:10',
            'alamat_klien' => 'required|string',
            'nik_klien' => 'required|max:16|min:16|unique:klien,nik_klien,' . $id,
        ]);

        $klien = Klien::findOrFail($id);

        $klien->update($validated);
        return redirect()->route('klien.index')->with('success', 'Klien berhasil di ubah.');
    }

    public function destroy($id)
    {
        $klien = Klien::findOrFail($id);
        $klien->delete();
        return redirect()->route('klien.index')->with('success', 'Klien berhasil di hapus.');
    }
}
