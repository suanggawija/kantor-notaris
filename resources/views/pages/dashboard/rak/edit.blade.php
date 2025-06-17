@extends('layouts.dashboard')

@section('title', 'Rak - Edit')
@section('container')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Edit Rak</div>
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
                                <form action="{{ route('rak.update', $rak->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="kode_rak">Kode Rak</label>
                                        <input type="text" class="form-control" id="kode_rak" name="kode_rak"
                                            placeholder="Kode Rak" value="{{ old('kode_rak', $rak->kode_rak) }}" />
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_rak">Nama Rak</label>
                                        <input type="text" class="form-control" id="nama_rak" name="nama_rak"
                                            placeholder="Nama Rak" value="{{ old('nama_rak', $rak->nama_rak) }}" />
                                    </div>
                                    <div class="form-group">
                                        <label for="lokasi_rak">Lokasi Rak</label>
                                        <input type="text" class="form-control" id="lokasi_rak" name="lokasi_rak"
                                            placeholder="Lokasi Rak" value="{{ old('lokasi_rak', $rak->lokasi_rak) }}" />
                                    </div>
                                    <div class="d-flex justify-content-end mt-3">
                                        <button type="submit" class="btn btn-warning btn-round">Edit Data</button>
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
