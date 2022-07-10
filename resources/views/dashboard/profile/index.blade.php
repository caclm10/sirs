@extends('layouts.dashboard')

@section('dashboard-title', 'Dashboard Profil')

@section('content')
    <h2 class="text-capitalize mb-3">Profil {{ \AppHelper::getActiveGuard() }}</h2>

    <x-success-alert />

    <form action="{{ route('dashboard.profil.update') }}" method="POST">
        @csrf
        @method('PATCH')

        @auth('siswa')
            <div class="mb-3">
                <label for="nis" class="form-label">NIS</label>
                <input type="text" id="nis" class="form-control" disabled value="{{ auth()->user()->nis }}">
            </div>
            <div class="mb-3">
                <label for="nisn" class="form-label">NISN</label>
                <input type="text" id="nisn" class="form-control" disabled value="{{ auth()->user()->nisn }}">
            </div>
        @endauth

        @auth('wali_kelas')
            <div class="mb-3">
                <label for="nip" class="form-label">NIP</label>
                <input type="text" id="nip" class="form-control" disabled value="{{ auth()->user()->nip }}">
            </div>
        @endauth

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"
                value="{{ old('nama', auth()->user()->nama) }}" @waliKelasOrSiswa disabled
                @endwaliKelasOrSiswa>
            @error('nama')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_lama" class="form-label">Password Lama</label>
            <input type="password" name="password_lama" id="password_lama"
                class="form-control @error('password_lama') is-invalid @enderror" value="{{ old('password_lama') }}">
            @error('password_lama')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password Baru</label>
            <input type="password" name="password" id="password"
                class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}">
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="d-flex justify-content-end mt-5">
            <button type="submit" class="btn btn-primary">
                <span class="iconify b-icon" data-icon="carbon:save"></span> Simpan
            </button>
        </div>
    </form>
@endsection
