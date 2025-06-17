@props(['name', 'label', 'group'])

@php
    $inputId = "{$name}-{$group}";
    $previewId = "{$name}-preview-{$group}";
@endphp

<div class="form-group">
    <label for="{{ $inputId }}">{{ $label }}</label>
    <input type="file" class="form-control-file" id="{{ $inputId }}" name="{{ $name }}" accept="image/*"
        onchange="previewImage(event, '{{ $previewId }}')" {{-- Input di dalam grup yang tersembunyi akan dinonaktifkan secara otomatis oleh JS --}} disabled />
    <img id="{{ $previewId }}" src="#" alt="Preview Gambar"
        style="display:none; max-width: 200px; margin-top: 10px; border-radius: 8px;" />
</div>
