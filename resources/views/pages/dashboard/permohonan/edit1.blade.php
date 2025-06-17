@extends('layouts.dashboard')

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
                                <form action="{{ route('permohonan.update', $permohonan->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="id_rak">Rak</label>
                                        <select class="form-select" id="id_rak" name="id_rak"
                                            onchange="showFileInput()">
                                            <option value="">-- Pilih Rak --</option>
                                            @foreach ($rak as $index => $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old('id_rak', $permohonan->id_rak ?? '') == $item->id ? 'selected' : '' }}>
                                                    {{ $item->nama_rak }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="id_klien">Klien</label>
                                        <select class="form-select" id="id_klien" name="id_klien"
                                            onchange="showFileInput()">
                                            <option value="">-- Pilih Nama Klien --</option>
                                            @foreach ($klien as $index => $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old('id_klien', $permohonan->id_klien ?? '') == $item->id ? 'selected' : '' }}>
                                                    {{ $item->nama_klien }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="tanggal_pengajuan">Tanggal Pengajuan</label>
                                        <input type="date" class="form-control" id="tanggal_pengajuan"
                                            name="tanggal_pengajuan" placeholder="Tanggal Pengajuan"
                                            value="{{ old('tanggal_pengajuan', isset($permohonan->tanggal_pengajuan) ? $permohonan->tanggal_pengajuan : '') }}" />
                                    </div>

                                    {{-- jenis permohonan --}}
                                    <div class="form-group">
                                        <label for="jenis_permohonan">Jenis Permohonan</label>
                                        <select class="form-select" id="jenis_permohonan" name="jenis_permohonan"
                                            onchange="showFileInput()">
                                            <option value="">-- Pilih Jenis Permohonan --</option>
                                            <option value="jual beli"
                                                {{ old('jenis_permohonan', $permohonan->jenis_permohonan ?? '') == 'jual beli' ? 'selected' : '' }}>
                                                Jual Beli</option>
                                            <option value="hibah"
                                                {{ old('jenis_permohonan', $permohonan->jenis_permohonan ?? '') == 'hibah' ? 'selected' : '' }}>
                                                Hibah</option>
                                            <option value="hak tanggungan"
                                                {{ old('jenis_permohonan', $permohonan->jenis_permohonan ?? '') == 'hak tanggungan' ? 'selected' : '' }}>
                                                Hak Tanggungan</option>
                                            <option value="waris"
                                                {{ old('jenis_permohonan', $permohonan->jenis_permohonan ?? '') == 'waris' ? 'selected' : '' }}>
                                                Waris</option>
                                        </select>
                                    </div>

                                    {{-- Jual Beli file --}}
                                    <div id="jual-beli-group" style="display:none;">
                                        <div class="form-group">
                                            <label for="ktp_jualbeli">KTP</label>
                                            <input type="file" class="form-control-file" id="ktp_jualbeli" name="ktp"
                                                accept="image/*" onchange="previewImage(event, 'ktp-preview-jualbeli')" />
                                            @if (isset($permohonan) && $permohonan->ktp)
                                                <img id="ktp-preview-jualbeli"
                                                    src="{{ asset('storage/' . $permohonan->ktp) }}" alt="Preview Foto"
                                                    style="display:block; max-width: 200px; margin-top: 10px;" />
                                            @else
                                                <img id="ktp-preview-jualbeli" src="#" alt="Preview Foto"
                                                    style="display:none; max-width: 200px; margin-top: 10px;" />
                                            @endif
                                            @if (isset($permohonan) && $permohonan->ktp)
                                                <div class="mt-1">
                                                    <small>File saat ini: {{ basename($permohonan->ktp) }}</small>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="kk_jualbeli">KK</label>
                                            <input type="file" class="form-control-file" id="kk_jualbeli" name="kk"
                                                accept="image/*" onchange="previewImage(event, 'kk-preview-jualbeli')" />
                                            @if (isset($permohonan) && $permohonan->kk)
                                                <img id="kk-preview-jualbeli"
                                                    src="{{ asset('storage/' . $permohonan->kk) }}" alt="Preview Foto"
                                                    style="display:block; max-width: 200px; margin-top: 10px;" />
                                                <div class="mt-1">
                                                    <small>File saat ini: {{ basename($permohonan->kk) }}</small>
                                                </div>
                                            @else
                                                <img id="kk-preview-jualbeli" src="#" alt="Preview Foto"
                                                    style="display:none; max-width: 200px; margin-top: 10px;" />
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="akta-nikah_jualbeli">Akta Nikah</label>
                                            <input type="file" class="form-control-file" id="akta-nikah_jualbeli"
                                                name="akta-nikah" accept="image/*"
                                                onchange="previewImage(event, 'akta-nikah-preview-jualbeli')" />
                                            @if (isset($permohonan) && $permohonan->akta_nikah)
                                                <img id="akta-nikah-preview-jualbeli"
                                                    src="{{ asset('storage/' . $permohonan->akta_nikah) }}"
                                                    alt="Preview Foto"
                                                    style="display:block; max-width: 200px; margin-top: 10px;" />
                                                <div class="mt-1">
                                                    <small>File saat ini: {{ basename($permohonan->akta_nikah) }}</small>
                                                </div>
                                            @else
                                                <img id="akta-nikah-preview-jualbeli" src="#" alt="Preview Foto"
                                                    style="display:none; max-width: 200px; margin-top: 10px;" />
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="npwp_jualbeli">NPWP</label>
                                            <input type="file" class="form-control-file" id="npwp_jualbeli"
                                                name="npwp" accept="image/*"
                                                onchange="previewImage(event, 'npwp-preview-jualbeli')" />
                                            @if (isset($permohonan) && $permohonan->npwp)
                                                <img id="npwp-preview-jualbeli"
                                                    src="{{ asset('storage/' . $permohonan->npwp) }}" alt="Preview Foto"
                                                    style="display:block; max-width: 200px; margin-top: 10px;" />
                                                <div class="mt-1">
                                                    <small>File saat ini: {{ basename($permohonan->npwp) }}</small>
                                                </div>
                                            @else
                                                <img id="npwp-preview-jualbeli" src="#" alt="Preview Foto"
                                                    style="display:none; max-width: 200px; margin-top: 10px;" />
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="sertifikat_tanah_jualbeli">Sertifikat Tanah</label>
                                            <input type="file" class="form-control-file"
                                                id="sertifikat_tanah_jualbeli" name="sertifikat_tanah" accept="image/*"
                                                onchange="previewImage(event, 'sertifikat_tanah-preview-jualbeli')" />
                                            @if (isset($permohonan) && $permohonan->sertifikat_tanah)
                                                <img id="sertifikat_tanah-preview-jualbeli"
                                                    src="{{ asset('storage/' . $permohonan->sertifikat_tanah) }}"
                                                    alt="Preview Foto"
                                                    style="display:block; max-width: 200px; margin-top: 10px;" />
                                                <div class="mt-1">
                                                    <small>File saat ini:
                                                        {{ basename($permohonan->sertifikat_tanah) }}</small>
                                                </div>
                                            @else
                                                <img id="sertifikat_tanah-preview-jualbeli" src="#"
                                                    alt="Preview Foto"
                                                    style="display:none; max-width: 200px; margin-top: 10px;" />
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="sppt_pbb_jualbeli">SPPT PBB</label>
                                            <input type="file" class="form-control-file" id="sppt_pbb_jualbeli"
                                                name="sppt_pbb" accept="image/*"
                                                onchange="previewImage(event, 'sppt_pbb-preview-jualbeli')" />
                                            @if (isset($permohonan) && $permohonan->sppt_pbb)
                                                <img id="sppt_pbb-preview-jualbeli"
                                                    src="{{ asset('storage/' . $permohonan->sppt_pbb) }}"
                                                    alt="Preview Foto"
                                                    style="display:block; max-width: 200px; margin-top: 10px;" />
                                                <div class="mt-1">
                                                    <small>File saat ini: {{ basename($permohonan->sppt_pbb) }}</small>
                                                </div>
                                            @else
                                                <img id="sppt_pbb-preview-jualbeli" src="#" alt="Preview Foto"
                                                    style="display:none; max-width: 200px; margin-top: 10px;" />
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="imb_jualbeli">IMB</label>
                                            <input type="file" class="form-control-file" id="imb_jualbeli"
                                                name="imb" accept="image/*"
                                                onchange="previewImage(event, 'imb-preview-jualbeli')" />
                                            @if (isset($permohonan) && $permohonan->imb)
                                                <img id="imb-preview-jualbeli"
                                                    src="{{ asset('storage/' . $permohonan->imb) }}" alt="Preview Foto"
                                                    style="display:block; max-width: 200px; margin-top: 10px;" />
                                                <div class="mt-1">
                                                    <small>File saat ini: {{ basename($permohonan->imb) }}</small>
                                                </div>
                                            @else
                                                <img id="imb-preview-jualbeli" src="#" alt="Preview Foto"
                                                    style="display:none; max-width: 200px; margin-top: 10px;" />
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="sspd_bpthb_jualbeli">SSPD BPTHB</label>
                                            <input type="file" class="form-control-file" id="sspd_bpthb_jualbeli"
                                                name="sspd_bpthb" accept="image/*"
                                                onchange="previewImage(event, 'sspd_bpthb-preview-jualbeli')" />
                                            @if (isset($permohonan) && $permohonan->sspd_bpthb)
                                                <img id="sspd_bpthb-preview-jualbeli"
                                                    src="{{ asset('storage/' . $permohonan->sspd_bpthb) }}"
                                                    alt="Preview Foto"
                                                    style="display:block; max-width: 200px; margin-top: 10px;" />
                                                <div class="mt-1">
                                                    <small>File saat ini: {{ basename($permohonan->sspd_bpthb) }}</small>
                                                </div>
                                            @else
                                                <img id="sspd_bpthb-preview-jualbeli" src="#" alt="Preview Foto"
                                                    style="display:none; max-width: 200px; margin-top: 10px;" />
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="pph_jualbeli">PPH</label>
                                            <input type="file" class="form-control-file" id="pph_jualbeli"
                                                name="pph" accept="image/*"
                                                onchange="previewImage(event, 'pph-preview-jualbeli')" />
                                            @if (isset($permohonan) && $permohonan->pph)
                                                <img id="pph-preview-jualbeli"
                                                    src="{{ asset('storage/' . $permohonan->pph) }}" alt="Preview Foto"
                                                    style="display:block; max-width: 200px; margin-top: 10px;" />
                                                <div class="mt-1">
                                                    <small>File saat ini: {{ basename($permohonan->pph) }}</small>
                                                </div>
                                            @else
                                                <img id="pph-preview-jualbeli" src="#" alt="Preview Foto"
                                                    style="display:none; max-width: 200px; margin-top: 10px;" />
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Hibah Group --}}
                                    <div id="hibah-group" style="display:none;">
                                        <div class="form-group">
                                            <label for="ktp_hibah">KTP</label>
                                            <input type="file" class="form-control-file" id="ktp_hibah"
                                                name="ktp" accept="image/*"
                                                onchange="previewImage(event, 'ktp-preview-hibah')" />
                                            @if (isset($permohonan) && $permohonan->ktp)
                                                <img id="ktp-preview-hibah"
                                                    src="{{ asset('storage/' . $permohonan->ktp) }}" alt="Preview Foto"
                                                    style="display:block; max-width: 200px; margin-top: 10px;" />
                                                <div class="mt-1">
                                                    <small>File saat ini: {{ basename($permohonan->ktp) }}</small>
                                                </div>
                                            @else
                                                <img id="ktp-preview-hibah" src="#" alt="Preview Foto"
                                                    style="display:none; max-width: 200px; margin-top: 10px;" />
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="kk_hibah">KK</label>
                                            <input type="file" class="form-control-file" id="kk_hibah"
                                                name="kk" accept="image/*"
                                                onchange="previewImage(event, 'kk-preview-hibah')" />
                                            @if (isset($permohonan) && $permohonan->kk)
                                                <img id="kk-preview-hibah"
                                                    src="{{ asset('storage/' . $permohonan->kk) }}" alt="Preview Foto"
                                                    style="display:block; max-width: 200px; margin-top: 10px;" />
                                                <div class="mt-1">
                                                    <small>File saat ini: {{ basename($permohonan->kk) }}</small>
                                                </div>
                                            @else
                                                <img id="kk-preview-hibah" src="#" alt="Preview Foto"
                                                    style="display:none; max-width: 200px; margin-top: 10px;" />
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="npwp_hibah">NPWP</label>
                                            <input type="file" class="form-control-file" id="npwp_hibah"
                                                name="npwp" accept="image/*"
                                                onchange="previewImage(event, 'npwp-preview-hibah')" />
                                            @if (isset($permohonan) && $permohonan->npwp)
                                                <img id="npwp-preview-hibah"
                                                    src="{{ asset('storage/' . $permohonan->npwp) }}" alt="Preview Foto"
                                                    style="display:block; max-width: 200px; margin-top: 10px;" />
                                                <div class="mt-1">
                                                    <small>File saat ini: {{ basename($permohonan->npwp) }}</small>
                                                </div>
                                            @else
                                                <img id="npwp-preview-hibah" src="#" alt="Preview Foto"
                                                    style="display:none; max-width: 200px; margin-top: 10px;" />
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="silsilah_waris_hibah">Silsilah Waris</label>
                                            <input type="file" class="form-control-file" id="silsilah_waris_hibah"
                                                name="silsilah_waris" accept="image/*"
                                                onchange="previewImage(event, 'silsilah_waris-preview-hibah')" />
                                            @if (isset($permohonan) && $permohonan->silsilah_waris)
                                                <img id="silsilah_waris-preview-hibah"
                                                    src="{{ asset('storage/' . $permohonan->silsilah_waris) }}"
                                                    alt="Preview Foto"
                                                    style="display:block; max-width: 200px; margin-top: 10px;" />
                                                <div class="mt-1">
                                                    <small>File saat ini:
                                                        {{ basename($permohonan->silsilah_waris) }}</small>
                                                </div>
                                            @else
                                                <img id="silsilah_waris-preview-hibah" src="#" alt="Preview Foto"
                                                    style="display:none; max-width: 200px; margin-top: 10px;" />
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="sertifikat_tanah_hibah">Sertifikat Tanah</label>
                                            <input type="file" class="form-control-file" id="sertifikat_tanah_hibah"
                                                name="sertifikat_tanah" accept="image/*"
                                                onchange="previewImage(event, 'sertifikat_tanah-preview-hibah')" />
                                            @if (isset($permohonan) && $permohonan->sertifikat_tanah)
                                                <img id="sertifikat_tanah-preview-hibah"
                                                    src="{{ asset('storage/' . $permohonan->sertifikat_tanah) }}"
                                                    alt="Preview Foto"
                                                    style="display:block; max-width: 200px; margin-top: 10px;" />
                                                <div class="mt-1">
                                                    <small>File saat ini:
                                                        {{ basename($permohonan->sertifikat_tanah) }}</small>
                                                </div>
                                            @else
                                                <img id="sertifikat_tanah-preview-hibah" src="#"
                                                    alt="Preview Foto"
                                                    style="display:none; max-width: 200px; margin-top: 10px;" />
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="sppt_pbb_hibah">SPPT PBB</label>
                                            <input type="file" class="form-control-file" id="sppt_pbb_hibah"
                                                name="sppt_pbb" accept="image/*"
                                                onchange="previewImage(event, 'sppt_pbb-preview-hibah')" />
                                            @if (isset($permohonan) && $permohonan->sppt_pbb)
                                                <img id="sppt_pbb-preview-hibah"
                                                    src="{{ asset('storage/' . $permohonan->sppt_pbb) }}"
                                                    alt="Preview Foto"
                                                    style="display:block; max-width: 200px; margin-top: 10px;" />
                                                <div class="mt-1">
                                                    <small>File saat ini: {{ basename($permohonan->sppt_pbb) }}</small>
                                                </div>
                                            @else
                                                <img id="sppt_pbb-preview-hibah" src="#" alt="Preview Foto"
                                                    style="display:none; max-width: 200px; margin-top: 10px;" />
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="sspd_bpthb_hibah">SSPD BPTHB</label>
                                            <input type="file" class="form-control-file" id="sspd_bpthb_hibah"
                                                name="sspd_bpthb" accept="image/*"
                                                onchange="previewImage(event, 'sspd_bpthb-preview-hibah')" />
                                            @if (isset($permohonan) && $permohonan->sspd_bpthb)
                                                <img id="sspd_bpthb-preview-hibah"
                                                    src="{{ asset('storage/' . $permohonan->sspd_bpthb) }}"
                                                    alt="Preview Foto"
                                                    style="display:block; max-width: 200px; margin-top: 10px;" />
                                                <div class="mt-1">
                                                    <small>File saat ini: {{ basename($permohonan->sspd_bpthb) }}</small>
                                                </div>
                                            @else
                                                <img id="sspd_bpthb-preview-hibah" src="#" alt="Preview Foto"
                                                    style="display:none; max-width: 200px; margin-top: 10px;" />
                                            @endif
                                        </div>
                                    </div>
                                    {{-- hal tanggung --}}
                                    <div id="hak-tanggungan-group" style="display:none;">
                                        <div class="form-group">
                                            <label for="ktp_haktanggungan">KTP</label>
                                            <input type="file" class="form-control-file" id="ktp_haktanggungan"
                                                name="ktp" accept="image/*"
                                                onchange="previewImage(event, 'ktp-preview-haktanggungan')" />
                                            @if (isset($permohonan) && $permohonan->ktp)
                                                <img id="ktp-preview-haktanggungan"
                                                    src="{{ asset('storage/' . $permohonan->ktp) }}" alt="Preview Foto"
                                                    style="display:block; max-width: 200px; margin-top: 10px;" />
                                                <div class="mt-1">
                                                    <small>File saat ini: {{ basename($permohonan->ktp) }}</small>
                                                </div>
                                            @else
                                                <img id="ktp-preview-haktanggungan" src="#" alt="Preview Foto"
                                                    style="display:none; max-width: 200px; margin-top: 10px;" />
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="kk_haktanggungan">KK</label>
                                            <input type="file" class="form-control-file" id="kk_haktanggungan"
                                                name="kk" accept="image/*"
                                                onchange="previewImage(event, 'kk-preview-haktanggungan')" />
                                            @if (isset($permohonan) && $permohonan->kk)
                                                <img id="kk-preview-haktanggungan"
                                                    src="{{ asset('storage/' . $permohonan->kk) }}" alt="Preview Foto"
                                                    style="display:block; max-width: 200px; margin-top: 10px;" />
                                                <div class="mt-1">
                                                    <small>File saat ini: {{ basename($permohonan->kk) }}</small>
                                                </div>
                                            @else
                                                <img id="kk-preview-haktanggungan" src="#" alt="Preview Foto"
                                                    style="display:none; max-width: 200px; margin-top: 10px;" />
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="npwp_haktanggungan">NPWP</label>
                                            <input type="file" class="form-control-file" id="npwp_haktanggungan"
                                                name="npwp" accept="image/*"
                                                onchange="previewImage(event, 'npwp-preview-haktanggungan')" />
                                            @if (isset($permohonan) && $permohonan->npwp)
                                                <img id="npwp-preview-haktanggungan"
                                                    src="{{ asset('storage/' . $permohonan->npwp) }}" alt="Preview Foto"
                                                    style="display:block; max-width: 200px; margin-top: 10px;" />
                                                <div class="mt-1">
                                                    <small>File saat ini: {{ basename($permohonan->npwp) }}</small>
                                                </div>
                                            @else
                                                <img id="npwp-preview-haktanggungan" src="#" alt="Preview Foto"
                                                    style="display:none; max-width: 200px; margin-top: 10px;" />
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="sertifikat_tanah_haktanggungan">Sertifikat Tanah</label>
                                            <input type="file" class="form-control-file"
                                                id="sertifikat_tanah_haktanggungan" name="sertifikat_tanah"
                                                accept="image/*"
                                                onchange="previewImage(event, 'sertifikat_tanah-preview-haktanggungan')" />
                                            @if (isset($permohonan) && $permohonan->sertifikat_tanah)
                                                <img id="sertifikat_tanah-preview-haktanggungan"
                                                    src="{{ asset('storage/' . $permohonan->sertifikat_tanah) }}"
                                                    alt="Preview Foto"
                                                    style="display:block; max-width: 200px; margin-top: 10px;" />
                                                <div class="mt-1">
                                                    <small>File saat ini:
                                                        {{ basename($permohonan->sertifikat_tanah) }}</small>
                                                </div>
                                            @else
                                                <img id="sertifikat_tanah-preview-haktanggungan" src="#"
                                                    alt="Preview Foto"
                                                    style="display:none; max-width: 200px; margin-top: 10px;" />
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="sppt_pbb_haktanggungan">SPPT PBB</label>
                                            <input type="file" class="form-control-file" id="sppt_pbb_haktanggungan"
                                                name="sppt_pbb" accept="image/*"
                                                onchange="previewImage(event, 'sppt_pbb-preview-haktanggungan')" />
                                            @if (isset($permohonan) && $permohonan->sppt_pbb)
                                                <img id="sppt_pbb-preview-haktanggungan"
                                                    src="{{ asset('storage/' . $permohonan->sppt_pbb) }}"
                                                    alt="Preview Foto"
                                                    style="display:block; max-width: 200px; margin-top: 10px;" />
                                                <div class="mt-1">
                                                    <small>File saat ini: {{ basename($permohonan->sppt_pbb) }}</small>
                                                </div>
                                            @else
                                                <img id="sppt_pbb-preview-haktanggungan" src="#"
                                                    alt="Preview Foto"
                                                    style="display:none; max-width: 200px; margin-top: 10px;" />
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="sspd_bpthb_haktanggungan">SSPD BPTHB</label>
                                            <input type="file" class="form-control-file" id="sspd_bpthb_haktanggungan"
                                                name="sspd_bpthb" accept="image/*"
                                                onchange="previewImage(event, 'sspd_bpthb-preview-haktanggungan')" />
                                            @if (isset($permohonan) && $permohonan->sspd_bpthb)
                                                <img id="sspd_bpthb-preview-haktanggungan"
                                                    src="{{ asset('storage/' . $permohonan->sspd_bpthb) }}"
                                                    alt="Preview Foto"
                                                    style="display:block; max-width: 200px; margin-top: 10px;" />
                                                <div class="mt-1">
                                                    <small>File saat ini: {{ basename($permohonan->sspd_bpthb) }}</small>
                                                </div>
                                            @else
                                                <img id="sspd_bpthb-preview-haktanggungan" src="#"
                                                    alt="Preview Foto"
                                                    style="display:none; max-width: 200px; margin-top: 10px;" />
                                            @endif
                                        </div>
                                    </div>

                                    {{-- waris group --}}
                                    <div id="waris-group" style="display:none;">
                                        <div class="form-group">
                                            <label for="ktp_waris">KTP</label>
                                            <input type="file" class="form-control-file" id="ktp_waris"
                                                name="ktp" accept="image/*"
                                                onchange="previewImage(event, 'ktp-preview-waris')" />
                                            @if (isset($permohonan) && $permohonan->ktp)
                                                <img id="ktp-preview-waris"
                                                    src="{{ asset('storage/' . $permohonan->ktp) }}" alt="Preview Foto"
                                                    style="display:block; max-width: 200px; margin-top: 10px;" />
                                                <div class="mt-1">
                                                    <small>File saat ini: {{ basename($permohonan->ktp) }}</small>
                                                </div>
                                            @else
                                                <img id="ktp-preview-waris" src="#" alt="Preview Foto"
                                                    style="display:none; max-width: 200px; margin-top: 10px;" />
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="kk_waris">KK</label>
                                            <input type="file" class="form-control-file" id="kk_waris"
                                                name="kk" accept="image/*"
                                                onchange="previewImage(event, 'kk-preview-waris')" />
                                            @if (isset($permohonan) && $permohonan->kk)
                                                <img id="kk-preview-waris"
                                                    src="{{ asset('storage/' . $permohonan->kk) }}" alt="Preview Foto"
                                                    style="display:block; max-width: 200px; margin-top: 10px;" />
                                                <div class="mt-1">
                                                    <small>File saat ini: {{ basename($permohonan->kk) }}</small>
                                                </div>
                                            @else
                                                <img id="kk-preview-waris" src="#" alt="Preview Foto"
                                                    style="display:none; max-width: 200px; margin-top: 10px;" />
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="silsilah_waris_waris">Silsilah Waris</label>
                                            <input type="file" class="form-control-file" id="silsilah_waris_waris"
                                                name="silsilah_waris" accept="image/*"
                                                onchange="previewImage(event, 'silsilah_waris-preview-waris')" />
                                            @if (isset($permohonan) && $permohonan->silsilah_waris)
                                                <img id="silsilah_waris-preview-waris"
                                                    src="{{ asset('storage/' . $permohonan->silsilah_waris) }}"
                                                    alt="Preview Foto"
                                                    style="display:block; max-width: 200px; margin-top: 10px;" />
                                                <div class="mt-1">
                                                    <small>File saat ini:
                                                        {{ basename($permohonan->silsilah_waris) }}</small>
                                                </div>
                                            @else
                                                <img id="silsilah_waris-preview-waris" src="#" alt="Preview Foto"
                                                    style="display:none; max-width: 200px; margin-top: 10px;" />
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="akta_kematian_waris">Akta Kematian</label>
                                            <input type="file" class="form-control-file" id="akta_kematian_waris"
                                                name="akta_kematian" accept="image/*"
                                                onchange="previewImage(event, 'akta_kematian-preview-waris')" />
                                            @if (isset($permohonan) && $permohonan->akta_kematian)
                                                <img id="akta_kematian-preview-waris"
                                                    src="{{ asset('storage/' . $permohonan->akta_kematian) }}"
                                                    alt="Preview Foto"
                                                    style="display:block; max-width: 200px; margin-top: 10px;" />
                                                <div class="mt-1">
                                                    <small>File saat ini:
                                                        {{ basename($permohonan->akta_kematian) }}</small>
                                                </div>
                                            @else
                                                <img id="akta_kematian-preview-waris" src="#" alt="Preview Foto"
                                                    style="display:none; max-width: 200px; margin-top: 10px;" />
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="pernyataan_waris_waris">Pernyataan Waris</label>
                                            <input type="file" class="form-control-file" id="pernyataan_waris_waris"
                                                name="pernyataan_waris" accept="image/*"
                                                onchange="previewImage(event, 'pernyataan_waris-preview-waris')" />
                                            @if (isset($permohonan) && $permohonan->pernyataan_waris)
                                                <img id="pernyataan_waris-preview-waris"
                                                    src="{{ asset('storage/' . $permohonan->pernyataan_waris) }}"
                                                    alt="Preview Foto"
                                                    style="display:block; max-width: 200px; margin-top: 10px;" />
                                                <div class="mt-1">
                                                    <small>File saat ini:
                                                        {{ basename($permohonan->pernyataan_waris) }}</small>
                                                </div>
                                            @else
                                                <img id="pernyataan_waris-preview-waris" src="#"
                                                    alt="Preview Foto"
                                                    style="display:none; max-width: 200px; margin-top: 10px;" />
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="sppt_pbb_waris">SPPT PBB</label>
                                            <input type="file" class="form-control-file" id="sppt_pbb_waris"
                                                name="sppt_pbb" accept="image/*"
                                                onchange="previewImage(event, 'sppt_pbb-preview-waris')" />
                                            @if (isset($permohonan) && $permohonan->sppt_pbb)
                                                <img id="sppt_pbb-preview-waris"
                                                    src="{{ asset('storage/' . $permohonan->sppt_pbb) }}"
                                                    alt="Preview Foto"
                                                    style="display:block; max-width: 200px; margin-top: 10px;" />
                                                <div class="mt-1">
                                                    <small>File saat ini: {{ basename($permohonan->sppt_pbb) }}</small>
                                                </div>
                                            @else
                                                <img id="sppt_pbb-preview-waris" src="#" alt="Preview Foto"
                                                    style="display:none; max-width: 200px; margin-top: 10px;" />
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="sspd_bpthb_waris">SSPD BPTHB</label>
                                            <input type="file" class="form-control-file" id="sspd_bpthb_waris"
                                                name="sspd_bpthb" accept="image/*"
                                                onchange="previewImage(event, 'sspd_bpthb-preview-waris')" />
                                            @if (isset($permohonan) && $permohonan->sspd_bpthb)
                                                <img id="sspd_bpthb-preview-waris"
                                                    src="{{ asset('storage/' . $permohonan->sspd_bpthb) }}"
                                                    alt="Preview Foto"
                                                    style="display:block; max-width: 200px; margin-top: 10px;" />
                                                <div class="mt-1">
                                                    <small>File saat ini: {{ basename($permohonan->sspd_bpthb) }}</small>
                                                </div>
                                            @else
                                                <img id="sspd_bpthb-preview-waris" src="#" alt="Preview Foto"
                                                    style="display:none; max-width: 200px; margin-top: 10px;" />
                                            @endif
                                        </div>
                                    </div>

                                    {{-- status permohonan --}}
                                    <div class="form-group">
                                        <label for="status_permohonan">Status Permohonan</label>
                                        <select class="form-select" id="status_permohonan" name="status_permohonan"
                                            onchange="showFileInput()">
                                            <option value="">-- Pilih Status --</option>
                                            <option value="data berkas kurang"
                                                {{ old('status_permohonan', $permohonan->status_permohonan ?? '') == 'data berkas kurang' ? 'selected' : '' }}>
                                                Data Berkas Kurang</option>
                                            <option value="akan diproses"
                                                {{ old('status_permohonan', $permohonan->status_permohonan ?? '') == 'akan diproses' ? 'selected' : '' }}>
                                                Akan Diproses</option>
                                            <option value="dalam diproses"
                                                {{ old('status_permohonan', $permohonan->status_permohonan ?? '') == 'dalam diproses' ? 'selected' : '' }}>
                                                Dalam Diproses</option>
                                            <option value="diterima"
                                                {{ old('status_permohonan', $permohonan->status_permohonan ?? '') == 'diterima' ? 'selected' : '' }}>
                                                Diterima</option>
                                            <option value="ditolak"
                                                {{ old('status_permohonan', $permohonan->status_permohonan ?? '') == 'ditolak' ? 'selected' : '' }}>
                                                Ditolak</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="keterangan_permohonan">Keterangan Permohonan</label>
                                        <input type="text" class="form-control" id="keterangan_permohonan"
                                            name="keterangan_permohonan" placeholder="Keterangan Permohonan"
                                            value="{{ old('keterangan_permohonan', $permohonan->keterangan_permohonan ?? '') }}" />
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
@section('scrip')
    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('preview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = '#';
                preview.style.display = 'none';
            }
        }
    </script>


    {{-- pengatuan tampilan form input --}}
    <script>
        function showFileInput() {
            var jenis = document.getElementById('jenis_permohonan').value;
            document.getElementById('jual-beli-group').style.display = 'none';
            document.getElementById('hibah-group').style.display = 'none';
            document.getElementById('hak-tanggungan-group').style.display = 'none';
            document.getElementById('waris-group').style.display = 'none';

            if (jenis === 'jual beli') {
                document.getElementById('jual-beli-group').style.display = 'block';
            } else if (jenis === 'hibah') {
                document.getElementById('hibah-group').style.display = 'block';
            } else if (jenis === 'hak tanggungan') {
                document.getElementById('hak-tanggungan-group').style.display = 'block';
            } else if (jenis === 'waris') {
                document.getElementById('waris-group').style.display = 'block';
            }
        }

        function previewImage(event, previewId) {
            const input = event.target;
            const preview = document.getElementById(previewId);
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = '#';
                preview.style.display = 'none';
            }
        }
    </script>

    <script>
        function showJenisGroup() {
            var jenis = document.getElementById('jenis_permohonan').value;
            // Sembunyikan semua group dulu
            document.querySelectorAll('.jenis-group').forEach(function(el) {
                el.style.display = 'none';
            });

            // Tampilkan group sesuai jenis
            if (jenis === 'jual beli') {
                document.getElementById('jual-beli-group').style.display = 'block';
            } else if (jenis === 'hibah') {
                document.getElementById('hibah-group').style.display = 'block';
            } else if (jenis === 'hak tanggungan') {
                document.getElementById('hak-tanggungan-group').style.display = 'block';
            } else if (jenis === 'waris') {
                document.getElementById('waris-group').style.display = 'block';
            }
        }

        // Panggil saat select berubah
        document.getElementById('jenis_permohonan').addEventListener('change', showJenisGroup);

        // Panggil sekali saat halaman load (untuk default value)
        window.addEventListener('DOMContentLoaded', showJenisGroup);
    </script>
@endsection
