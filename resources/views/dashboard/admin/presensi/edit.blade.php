@extends('layouts.dashboard')

@section('dashboard-title', 'Dashboard Admin')

@section('content')
    <h3 class="mb-3">Detail Presensi Siswa</h3>

    <x-success-alert />

    <form action="{{ route('dashboard.admin.presensi.update', [$presensi]) }}" class="d-none" method="POST"
        id="update-presensi-form">
        @csrf
        @method('PATCH')

        <input type="text" name="keterangan" id="keterangan">
    </form>

    <div class="mb-3">
        <label for="nis" class="form-label">NIS</label>
        <input type="text" name="nis" id="nis" class="form-control" value="{{ $presensi->siswa->nis }}"
            disabled>
    </div>

    <div class="mb-3">
        <label for="nisn" class="form-label">NISN</label>
        <input type="text" name="nisn" id="nisn" class="form-control" value="{{ $presensi->siswa->nisn }}"
            disabled>
    </div>

    <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" name="nama" id="nama" class="form-control" value="{{ $presensi->siswa->nama }}"
            disabled>
    </div>

    <div class="mb-3">
        <label for="tanggal_hadir" class="form-label">Tanggal</label>
        <input type="text" name="tanggal_hadir" id="tanggal_hadir" class="form-control"
            value="{{ $presensi->tanggal_hadir }}" disabled>
    </div>

    <div class="mb-3">
        <label for="waktu_hadir" class="form-label">Waktu Hadir</label>
        <input type="text" name="waktu_hadir" id="waktu_hadir" class="form-control"
            value="{{ $presensi->waktu_hadir ?? '-' }}" disabled>
    </div>

    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <input type="text" name="status" id="status" class="form-control"
            value="{{ $presensi->keterangan ? Str::title($presensi->keterangan) : ($presensi->waktu_hadir ? 'Hadir' : 'Belum presensi') }}"
            disabled>
    </div>

    <div class="mb-3">
        <label class="form-label">Aksi</label>
        <div class="d-flex" id="presensi-actions">
            @if ($presensi->keterangan)
                <button class="btn btn-outline-primary me-3" data-value="hadir">
                    <span class="iconify b-icon" data-icon="bi:person-check"></span> Hadir
                </button>
            @endif

            @if ($presensi->keterangan != 'tanpa keterangan')
                <button class="btn btn-outline-danger me-3" data-value="tanpa keterangan">
                    <span class="iconify b-icon" data-icon="bi:person-x"></span> Tanpa Keterangan
                </button>
            @endif

            @if ($presensi->keterangan != 'izin')
                <button class="btn btn-outline-info me-3" data-value="izin">
                    <span class="iconify b-icon" data-icon="bi:envelope"></span> Izin
                </button>
            @endif

            @if ($presensi->keterangan != 'sakit')
                <button class="btn btn-outline-info" data-value="sakit">
                    <span class="iconify b-icon" data-icon="bi:envelope"></span> Sakit
                </button>
            @endif
        </div>
    </div>

    <div class="clearfix">
        <a href="{{ route('dashboard.admin.presensi.index', ['search' => $search, 'tanggal' => $tanggal]) }}"
            class="btn btn-outline-secondary float-end">
            Kembali
        </a>
    </div>
@endsection
