@extends('layouts.dashboard')

@section('title', 'Karyawan - Edit')
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
                                <form action="{{ route('user.update', $user->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Nama" value="{{ old('name', $user->name) }}" />
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Email" value="{{ old('email', $user->email) }}" />
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password <small class="text-muted">(Kosongkan jika tidak ingin
                                                mengubah)</small></label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Password Baru" />
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_user">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="nama_user" name="nama_user"
                                            placeholder="Nama Lengkap" value="{{ old('nama_user', $user->nama_user) }}" />
                                    </div>
                                    <div class="form-group">
                                        <label for="jabatan_user">Jabatan User</label>
                                        <select class="form-select" id="jabatan_user" name="jabatan_user">
                                            <option value="admin"
                                                {{ old('jabatan_user', $user->jabatan_user) == 'admin' ? 'selected' : '' }}>
                                                admin</option>
                                            <option value="user"
                                                {{ old('jabatan_user', $user->jabatan_user) == 'user' ? 'selected' : '' }}>
                                                user</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="no_telp_user">No Telepon</label>
                                        <input type="tel" class="form-control" id="no_telp_user" name="no_telp_user"
                                            placeholder="Masukkan No Telepon" pattern="[0-9]{10,15}"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                            value="{{ old('no_telp_user', $user->no_telp_user) }}" />
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat_user">Alamat User</label>
                                        <input type="text" class="form-control" id="alamat_user" name="alamat_user"
                                            placeholder="Alamat User"
                                            value="{{ old('alamat_user', $user->alamat_user) }}" />
                                    </div>
                                    <div class="form-group">
                                        <label for="foto_user">Foto User</label>
                                        <input type="file" class="form-control-file" id="foto_user" name="foto_user"
                                            accept="image/*" onchange="previewImage(event)" />
                                        @if ($user->foto_user)
                                            <img id="preview" src="{{ asset('storage/' . $user->foto_user) }}"
                                                alt="Preview Foto"
                                                style="display:block; max-width: 200px; margin-top: 10px;" />
                                        @else
                                            <img id="preview" src="#" alt="Preview Foto"
                                                style="display:none; max-width: 200px; margin-top: 10px;" />
                                        @endif
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
@endsection
