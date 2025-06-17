<?php

namespace App\Http\Controllers;

use App\Mail\PembayaranShipped;
use App\Mail\PengajuanShipped;
use App\Models\Pembayaran;
use App\Models\Permohonan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayaran = Pembayaran::with('permohonan')->get();

        return view('pages.dashboard.pembayaran.index', compact('pembayaran'));
    }

    public function create()
    {
        $permohonan = Permohonan::all();

        return view('pages.dashboard.pembayaran.create', compact('permohonan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_permohonan' => 'required|exists:permohonan,id',
            'tgl_pembayaran' => 'required|date',
            'total_pembayaran' => 'required|integer|min:1'
        ]);

        $pembayaran = Pembayaran::create($validated);

        $permohonan = Permohonan::findOrFail($validated['id_permohonan']);
        $permohonan->id_pembayaran = $pembayaran->id;
        $permohonan->save();

        Mail::to('suanggawija@gmail.com')->send(new PembayaranShipped());

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil ditambahkan.');
    }

    public function show($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        return view('pages.dashboard.pembayaran.show', compact('pembayaran'));
    }

    public function edit($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $permohonan = Permohonan::all();
        return view('pages.dashboard.pembayaran.edit', compact('pembayaran', 'permohonan'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_permohonan' => 'required|exists:permohonan,id',
            'tgl_pembayaran' => 'required|date',
            'total_pembayaran' => 'required|integer|min:1'
        ]);

        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->update($validated);

        Mail::to('suanggawija@gmail.com')->send(new PembayaranShipped());
        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil di edit.');
    }

    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil di hapus.');
    }
}
