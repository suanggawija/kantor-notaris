<?php

namespace App\Http\Controllers;

use App\Models\Rak;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class RakController extends Controller
{
    public function index()
    {
        $rak = Rak::all();
        return view('pages.dashboard.rak.index', ['rak' => $rak]);
    }

    public function create()
    {
        return view('pages.dashboard.rak.create');
    }

    public function store(Request $request)
    {
        $messages = [
            'kode_rak.required' => 'Kode rak wajib diisi.',
            'kode_rak.unique' => 'Kode rak sudah digunakan.',
            'nama_rak.required' => 'Nama rak wajib diisi.',
            'lokasi_rak.required' => 'Lokasi rak wajib diisi.',
        ];

        $validate = $request->validate([
            'kode_rak' => 'required|string|unique:rak,kode_rak,',
            'nama_rak' => 'required|string',
            'lokasi_rak' => 'required|string',
        ], $messages);

        $rak = Rak::create($validate);

        return redirect()->route('rak.index')->with('success', 'Rak berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $rak = Rak::findOrFail($id);

        return view('pages.dashboard.rak.edit', ['rak' => $rak]);
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'kode_rak.required' => 'Kode rak wajib diisi.',
            'kode_rak.unique' => 'Kode rak sudah digunakan.',
            'nama_rak.required' => 'Nama rak wajib diisi.',
            'lokasi_rak.required' => 'Lokasi rak wajib diisi.',
        ];

        $validate = $request->validate([
            'kode_rak' => 'required|string|unique:rak,kode_rak,' . $id,
            'nama_rak' => 'required|string',
            'lokasi_rak' => 'required|string',
        ], $messages);

        $rak = Rak::findOrFail($id);

        $rak->update($validate);

        return redirect()->route('rak.index')->with('success', 'Rak berhasil di ubah.');
    }


    public function destroy($id)
    {
        $rak = Rak::findOrFail($id);
        $rak->delete();

        return redirect()->route('rak.index')->with('success', 'Rak berhasil dihapus.');
    }
}
