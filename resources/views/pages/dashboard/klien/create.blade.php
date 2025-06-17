@extends('layouts.dashboard')

@section('title', 'Klien - Tambah')
@section('container')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Tambah Klien</div>
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
                                <form action="{{ route('klien.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nik_klien">NIK</label>
                                        <input type="text" class="form-control" id="nik_klien" name="nik_klien"
                                            placeholder="NIK" value="{{ old('nik_klien') }}" />
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_klien">Nama</label>
                                        <input type="text" class="form-control" id="nama_klien" name="nama_klien"
                                            placeholder="Nama" value="{{ old('nama_klien') }}" />
                                    </div>
                                    <div class="form-group">
                                        <label for="email_klien">Email</label>
                                        <input type="email" class="form-control" id="email_klien" name="email_klien"
                                            placeholder="Email" value="{{ old('email_klien') }}" />
                                    </div>
                                    <div class="form-group">
                                        <label for="no_telp_klien">Telp</label>
                                        <input type="text" class="form-control" id="no_telp_klien" name="no_telp_klien"
                                            placeholder="Telp" value="{{ old('no_telp_klien') }}" />
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat_klien">Alamat</label>
                                        <input type="text" class="form-control" id="alamat_klien" name="alamat_klien"
                                            placeholder="Alamat" value="{{ old('alamat_klien') }}" />
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
