@extends('layouts.dashboard')

@section('container')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Edit Permohonan</div>
                    </div>
                    <div class="card-body">
                        {{-- Menampilkan Error Validasi --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('permohonan.update', $permohonan->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- Data Utama Permohonan --}}
                            <div class="form-group">
                                <label for="id_rak">Rak</label>
                                <select class="form-select" id="id_rak" name="id_rak" required>
                                    <option value="">-- Pilih Rak --</option>
                                    @foreach ($rak as $item)
                                        <option value="{{ $item->id }}" @selected($permohonan->id_rak == $item->id)>
                                            {{ $item->nama_rak }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="id_klien">Klien</label>
                                <select class="form-select" id="id_klien" name="id_klien" required>
                                    <option value="">-- Pilih Nama Klien --</option>
                                    @foreach ($klien as $item)
                                        <option value="{{ $item->id }}" @selected($permohonan->id_klien == $item->id)>
                                            {{ $item->nama_klien }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="tanggal_pengajuan">Tanggal Pengajuan</label>
                                <input type="date" class="form-control" id="tanggal_pengajuan" name="tanggal_pengajuan"
                                    value="{{ old('tanggal_pengajuan', $permohonan->tanggal_pengajuan) }}" required />
                            </div>

                            {{-- Jenis & Status Permohonan --}}
                            <div class="form-group">
                                <label for="jenis_permohonan">Jenis Permohonan</label>
                                <select class="form-select" id="jenis_permohonan" name="jenis_permohonan" required>
                                    <option value="">-- Pilih Jenis Permohonan --</option>
                                    <option value="jual beli" @selected(old('jenis_permohonan', $permohonan->jenis_permohonan) == 'jual beli')>Jual Beli</option>
                                    <option value="hibah" @selected(old('jenis_permohonan', $permohonan->jenis_permohonan) == 'hibah')>Hibah</option>
                                    <option value="hak tanggungan" @selected(old('jenis_permohonan', $permohonan->jenis_permohonan) == 'hak tanggungan')>Hak Tanggungan</option>
                                    <option value="waris" @selected(old('jenis_permohonan', $permohonan->jenis_permohonan) == 'waris')>Waris</option>
                                </select>
                            </div>

                            {{-- Grup Input File Dinamis --}}
                            <div id="jual-beli-group" class="file-input-group">
                                <x-form-file-input-edit name="ktp" label="KTP" group="jualbeli" :existing-value="$permohonan->ktp" />
                                <x-form-file-input-edit name="kk" label="KK" group="jualbeli" :existing-value="$permohonan->kk" />
                                <x-form-file-input-edit name="akta_nikah" label="Akta Nikah" group="jualbeli"
                                    :existing-value="$permohonan->akta_nikah" />
                                <x-form-file-input-edit name="npwp" label="NPWP" group="jualbeli" :existing-value="$permohonan->npwp" />
                                <x-form-file-input-edit name="sertifikat_tanah" label="Sertifikat Tanah" group="jualbeli"
                                    :existing-value="$permohonan->sertifikat_tanah" />
                                <x-form-file-input-edit name="sppt_pbb" label="SPPT PBB" group="jualbeli"
                                    :existing-value="$permohonan->sppt_pbb" />
                                <x-form-file-input-edit name="imb" label="IMB" group="jualbeli" :existing-value="$permohonan->imb" />
                                <x-form-file-input-edit name="sspd_bpthb" label="SSPD BPHTB" group="jualbeli"
                                    :existing-value="$permohonan->sspd_bpthb" />
                                <x-form-file-input-edit name="pph" label="PPH" group="jualbeli" :existing-value="$permohonan->pph" />
                            </div>

                            <div id="hibah-group" class="file-input-group">
                                <x-form-file-input-edit name="ktp" label="KTP" group="hibah" :existing-value="$permohonan->ktp" />
                                <x-form-file-input-edit name="kk" label="KK" group="hibah" :existing-value="$permohonan->kk" />
                                <x-form-file-input-edit name="npwp" label="NPWP" group="hibah" :existing-value="$permohonan->npwp" />
                                <x-form-file-input-edit name="silsilah_waris" label="Silsilah Waris" group="hibah"
                                    :existing-value="$permohonan->silsilah_waris" />
                                <x-form-file-input-edit name="sertifikat_tanah" label="Sertifikat Tanah" group="hibah"
                                    :existing-value="$permohonan->sertifikat_tanah" />
                                <x-form-file-input-edit name="sppt_pbb" label="SPPT PBB" group="hibah"
                                    :existing-value="$permohonan->sppt_pbb" />
                                <x-form-file-input-edit name="sspd_bpthb" label="SSPD BPHTB" group="hibah"
                                    :existing-value="$permohonan->sspd_bpthb" />
                            </div>

                            <div id="hak-tanggungan-group" class="file-input-group">
                                <x-form-file-input-edit name="ktp" label="KTP" group="haktanggungan"
                                    :existing-value="$permohonan->ktp" />
                                <x-form-file-input-edit name="kk" label="KK" group="haktanggungan"
                                    :existing-value="$permohonan->kk" />
                                <x-form-file-input-edit name="npwp" label="NPWP" group="haktanggungan"
                                    :existing-value="$permohonan->npwp" />
                                <x-form-file-input-edit name="sertifikat_tanah" label="Sertifikat Tanah"
                                    group="haktanggungan" :existing-value="$permohonan->sertifikat_tanah" />
                                <x-form-file-input-edit name="sppt_pbb" label="SPPT PBB" group="haktanggungan"
                                    :existing-value="$permohonan->sppt_pbb" />
                                <x-form-file-input-edit name="sspd_bpthb" label="SSPD BPHTB" group="haktanggungan"
                                    :existing-value="$permohonan->sspd_bpthb" />
                            </div>

                            <div id="waris-group" class="file-input-group">
                                <x-form-file-input-edit name="ktp" label="KTP" group="waris"
                                    :existing-value="$permohonan->ktp" />
                                <x-form-file-input-edit name="kk" label="KK" group="waris"
                                    :existing-value="$permohonan->kk" />
                                <x-form-file-input-edit name="silsilah_waris" label="Silsilah Waris" group="waris"
                                    :existing-value="$permohonan->silsilah_waris" />
                                <x-form-file-input-edit name="akta_kematian" label="Akta Kematian" group="waris"
                                    :existing-value="$permohonan->akta_kematian" />
                                <x-form-file-input-edit name="pernyataan_waris" label="Pernyataan Waris" group="waris"
                                    :existing-value="$permohonan->pernyataan_waris" />
                                <x-form-file-input-edit name="sppt_pbb" label="SPPT PBB" group="waris"
                                    :existing-value="$permohonan->sppt_pbb" />
                                <x-form-file-input-edit name="sspd_bpthb" label="SSPD BPHTB" group="waris"
                                    :existing-value="$permohonan->sspd_bpthb" />
                            </div>

                            {{-- Keterangan dan Status --}}
                            <div class="form-group">
                                <label for="status_permohonan">Status Permohonan</label>
                                <select class="form-select" id="status_permohonan" name="status_permohonan" required>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="data berkas kurang" @selected(old('status_permohonan', $permohonan->status_permohonan) == 'data berkas kurang')>Data Berkas Kurang
                                    </option>
                                    <option value="akan diproses" @selected(old('status_permohonan', $permohonan->status_permohonan) == 'akan diproses')>Akan Diproses</option>
                                    <option value="dalam diproses" @selected(old('status_permohonan', $permohonan->status_permohonan) == 'dalam diproses')>Dalam Diproses</option>
                                    <option value="diterima" @selected(old('status_permohonan', $permohonan->status_permohonan) == 'diterima')>Diterima</option>
                                    <option value="ditolak" @selected(old('status_permohonan', $permohonan->status_permohonan) == 'ditolak')>Ditolak</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="keterangan_permohonan">Keterangan Permohonan</label>
                                <textarea class="form-control" id="keterangan_permohonan" name="keterangan_permohonan" rows="3"
                                    placeholder="Tambahkan keterangan jika diperlukan...">{{ old('keterangan_permohonan', $permohonan->keterangan_permohonan) }}</textarea>
                            </div>

                            {{-- Tombol Aksi --}}
                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-primary btn-round">Update Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scrip')
    <script>
        // Fungsi untuk menampilkan preview gambar (sama seperti sebelumnya)
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

        // Fungsi untuk mengatur grup input file yang ditampilkan
        function toggleFileInputGroups() {
            const selectedValue = document.getElementById('jenis_permohonan').value.replace(/\s+/g, '-');
            const allGroups = document.querySelectorAll('.file-input-group');

            allGroups.forEach(group => {
                const inputs = group.querySelectorAll('input[type="file"]');
                if (group.id === selectedValue + '-group') {
                    group.style.display = 'block';
                    inputs.forEach(input => input.disabled = false);
                } else {
                    group.style.display = 'none';
                    inputs.forEach(input => input.disabled = true);
                }
            });
        }

        // Panggil fungsi saat halaman dimuat untuk mengatur tampilan awal
        document.addEventListener('DOMContentLoaded', toggleFileInputGroups);

        // Panggil fungsi saat pilihan jenis permohonan berubah
        document.getElementById('jenis_permohonan').addEventListener('change', toggleFileInputGroups);
    </script>
@endsection
