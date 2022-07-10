@extends('layouts.dashboard')

@section('dashboard-title', 'Dashboard Admin')

@section('content')

    <h3 class="mb-3">Tambah Admin</h3>

    <x-success-alert />

    <form action="{{ route('dashboard.admin.admin.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"
                value="{{ old('nama') }}">
            @error('nama')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>



        <div class="mt-5 d-flex justify-content-end">
            <a href="{{ route('dashboard.admin.admin.index') }}" class="btn btn-outline-secondary me-3">Kembali</a>
            <button type="submit" class="btn btn-primary">
                <span class="iconify b-icon" data-icon="carbon:save"></span> Simpan
            </button>
        </div>
    </form>
@endsection
