@extends('layouts.dashboard')

@section('dashboard-title', 'Dashboard Raport')

@section('content')

    <h3 class="mb-3">Edit Ekstrakurikuler Siswa</h3>

    <x-success-alert />

    <form
        action="{{ route('dashboard.rapot.ekskul.destroy', [$siswa->nis, $ekstrakurikuler->kode, 'semester' => $semester]) }}"
        method="POST" class="d-flex justify-content-end" onsubmit="return confirm('Hapus nilai esktrakurikuler siswa ini?')">
        @csrf
        @method('DELETE')

        <button class="btn btn-danger"><span class="iconify b-icon" data-icon="bi:trash"></span> Hapus</button>
    </form>

    <form action="{{ route('dashboard.rapot.ekskul.update', [$siswa->nis, $ekstrakurikuler->kode]) }}" method="POST">

        @csrf
        @method('PATCH')

        <input type="hidden" name="semester" value="{{ $semester }}">

        <div class="row gx-5 row-cols-1 row-cols-md-2">
            <div class="col">
                <x-rapot.wali-kelas.data-siswa :siswa="$siswa" :semester="$semester" :inline="false" />
            </div>

            <div class="col">
                <div class="mb-3">
                    <label for="nama" class="form-label">Ektrakurikuler</label>
                    <input type="text" readonly class="form-control" id="nama" name="nama"
                        value="{{ $ekstrakurikuler->nama }}">
                </div>
                <div class="mb-3">
                    <label for="nilai" class="form-label">Nilai</label>
                    <input type="number" name="nilai" id="nilai" class="form-control"
                        value="{{ $ekstrakurikuler->pivot->nilai }}">
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control">{{ $ekstrakurikuler->pivot->deskripsi }}</textarea>
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
