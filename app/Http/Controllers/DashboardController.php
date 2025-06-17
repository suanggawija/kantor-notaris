<?php

namespace App\Http\Controllers;

use App\Models\Klien;
use App\Models\Pembayaran;
use App\Models\Permohonan;
use App\Models\Rak;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $permohonanCount = Permohonan::count();
        $klienCount = Klien::count();
        $pembayaranCount = Pembayaran::count();
        $rakCount = Rak::count();
        return view('pages.dashboard.index', compact('permohonanCount', 'klienCount', 'pembayaranCount', 'rakCount'));
    }
}
