<?php

namespace App\Http\Controllers;

use App\Mail\PengajuanShipped;
use App\Mail\PermohonanShipped;
use App\Models\Klien;
use App\Models\Permohonan;
use App\Models\Rak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PermohonanController extends Controller
{
    public function index()
    {
        $permohonan = Permohonan::all();
        $countPermohonanStatusDataBerkasKurang = Permohonan::where('status_permohonan', 'data berkas kurang')->count();
        $countPermohonanStatusDiproses = Permohonan::where('status_permohonan', 'akan diproses')
            ->orWhere('status_permohonan', 'sedang diproses')
            ->count();
        $countPermohonanStatusDiterima = Permohonan::where('status_permohonan', 'diterima')->count();
        $countPermohonanStatusDitolak = Permohonan::where('status_permohonan', 'ditolak')->count();

        return view('pages.dashboard.permohonan.index', compact('permohonan', 'countPermohonanStatusDataBerkasKurang', 'countPermohonanStatusDiproses', 'countPermohonanStatusDiterima', 'countPermohonanStatusDitolak'));
    }

    public function create()
    {
        $rak = Rak::all();
        $klien = Klien::all();
        return view('pages.dashboard.permohonan.create', ['rak' => $rak, 'klien' => $klien]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_rak' => 'required|exists:rak,id',
            'id_klien' => 'required|exists:klien,id',
            'tanggal_pengajuan' => 'required|date',
            'jenis_permohonan' => 'required|in:jual beli,hibah,hak tanggungan,waris',
            'status_permohonan' => 'required',
            // file fields (semua nullable, file, dan image)
            'ktp' => 'nullable|file|mimes:jpeg,jpg,png,pdf',
            'kk' => 'nullable|file|mimes:jpeg,jpg,png,pdf',
            'npwp' => 'nullable|file|mimes:jpeg,jpg,png,pdf',
            'akta_nikah' => 'nullable|file|mimes:jpeg,jpg,png,pdf',
            'sertifikat_tanah' => 'nullable|file|mimes:jpeg,jpg,png,pdf',
            'sppt_pbb' => 'nullable|file|mimes:jpeg,jpg,png,pdf',
            'imb' => 'nullable|file|mimes:jpeg,jpg,png,pdf',
            'sspd_bpthb' => 'nullable|file|mimes:jpeg,jpg,png,pdf',
            'pph' => 'nullable|file|mimes:jpeg,jpg,png,pdf',
            'silsilah_waris' => 'nullable|file|mimes:jpeg,jpg,png,pdf',
            'pernyataan_waris' => 'nullable|file|mimes:jpeg,jpg,png,pdf',
            'akta_kematian' => 'nullable|file|mimes:jpeg,jpg,png,pdf',
            'keterangan_permohonan' => 'required|string',
        ]);

        // handle file upload
        $fileFields = [
            'ktp',
            'kk',
            'npwp',
            'akta_nikah',
            'sertifikat_tanah',
            'sppt_pbb',
            'imb',
            'sspd_bpthb',
            'pph',
            'silsilah_waris',
            'pernyataan_waris',
            'akta_kematian',
        ];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = $field . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('uploads/permohonan', $filename, 'public');
                // kolom di DB: ganti '-' jadi '_' agar sesuai migration
                $validated[str_replace('-', '_', $field)] = $path;

                // Tambahkan log untuk memastikan file terupload
                Log::info("File uploaded for field: $field, path: $path");
            } else {
                // Tambahkan log jika file tidak ada
                Log::info("No file uploaded for field: $field");
            }
        }

        Permohonan::create([
            'id_rak' => $validated['id_rak'],
            'id_klien' => $validated['id_klien'],
            'tanggal_pengajuan' => $validated['tanggal_pengajuan'],
            'jenis_permohonan' => $validated['jenis_permohonan'],
            'status_permohonan' => $validated['status_permohonan'],
            // file fields
            'ktp' => $validated['ktp'] ?? null,
            'kk' => $validated['kk'] ?? null,
            'npwp' => $validated['npwp'] ?? null,
            'akta_nikah' => $validated['akta_nikah'] ?? ($validated['akta_nikah'] ?? null),
            'sertifikat_tanah' => $validated['sertifikat_tanah'] ?? null,
            'sppt_pbb' => $validated['sppt_pbb'] ?? null,
            'imb' => $validated['imb'] ?? null,
            'sspd_bphtb' => $validated['sspd_bpthb'] ?? null,
            'pph' => $validated['pph'] ?? null,
            'silsilah_waris' => $validated['silsilah_waris'] ?? null,
            'pernyataan_waris' => $validated['pernyataan_waris'] ?? null,
            'akta_kematian' => $validated['akta_kematian'] ?? null,
            'keterangan_permohonan' => $validated['keterangan_permohonan'],
        ]);

        // Kirim Email Saat Create
        Mail::to('suanggawija@gmail.com')->send(new PengajuanShipped);

        return redirect()->route('permohonan.index')->with('success', 'Permohonan berhasil ditambahkan.');
    }

    public function show($id)
    {
        $permohonan = Permohonan::findOrFail($id);
        $rak = Rak::all();
        $klien = Klien::all();
        return view('pages.dashboard.permohonan.show', ['permohonan' => $permohonan, 'rak' => $rak, 'klien' => $klien]);
    }

    public function edit($id)
    {
        $permohonan = Permohonan::findOrFail($id);
        $rak = Rak::all();
        $klien = Klien::all();
        return view('pages.dashboard.permohonan.edit', ['permohonan' => $permohonan, 'rak' => $rak, 'klien' => $klien]);
    }

    public function update(Request $request, $id)
    {
        $permohonan = Permohonan::findOrFail($id);

        $validated = $request->validate([
            'id_rak' => 'required|exists:rak,id',
            'id_klien' => 'required|exists:klien,id',
            'tanggal_pengajuan' => 'required|date',
            'jenis_permohonan' => 'required|in:jual beli,hibah,hak tanggungan,waris',
            'status_permohonan' => 'required',
            // file fields
            'ktp' => 'nullable|file|mimes:jpeg,jpg,png,pdf',
            'kk' => 'nullable|file|mimes:jpeg,jpg,png,pdf',
            'npwp' => 'nullable|file|mimes:jpeg,jpg,png,pdf',
            'akta_nikah' => 'nullable|file|mimes:jpeg,jpg,png,pdf',
            'sertifikat_tanah' => 'nullable|file|mimes:jpeg,jpg,png,pdf',
            'sppt_pbb' => 'nullable|file|mimes:jpeg,jpg,png,pdf',
            'imb' => 'nullable|file|mimes:jpeg,jpg,png,pdf',
            'sspd_bpthb' => 'nullable|file|mimes:jpeg,jpg,png,pdf',
            'pph' => 'nullable|file|mimes:jpeg,jpg,png,pdf',
            'silsilah_waris' => 'nullable|file|mimes:jpeg,jpg,png,pdf',
            'pernyataan_waris' => 'nullable|file|mimes:jpeg,jpg,png,pdf',
            'akta_kematian' => 'nullable|file|mimes:jpeg,jpg,png,pdf',
            'keterangan_permohonan' => 'required|string',
        ]);

        $fileFields = [
            'ktp',
            'kk',
            'npwp',
            'akta_nikah',
            'sertifikat_tanah',
            'sppt_pbb',
            'imb',
            'sspd_bpthb',
            'pph',
            'silsilah_waris',
            'pernyataan_waris',
            'akta_kematian'
        ];
        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = $field . '_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('uploads/permohonan', $filename, 'public');
                $validated[str_replace('-', '_', $field)] = $path;
            }
        }

        $permohonan->update([
            'id_rak' => $validated['id_rak'],
            'id_klien' => $validated['id_klien'],
            'tanggal_pengajuan' => $validated['tanggal_pengajuan'],
            'jenis_permohonan' => $validated['jenis_permohonan'],
            'status_permohonan' => $validated['status_permohonan'],
            // file fields
            'ktp' => $validated['ktp'] ?? $permohonan->ktp,
            'kk' => $validated['kk'] ?? $permohonan->kk,
            'npwp' => $validated['npwp'] ?? $permohonan->npwp,
            'akta_nikah' => $validated['akta_nikah'] ?? ($validated['akta_nikah'] ?? $permohonan->akta_nikah),
            'sertifikat_tanah' => $validated['sertifikat_tanah'] ?? $permohonan->sertifikat_tanah,
            'sppt_pbb' => $validated['sppt_pbb'] ?? $permohonan->sppt_pbb,
            'imb' => $validated['imb'] ?? $permohonan->imb,
            'sspd_bphtb' => $validated['sspd_bpthb'] ?? $permohonan->sspd_bphtb,
            'pph' => $validated['pph'] ?? $permohonan->pph,
            'silsilah_waris' => $validated['silsilah_waris'] ?? $permohonan->silsilah_waris,
            'pernyataan_waris' => $validated['pernyataan_waris'] ?? $permohonan->pernyataan_waris,
            'akta_kematian' => $validated['akta_kematian'] ?? $permohonan->akta_kematian,
            'keterangan_permohonan' => $validated['keterangan_permohonan']
        ]);

        Mail::to('suanggawija@gmail.com')->send(new PengajuanShipped);

        return redirect()->route('permohonan.index')->with('success', 'Permohonan berhasil diupdate.');
    }

    public function destroy($id)
    {
        $permohonan = Permohonan::findOrFail($id);
        $permohonan->delete();

        return redirect()->route('permohonan.index')->with('success', 'Permohonan berhasil dihapus.');
    }
}
