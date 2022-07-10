@extends('layouts.dashboard')

@section('dashboard-title', 'Dashboard Admin')

@section('content')

    <h3 class="mb-3">Edit Data Wali Kelas</h3>

    <x-success-alert />

    <form action="{{ route('dashboard.admin.wali-kelas.update', [$waliKelas->nip]) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="nip" class="form-label">NIP</label>
            <input type="text" name="nip" id="nip" class="form-control @error('nip') is-invalid @enderror"
                value="{{ old('nip', $waliKelas->nip) }}">
            @error('nip')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>


        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"
                value="{{ old('nama', $waliKelas->nama) }}">
            @error('nama')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mt-5 d-flex justify-content-end">
            <a href="{{ route('dashboard.admin.wali-kelas.index') }}" class="btn btn-outline-secondary me-3">Kembali</a>
            <button type="submit" class="btn btn-primary">
                <span class="iconify b-icon" data-icon="carbon:save"></span> Simpan
            </button>
        </div>
    </form>
@endsection
