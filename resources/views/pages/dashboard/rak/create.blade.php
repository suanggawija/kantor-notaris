@extends('layouts.dashboard')

@section('title', 'Rak - Tambah')
@section('container')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Tambah Rak</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                {{--  --}}
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                {{--  --}}
                                <form action="{{ route('rak.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="kode_rak">Kode Rak</label>
                                        <input type="text" class="form-control" id="kode_rak" name="kode_rak"
                                            placeholder="Kode Rak" value="{{ old('kode_rak') }}" />
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_rak">Nama Rak</label>
                                        <input type="text" class="form-control" id="nama_rak" name="nama_rak"
                                            placeholder="Nama Rak" value="{{ old('nama_rak') }}" />
                                    </div>
                                    <div class="form-group">
                                        <label for="lokasi_rak">Lokasi Rak</label>
                                        <input type="text" class="form-control" id="lokasi_rak" name="lokasi_rak"
                                            placeholder="Lokasi Rak" value="{{ old('lokasi_rak') }}" />
                                    </div>
                                    <div class="d-flex justify-content-end mt-3">
                                        <button type="submit" class="btn btn-primary btn-round">Tambah Data</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
