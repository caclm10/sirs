@extends('layouts.dashboard')

@section('dashboard-title', 'Dashboard Raport')

@section('content')
    <h3 class="mb-3">Edit Nilai Siswa</h3>
    <x-success-alert />

    @if ($isLintasMinat)
        <form
            action="{{ route('dashboard.rapot.mapel.destroy', [$siswa->nis, $mata_pelajaran->kode, 'semester' => $semester]) }}"
            method="POST" class="d-flex justify-content-end"
            onsubmit="return confirm('Hapus nilai mata pelajaran siswa ini?')">
            @csrf
            @method('DELETE')

            <button class="btn btn-danger"><span class="iconify b-icon" data-icon="bi:trash"></span> Hapus</button>
        </form>
    @endif

    <form action="{{ route('dashboard.rapot.mapel.update', [$siswa->nis, $mata_pelajaran->kode]) }}" method="POST">
        @csrf
        @method('PATCH')
        <input type="hidden" name="semester" value="{{ $semester }}">

        <div class="row row-cols-1 row-cols-md-2 gx-5">
            <div class="col">
                <x-rapot.wali-kelas.data-siswa :siswa="$siswa" :semester="$semester" :inline="false" />
            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="mata_pelajaran" class="form-label">Mata Pelajaran</label>
                    <input type="text" readonly class="form-control" id="mata_pelajaran"
                        value="{{ $mata_pelajaran->nama }} ({{ $mata_pelajaran->peminatan == 'umum' ? 'Umum' : 'Peminatan' }})">
                </div>

                {{-- <div class="mb-3">
                    <label for="kode" class="form-label">Kode</label>
                    <input type="text" readonly class="form-control" id="kode"
                        value="{{ $mata_pelajaran->kode }}">
                </div> --}}

                <div class="mb-3">
                    <label for="kbm" class="form-label">KBM</label>
                    <input type="text" class="form-control nilai @error('kbm') is-invalid @enderror" id="kbm"
                        name="kbm" value="{{ old('kbm', $mata_pelajaran->nilai->kbm) }}">
                    @error('kbm')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="pengetahuan" class="form-label">Pengetahuan</label>
                    <input type="text" class="form-control nilai @error('pengetahuan') is-invalid @enderror"
                        id="pengetahuan" name="pengetahuan"
                        value="{{ old('pengetahuan', $mata_pelajaran->nilai->pengetahuan) }}">
                    @error('pengetahuan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="keterampilan" class="form-label">Keterampilan</label>
                    <input type="text" class="form-control nilai @error('keterampilan') is-invalid @enderror"
                        id="keterampilan" name="keterampilan"
                        value="{{ old('keterampilan', $mata_pelajaran->nilai->keterampilan) }}">
                    @error('keterampilan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="kd_pengetahuan" class="form-label">KD Pengetahuan</label>
                    <textarea name="kd_pengetahuan" id="kd_pengetahuan" class="form-control">{{ old('kd_pengetahuan', $mata_pelajaran->nilai->kd_pengetahuan) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="kd_keterampilan" class="form-label">KD Keterampilan</label>
                    <textarea name="kd_keterampilan" id="kd_keterampilan" class="form-control">{{ old('kd_keterampilan', $mata_pelajaran->nilai->kd_keterampilan) }}</textarea>
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
