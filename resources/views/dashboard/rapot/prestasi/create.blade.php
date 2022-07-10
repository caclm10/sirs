@extends('layouts.dashboard')

@section('dashboard-title', 'Dashboard Raport')

@section('content')
    <h3 class="mb-3">Tambah Prestasi Siswa</h3>

    <x-success-alert />

    @error('prestasi')
        <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
            <span class="iconify flex-shrink-0 me-2" data-icon="bi:exclamation-triangle-fill" data-width="24"
                data-height="24"></span>
            <div>
                {{ $message }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @enderror

    <form action="{{ route('dashboard.rapot.prestasi.store', [$siswa->nis]) }}" method="POST">
        @csrf
        <input type="hidden" name="semester" value="{{ $semester }}">

        <div class="row gx-5 row-cols-1 row-cols-md-2">
            <div class="col">
                <x-rapot.wali-kelas.data-siswa :siswa="$siswa" :semester="$semester" :inline="false" />
            </div>

            <div class="col">
                <div class="mb-3">
                    <label for="jenis_kegiatan" class="form-label">Jenis Kegiatan</label>
                    <input type="text" name="jenis_kegiatan" id="jenis_kegiatan"
                        class="form-control @error('jenis_kegiatan') is-invalid @enderror">
                    @error('jenis_kegiatan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
                </div>
            </div>
        </div>



        <div class="d-flex mt-5 justify-content-end">
            <a href="{{ route('dashboard.rapot.show', [$siswa->nis, 'semester' => $semester]) }}"
                class="btn btn-outline-secondary me-3">Kembali</a>
            <button type="submit" class="btn btn-primary"><span class="iconify b-icon" data-icon="carbon:save"></span>
                Simpan</button>
        </div>
    </form>
@endsection
