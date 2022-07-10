@extends('layouts.dashboard')

@section('dashboard-title', 'Dashboard Admin')

@section('content')

    <h3 class="mb-3">Edit Data Siswa</h3>

    <x-success-alert />

    <form action="{{ route('dashboard.admin.siswa.update', [$siswa->nis]) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="nis" class="form-label">NIS</label>
            <input type="text" name="nis" id="nis" class="form-control @error('nis') is-invalid @enderror"
                value="{{ old('nis', $siswa->nis) }}">
            @error('nis')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="nisn" class="form-label">NISN</label>
            <input type="text" name="nisn" id="nisn" class="form-control @error('nisn') is-invalid @enderror"
                value="{{ old('nisn', $siswa->nisn) }}">
            @error('nisn')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"
                value="{{ old('nama', $siswa->nama) }}">
            @error('nama')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mt-5 d-flex justify-content-end">
            <a href="{{ route('dashboard.admin.siswa.index') }}" class="btn btn-outline-secondary me-3">Kembali</a>
            <button type="submit" class="btn btn-primary">
                <span class="iconify b-icon" data-icon="carbon:save"></span> Simpan
            </button>
        </div>
    </form>
@endsection
