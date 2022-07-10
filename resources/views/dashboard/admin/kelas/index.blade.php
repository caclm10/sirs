@extends('layouts.dashboard')

@section('dashboard-title', 'Dashboard Admin')

@section('content')
    <h2 class="mb-3">Daftar Kelas</h2>

    <x-success-alert />

    <div class="d-flex justify-content-end mb-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahKelasModal">+
            Kelas</button>
    </div>

    <div class="table-container">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <th scope="col">#</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Wali</th>
                    <th scope="col">Siswa</th>
                    <th scope="col" style="width:17%">Aksi</th>
                </thead>
                <tbody>
                    @foreach ($kelas as $k)
                        <tr>
                            <th scope="row">{{ $kelas->firstItem() + $loop->iteration - 1 }}</th>
                            <td>{{ $k->nama }}</td>
                            <td>{{ $k->wali ? $k->wali->nama : '-' }}</td>
                            <td>{{ $k->siswa->count() }}</td>
                            <td class="d-flex">
                                <a href="{{ route('dashboard.admin.kelas.show', [$k->id]) }}"
                                    class="btn btn-sm btn-outline-info me-2">
                                    <span class="iconify mb-1" data-icon="ci:show"></span> Lihat
                                </a>
                                <form action="{{ route('dashboard.admin.kelas.destroy', [$k->id]) }}" method="POST"
                                    onsubmit="return confirm('Hapus kelas ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">
                                        <span class="iconify mb-1" data-icon="carbon:trash-can"></span> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                {{ $kelas->links() }}
            </div>
        </div>
    </div>

    @if ($errors->any())
        <input type="hidden" name="error-tambah-kelas">
    @endif

    <!-- Modal -->
    <div class="modal fade" id="tambahKelasModal" tabindex="-1" aria-labelledby="tambahKelasModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahKelasModalLabel">Tambah Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @error('kelas')
                        <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                            <span class="iconify flex-shrink-0 me-2" data-icon="bi:exclamation-triangle-fill" data-width="24"
                                data-height="24"></span>
                            <div>
                                {{ $message }}
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @enderror

                    <form action="{{ route('dashboard.admin.kelas.store') }}" method="POST" id="form-tambah-kelas">
                        @csrf
                        <div class="mb-3">
                            <label for="tingkat" class="form-label">Tingkat</label>
                            <select name="tingkat" id="tingkat"
                                class="form-select @error('tingkat') is-invalid @enderror">
                                @for ($i = 10; $i <= 12; $i++)
                                    <option value="{{ $i }}" @if (old('tingkat') == $i) selected @endif>
                                        {{ \Angka::romawi($i) }}</option>
                                @endfor
                            </select>
                            @error('tingkat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="peminatan" class="form-label">Peminatan</label>
                            <select name="peminatan" id="peminatan"
                                class="form-select @error('peminatan') is-invalid @enderror">
                                @foreach (['mipa', 'ips'] as $peminatan)
                                    <option value="{{ $peminatan }}" @if (old('peminatan') == $peminatan) selected @endif>
                                        {{ \Str::upper($peminatan) }}</option>
                                @endforeach
                            </select>
                            @error('peminatan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="ke" class="form-label">Ke</label>
                            <input type="text" name="ke" id="ke"
                                class="form-control nilai @error('ke') is-invalid @enderror" value="{{ old('ke') }}">
                            @error('ke')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" form="form-tambah-kelas" class="btn btn-primary">
                        <span class="iconify b-icon" data-icon="carbon:save"></span> Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection
