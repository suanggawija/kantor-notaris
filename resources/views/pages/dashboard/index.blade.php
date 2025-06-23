@extends('layouts.dashboard')

@section('title', 'Dashboard')
@section('container')
    <div class="page-inner">
        {{-- Title --}}
        @include('components.title', [
            'title' => 'Dashboard',
            'desc' => 'Dashboard Admin',
            'button_title' => 'Tambah Permohonan',
            'href' => '/permohonan/create',
        ])
        {{-- End Title --}}

        <div class="row">
            <div class="col-sm-6 col-md-3">
                @include('components.card-stats', [
                    'title' => 'Klien',
                    'value' => $klienCount,
                    'icon' => 'fas fa-users',
                ])
            </div>
            <div class="col-sm-6 col-md-3">
                @include('components.card-stats', [
                    'title' => 'Permohonan',
                    'value' => $permohonanCount,
                    'icon' => 'fas fa-file-contract',
                ])
            </div>
            <div class="col-sm-6 col-md-3">
                @include('components.card-stats', [
                    'title' => 'Pembayaran',
                    'value' => $pembayaranCount,
                    'icon' => 'fas fa-address-card',
                ])
            </div>
            <div class="col-sm-6 col-md-3">
                @include('components.card-stats', [
                    'title' => 'Rak',
                    'value' => $rakCount,
                    'icon' => 'fas fa-boxes',
                ])
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="p-3 shadow-sm card h-100">
                    <div style="height: 500px; width: 100%;"> {{-- Atur tinggi di sini --}}
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('scrip')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctxLine = document.getElementById('lineChart').getContext('2d');
        const lineChart = new Chart(ctxLine, {
            type: 'line',
            data: {
                labels: {!! json_encode($labelsChart) !!}, // [1, 2, 3, ..., 30]
                datasets: [{
                    label: 'Jumlah Permohonan per Hari',
                    data: {!! json_encode($dataChart) !!}, // [0, 1, 0, 2, ...]
                    borderColor: 'rgba(54, 162, 235, 1)',
                    fill: false,
                    tension: 0.3,
                    pointBackgroundColor: 'rgba(54, 162, 235, 1)',
                    pointBorderColor: '#fff',
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    // title: {
                    //     display: true,
                    //     text: 'Tren Permohonan Bulan Ini per Hari'
                    // },
                    legend: {
                        position: 'bottom'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 0
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Tanggal (1 - {{ now()->daysInMonth }})'
                        }
                    }
                }
            }
        });
    </script>
@endsection
