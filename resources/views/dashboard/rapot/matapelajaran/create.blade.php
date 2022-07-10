@extends('layouts.dashboard')

@section('dashboard-title', 'Dashboard Raport')

@section('content')

    <h3 class="mb-3">Tambah Lintas Minat Siswa</h3>

    <x-success-alert />

    <form action="{{ route('dashboard.rapot.mapel.store', [$siswa->nis]) }}" method="POST">
        @csrf
        <input type="hidden" name="semester" value="{{ $semester }}">

        <div class="row gx-5 row-cols-1 row-cols-md-2">
            <div class="col">
                <x-rapot.wali-kelas.data-siswa :siswa="$siswa" :semester="$semester" :inline="false" />
            </div>

            <div class="col">
                <div class="mb-3">
                    <label for="kode" class="form-label">Mata Pelajaran</label>
                    <select name="kode" id="kode" class="form-select @error('kode') is-invalid @enderror">
                        @foreach ($daftar_mapel as $mapel)
                            <option value="{{ $mapel->kode }}">{{ $mapel->nama }}</option>
                        @endforeach
                    </select>
                    @error('kode')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="kbm" class="form-label">KBM</label>
                    <input type="text" class="form-control nilai @error('kbm') is-invalid @enderror" id="kbm"
                        name="kbm" value="{{ old('kbm') }}">
                    @error('kbm')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="pengetahuan" class="form-label">Pengetahuan</label>
                    <input type="text" class="form-control nilai @error('pengetahuan') is-invalid @enderror"
                        id="pengetahuan" name="pengetahuan" value="{{ old('pengetahuan') }}">
                    @error('pengetahuan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="keterampilan" class="form-label">Keterampilan</label>
                    <input type="text" class="form-control nilai @error('keterampilan') is-invalid @enderror"
                        id="keterampilan" name="keterampilan" value="{{ old('keterampilan') }}">
                    @error('keterampilan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="kd_pengetahuan" class="form-label">KD Pengetahuan</label>
                    <textarea name="kd_pengetahuan" id="kd_pengetahuan" class="form-control">{{ old('kd_pengetahuan') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="kd_keterampilan" class="form-label">KD Keterampilan</label>
                    <textarea name="kd_keterampilan" id="kd_keterampilan" class="form-control">{{ old('kd_keterampilan') }}</textarea>
                </div>

                <div class="d-flex mt-5 justify-content-end">
                    <a href="{{ route('dashboard.rapot.show', [$siswa->nis, 'semester' => $semester]) }}"
                        class="btn btn-outline-secondary me-3">Kembali</a>
                    <button type="submit" class="btn btn-primary"><span class="iconify b-icon"
                            data-icon="carbon:save"></span>
                        Simpan</button>
                </div>
            </div>
        </div>




    </form>

@endsection
