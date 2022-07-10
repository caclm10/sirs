@extends('layouts.dashboard')

@section('dashboard-title', 'Dashboard Admin')

@section('content')

    <h3 class="mb-3">Edit Mata Pelajaran</h3>

    <x-success-alert />

    <form action="{{ route('dashboard.admin.mapel.update', [$mapel->kode]) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"
                value="{{ old('nama', $mapel->nama) }}">
            @error('nama')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="kelompok" class="form-label">Kelompok</label>
            <input type="text" name="kelompok" id="kelompok" class="form-control" value="{{ $mapel->kelompok }}"
                disabled>
        </div>

        <div class="mb-3">
            <label for="peminatan" class="form-label">Peminatan</label>
            <input type="text" name="peminatan" id="peminatan"
                class="form-control @if ($mapel->peminatan == 'umum') text-capitalize @else text-uppercase @endif"
                value="{{ $mapel->peminatan }}" disabled>
        </div>

        <div class="mt-5 d-flex justify-content-end">
            <a href="{{ route('dashboard.admin.mapel.index') }}" class="btn btn-outline-secondary me-3">Kembali</a>
            <button type="submit" class="btn btn-primary">
                <span class="iconify b-icon" data-icon="carbon:save"></span> Simpan
            </button>
        </div>
    </form>
@endsection
