@extends('layouts.dashboard')

@section('container')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Edit Pembayaran</div>
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
                                <form action="{{ route('pembayaran.update', $pembayaran->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="id_permohonan">Pemohon</label>
                                        <select class="form-select" id="id_permohonan" name="id_permohonan" required>
                                            <option value="">-- Pilih Pemohon --</option>
                                            @foreach ($permohonan as $item)
                                                <option value="{{ $item->id }}"
                                                    @if (old('id_permohonan', $pembayaran->id_permohonan ?? '') == $item->id) selected @endif>
                                                    #{{ $item->id }}/{{ $item->jenis_permohonan }}/{{ $item->klien->nama_klien }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_pembayaran">Tanggal Pembayaran</label>
                                        <input type="date" class="form-control" id="tgl_pembayaran" name="tgl_pembayaran"
                                            placeholder="Tanggal Pembayaran"
                                            value="{{ old('tgl_pembayaran', isset($pembayaran) ? $pembayaran->tgl_pembayaran : '') }}" />
                                    </div>
                                    <div class="form-group">
                                        <label for="total_pembayaran">Total Pembayaran</label>
                                        <input type="text" class="form-control" id="total_pembayaran"
                                            name="total_pembayaran" placeholder="Total Pembayaran"
                                            value="{{ old('total_pembayaran', isset($pembayaran) ? $pembayaran->total_pembayaran : '') }}" />
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
