@extends('layouts.dashboard')

@section('container')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Tambah Permohonan</div>
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

                        <form action="{{ route('permohonan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- Data Utama Permohonan --}}
                            <div class="form-group">
                                <label for="id_rak">Rak</label>
                                <select class="form-select" id="id_rak" name="id_rak" required>
                                    <option value="">-- Pilih Rak --</option>
                                    @foreach ($rak as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_rak }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="id_klien">Klien</label>
                                <select class="form-select" id="id_klien" name="id_klien" required>
                                    <option value="">-- Pilih Nama Klien --</option>
                                    @foreach ($klien as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_klien }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="tanggal_pengajuan">Tanggal Pengajuan</label>
                                <input type="date" class="form-control" id="tanggal_pengajuan" name="tanggal_pengajuan"
                                    value="{{ old('tanggal_pengajuan', date('Y-m-d')) }}" required />
                            </div>

                            {{-- Jenis & Status Permohonan --}}
                            <div class="form-group">
                                <label for="jenis_permohonan">Jenis Permohonan</label>
                                <select class="form-select" id="jenis_permohonan" name="jenis_permohonan" required>
                                    <option value="">-- Pilih Jenis Permohonan --</option>
                                    <option value="jual beli">Jual Beli</option>
                                    <option value="hibah">Hibah</option>
                                    <option value="hak tanggungan">Hak Tanggungan</option>
                                    <option value="waris">Waris</option>
                                </select>
                            </div>

                            {{-- Grup Input File Dinamis --}}
                            {{-- Setiap grup akan ditampilkan/disembunyikan oleh JavaScript --}}

                            <div id="jual-beli-group" class="file-input-group" style="display:none;">
                                <x-form-file-input name="ktp" label="KTP" group="jualbeli" />
                                <x-form-file-input name="kk" label="KK" group="jualbeli" />
                                <x-form-file-input name="akta_nikah" label="Akta Nikah" group="jualbeli" />
                                <x-form-file-input name="npwp" label="NPWP" group="jualbeli" />
                                <x-form-file-input name="sertifikat_tanah" label="Sertifikat Tanah" group="jualbeli" />
                                <x-form-file-input name="sppt_pbb" label="SPPT PBB" group="jualbeli" />
                                <x-form-file-input name="imb" label="IMB" group="jualbeli" />
                                <x-form-file-input name="sspd_bpthb" label="SSPD BPHTB" group="jualbeli" />
                                <x-form-file-input name="pph" label="PPH" group="jualbeli" />
                            </div>

                            <div id="hibah-group" class="file-input-group" style="display:none;">
                                <x-form-file-input name="ktp" label="KTP" group="hibah" />
                                <x-form-file-input name="kk" label="KK" group="hibah" />
                                <x-form-file-input name="npwp" label="NPWP" group="hibah" />
                                <x-form-file-input name="silsilah_waris" label="Silsilah Waris" group="hibah" />
                                <x-form-file-input name="sertifikat_tanah" label="Sertifikat Tanah" group="hibah" />
                                <x-form-file-input name="sppt_pbb" label="SPPT PBB" group="hibah" />
                                <x-form-file-input name="sspd_bpthb" label="SSPD BPHTB" group="hibah" />
                            </div>

                            <div id="hak-tanggungan-group" class="file-input-group" style="display:none;">
                                <x-form-file-input name="ktp" label="KTP" group="haktanggungan" />
                                <x-form-file-input name="kk" label="KK" group="haktanggungan" />
                                <x-form-file-input name="npwp" label="NPWP" group="haktanggungan" />
                                <x-form-file-input name="sertifikat_tanah" label="Sertifikat Tanah"
                                    group="haktanggungan" />
                                <x-form-file-input name="sppt_pbb" label="SPPT PBB" group="haktanggungan" />
                                <x-form-file-input name="sspd_bpthb" label="SSPD BPHTB" group="haktanggungan" />
                            </div>

                            <div id="waris-group" class="file-input-group" style="display:none;">
                                <x-form-file-input name="ktp" label="KTP" group="waris" />
                                <x-form-file-input name="kk" label="KK" group="waris" />
                                <x-form-file-input name="silsilah_waris" label="Silsilah Waris" group="waris" />
                                <x-form-file-input name="akta_kematian" label="Akta Kematian" group="waris" />
                                <x-form-file-input name="pernyataan_waris" label="Pernyataan Waris" group="waris" />
                                <x-form-file-input name="sppt_pbb" label="SPPT PBB" group="waris" />
                                <x-form-file-input name="sspd_bpthb" label="SSPD BPHTB" group="waris" />
                            </div>

                            {{-- Keterangan dan Status --}}
                            <div class="form-group">
                                <label for="status_permohonan">Status Permohonan</label>
                                <select class="form-select" id="status_permohonan" name="status_permohonan" required>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="data berkas kurang">Data Berkas Kurang</option>
                                    <option value="akan diproses">Akan Diproses</option>
                                    <option value="dalam diproses">Dalam Diproses</option>
                                    <option value="diterima">Diterima</option>
                                    <option value="ditolak">Ditolak</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="keterangan_permohonan">Keterangan Permohonan</label>
                                <textarea class="form-control" id="keterangan_permohonan" name="keterangan_permohonan" rows="3"
                                    placeholder="Tambahkan keterangan jika diperlukan...">{{ old('keterangan_permohonan') }}</textarea>
                            </div>

                            {{-- Tombol Aksi --}}
                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-primary btn-round">Tambah Data</button>
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
        // Menangani perubahan pada dropdown jenis permohonan
        document.getElementById('jenis_permohonan').addEventListener('change', function() {
            // Sembunyikan semua grup input file terlebih dahulu
            const allGroups = document.querySelectorAll('.file-input-group');
            allGroups.forEach(group => {
                group.style.display = 'none';
                // Nonaktifkan semua input di dalamnya agar tidak terkirim bersama form
                group.querySelectorAll('input[type="file"]').forEach(input => {
                    input.disabled = true;
                });
            });

            // Tampilkan grup yang sesuai dengan pilihan
            const selectedValue = this.value.replace(/\s+/g, '-'); // Mengubah "jual beli" menjadi "jual-beli"
            if (selectedValue) {
                const targetGroup = document.getElementById(selectedValue + '-group');
                if (targetGroup) {
                    targetGroup.style.display = 'block';
                    // Aktifkan kembali input di dalam grup yang ditampilkan
                    targetGroup.querySelectorAll('input[type="file"]').forEach(input => {
                        input.disabled = false;
                    });
                }
            }
        });

        // Fungsi untuk menampilkan preview gambar setelah dipilih
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
@endsection
