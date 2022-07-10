@extends('layouts.dashboard')

@section('dashboard-title', 'Dashboard Admin')

@section('content')

    <h3 class="mb-3">Edit Predikat Sikap</h3>

    <x-success-alert />

    <form action="{{ route('dashboard.admin.predikat-sikap.update', [$predikatSikap]) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="predikat" class="form-label">Predikat</label>
            <input type="text" name="predikat" id="predikat" class="form-control @error('predikat') is-invalid @enderror"
                value="{{ $predikatSikap->predikat }}" disabled>
            @error('predikat')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="deskripsi_spiritual" class="form-label">Deskripsi Spiritual</label>
            <textarea name="deskripsi_spiritual" id="deskripsi_spiritual"
                class="form-control @error('deskripsi_spiritual') is-invalid @enderror">{{ old('deskripsi_spiritual', $predikatSikap->deskripsi_spiritual) }}</textarea>
            @error('deskripsi_spiritual')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="deskripsi_sosial" class="form-label">Deskripsi Sosial</label>
            <textarea name="deskripsi_sosial" id="deskripsi_sosial"
                class="form-control @error('deskripsi_sosial') is-invalid @enderror">{{ old('deskripsi_sosial', $predikatSikap->deskripsi_sosial) }}</textarea>
            @error('deskripsi_sosial')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mt-5 d-flex justify-content-end">
            <a href="{{ route('dashboard.admin.predikat-sikap.index') }}"
                class="btn btn-outline-secondary me-3">Kembali</a>
            <button type="submit" class="btn btn-primary">
                <span class="iconify b-icon" data-icon="carbon:save"></span> Simpan
            </button>
        </div>
    </form>
@endsection
