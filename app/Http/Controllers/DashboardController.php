<?php

namespace App\Http\Controllers;

use App\Models\Klien;
use App\Models\Pembayaran;
use App\Models\Permohonan;
use App\Models\Rak;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $permohonanCount = Permohonan::count();
        $klienCount = Klien::count();
        $pembayaranCount = Pembayaran::count();
        $rakCount = Rak::count();

        // Ambil tanggal sekarang
        $now = Carbon::now();

        // Ambil awal dan akhir bulan ini
        $startDate = $now->copy()->startOfMonth();
        $endDate = $now->copy()->endOfMonth();

        // Ambil data dari DB: jumlah permohonan per tanggal
        $permohonan = DB::table('permohonan')
            ->select(DB::raw('tanggal_pengajuan, COUNT(*) as jumlah'))
            ->whereBetween('tanggal_pengajuan', [$startDate->toDateString(), $endDate->toDateString()])
            ->groupBy('tanggal_pengajuan')
            ->orderBy('tanggal_pengajuan')
            ->pluck('jumlah', 'tanggal_pengajuan');

        // Siapkan array tanggal dari 1 - 30/31 dan isi datanya
        $labelsChart = [];
        $dataChart = [];

        foreach ($startDate->daysUntil($endDate) as $date) {
            $day = $date->format('j'); // 1, 2, 3 ...
            $labelsChart[] = $day;
            $dataChart[] = $permohonan[$date->toDateString()] ?? 0;
        }


        return view('pages.dashboard.index', compact(
            'permohonanCount',
            'klienCount',
            'pembayaranCount',
            'rakCount',
            'labelsChart',
            'dataChart'
        ));
    }
}
