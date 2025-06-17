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
                    'title' => 'Permohonan',
                    'value' => $klienCount,
                    'icon' => 'fas fa-users',
                ])
            </div>
            <div class="col-sm-6 col-md-3">
                @include('components.card-stats', [
                    'title' => 'Permohonan',
                    'value' => $permohonanCount,
                    'icon' => 'fas fa-users',
                ])
            </div>
            <div class="col-sm-6 col-md-3">
                @include('components.card-stats', [
                    'title' => 'Permohonan',
                    'value' => $pembayaranCount,
                    'icon' => 'fas fa-users',
                ])
            </div>
            <div class="col-sm-6 col-md-3">
                @include('components.card-stats', [
                    'title' => 'Permohonan',
                    'value' => $rakCount,
                    'icon' => 'fas fa-users',
                ])
            </div>
        </div>
    </div>
@endsection
