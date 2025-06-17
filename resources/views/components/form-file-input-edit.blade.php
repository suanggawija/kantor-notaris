{{--
    Komponen ini digunakan untuk form input file pada halaman EDIT.
    Komponen ini menampilkan gambar yang sudah ada dan preview untuk gambar baru.

    Props:
    - name: Nama unik untuk input file (e.g., 'ktp', 'sertifikat_tanah').
    - label: Teks yang akan ditampilkan sebagai label (e.g., 'KTP', 'Sertifikat Tanah').
    - group: Nama grup permohonan untuk membuat ID yang unik (e.g., 'jualbeli', 'hibah').
    - existingValue: URL atau path ke gambar yang sudah tersimpan.
--}}
@props(['name', 'label', 'group', 'existingValue' => null])

@php
    $inputId = "{$name}-{$group}";
    $previewId = "{$name}-preview-{$group}";
@endphp

<div class="form-group">
    <label for="{{ $inputId }}">{{ $label }}</label>

    {{-- Tampilkan gambar yang sudah ada jika tersedia --}}
    @if ($existingValue)
        <div class="mb-2">
            <img src="{{ asset('storage/' . $existingValue) }}" alt="Gambar saat ini"
                style="max-width: 200px; margin-top: 10px; border-radius: 8px; display: block;">
            <small class="text-muted">Gambar saat ini. Unggah file baru untuk menggantinya.</small>
        </div>
    @endif

    <input type="file" class="form-control-file" id="{{ $inputId }}" name="{{ $name }}" accept="image/*"
        onchange="previewImage(event, '{{ $previewId }}')" />

    {{-- Area preview untuk gambar baru yang akan diunggah --}}
    <img id="{{ $previewId }}" src="#" alt="Preview Gambar Baru"
        style="display:none; max-width: 200px; margin-top: 10px; border-radius: 8px;" />
</div>
