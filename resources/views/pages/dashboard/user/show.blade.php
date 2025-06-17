@extends('layouts.dashboard')

@section('container')
    <div class="page-inner">
        <div class="row">
            <div class="card">
                <div class="col-12">
                    <img id="preview" src="{{ asset('storage/' . $user->foto_user) }}" alt="Preview Foto"
                        style="display:block; max-width: 200px; margin-top: 10px;" />
                </div>
            </div>
        </div>
    @endsection
