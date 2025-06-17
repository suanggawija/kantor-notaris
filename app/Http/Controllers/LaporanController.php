<?php

namespace App\Http\Controllers;

use App\Models\Permohonan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function laporanPermohonan()
    {
        $permohonan = Permohonan::all();

        return view('pages.dashboard.laporan.permohonan', compact('permohonan'));
    }

    public function cetakLaporanPermohonan()
    {
        $permohonan = Permohonan::all();

        $pdf = Pdf::loadView('pdf.laporan.permohonan', compact('permohonan'));
        return $pdf->download('data-klien.pdf');
    }
}
