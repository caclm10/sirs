@extends('layouts.dashboard')

@section('dashboard-title', 'Dashboard Admin')

@section('content')

    <h3 class="mb-3">Tambah Mata Pelajaran</h3>

    <x-success-alert />

    <form action="{{ route('dashboard.admin.mapel.store') }}" method="POST">
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

        <div class="mb-3">
            <label for="kelompok" class="form-label">Kelompok</label>
            <select name="kelompok" id="kelompok" class="form-select @error('kelompok') is-invalid @enderror">
                @foreach (['a', 'b', 'c'] as $kelompok)
                    <option value="{{ $kelompok }}">{{ $kelompok }}</option>
                @endforeach
            </select>
            @error('kelompok')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="peminatan" class="form-label">Peminatan</label>
            <select name="peminatan" id="peminatan" class="form-select @error('peminatan') is-invalid @enderror">
                @foreach (['Umum', 'MIPA', 'IPS'] as $peminatan)
                    <option value="{{ \Str::lower($peminatan) }}">{{ $peminatan }}</option>
                @endforeach
            </select>
            @error('peminatan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>


        <div class="mt-5 d-flex justify-content-end">
            <a href="{{ route('dashboard.admin.mapel.index') }}" class="btn btn-outline-secondary me-3">Kembali</a>
            <button type="submit" class="btn btn-primary">
                <span class="iconify b-icon" data-icon="carbon:save"></span> Simpan
            </button>
        </div>
    </form>
@endsection
