@extends('layouts.dashboard')

@section('dashboard-title', 'Dashboard Admin')

@section('content')


    <h3 class="mb-3">Pengaturan Presensi</h3>

    <x-success-alert />

    <h4 class="mb-3">Jadwal</h4>

    <form action="{{ route('dashboard.admin.presensi.pengaturan.updateJadwalGanjil') }}" method="POST" class="mb-3">
        @csrf
        @method('PUT')

        <h5>Semester Ganjil</h5>
        <div class="row mb-3">
            <div class="col">
                <label for="ganjil-mulai" class="form-label">Tanggal Mulai</label>
                <input type="date" name="ganjil_mulai" id="ganjil-mulai"
                    class="form-control @error('ganjil_mulai', 'jadwal-ganjil') is-invalid @enderror"
                    value="{{ old('ganjil_mulai', $jadwal['ganjil'] ? $jadwal['ganjil']->tanggal_mulai : null) }}">
                @error('ganjil_mulai', 'jadwal-ganjil')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col">
                <label for="ganjil-akhir" class="form-label">Tanggal Akhir</label>
                <input type="date" name="ganjil_akhir" id="ganjil-akhir"
                    class="form-control @error('ganjil_akhir', 'jadwal-ganjil') is-invalid @enderror"
                    value="{{ old('ganjil_akhir', $jadwal['ganjil'] ? $jadwal['ganjil']->tanggal_akhir : null) }}">
                @error('ganjil_akhir', 'jadwal-ganjil')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="mb-3 clearfix">
            <button type="submit" class="btn btn-primary float-end">
                <span class="iconify b-icon" data-icon="carbon:save"></span> Simpan
            </button>
        </div>
    </form>

    <form action="{{ route('dashboard.admin.presensi.pengaturan.updateJadwalGenap') }}" method="POST" class="mb-3">
        @csrf
        @method('PUT')

        <h5>Semester Genap</h5>
        <div class="row mb-3">
            <div class="col">
                <label for="genap-mulai" class="form-label">Tanggal Mulai</label>
                <input type="date" name="genap_mulai" id="genap-mulai"
                    class="form-control @error('genap_mulai', 'jadwal-genap') is-invalid @enderror"
                    value="{{ old('genap_mulai', $jadwal['genap'] ? $jadwal['genap']->tanggal_mulai : null) }}">
                @error('genap_mulai', 'jadwal-genap')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col">
                <label for="genap-akhir" class="form-label">Tanggal Akhir</label>
                <input type="date" name="genap_akhir" id="genap-akhir"
                    class="form-control @error('genap_akhir', 'jadwal-genap') is-invalid @enderror"
                    value="{{ old('genap_akhir', $jadwal['genap'] ? $jadwal['genap']->tanggal_akhir : null) }}">
                @error('genap_akhir', 'jadwal-genap')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="mb-3 clearfix">
            <button type="submit" class="btn btn-primary float-end">
                <span class="iconify b-icon" data-icon="carbon:save"></span> Simpan
            </button>
        </div>
    </form>


    <h4 class="mb-3 mt-3">Tanggal Libur</h4>
    <div class="mb-3">
        <form action="{{ route('dashboard.admin.presensi.pengaturan.storeTanggalLibur') }}" method="POST"
            class="mb-3">
            @csrf
            <div class="d-flex justify-content-center align-items-center">
                <div class="d-flex align-items-start">
                    <div class="me-2">
                        <input type="date" name="tanggal_libur" id="tanggal-libur"
                            class="form-control @error('tanggal_libur', 'tanggal-libur') is-invalid @enderror"
                            value="{{ old('tanggal_libur') }}">
                        @error('tanggal_libur', 'tanggal-libur')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button class="btn btn-outline-primary">
                        <span class="iconify b-icon" data-icon="bi:plus"></span>
                    </button>
                </div>
            </div>
        </form>

        <div class="row row-cols-1 row-cols-lg-4 g-3">
            @foreach ($tanggalLibur as $tl)
                @php
                    $parsed = Date::parse($tl->tanggal);
                @endphp
                <div class="col">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">{{ $parsed->isoFormat('dddd') }}</h5>
                            <p class="card-text">{{ $parsed->isoFormat('LL') }}
                            </p>
                            <form action="{{ route('dashboard.admin.presensi.pengaturan.destroyTanggalLibur', [$tl]) }}"
                                method="POST" onsubmit="return confirm('Hapus tanggal libur ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    <span class="iconify b-icon" data-icon="bi:trash"></span> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="clearfix">
        <a href="{{ route('dashboard.admin.presensi.index') }}" class="btn btn-outline-secondary float-end">
            Kembali
        </a>
    </div>
@endsection
