@extends('layouts.dashboard')

@section('dashboard-title', 'Dashboard Raport')

@section('content')

    <h3 class="mb-3">Nilai Siswa</h3>

    <x-success-alert />

    <div class="mb-3 d-flex justify-content-end">
        <table>
            <tr>
                <td>Nama</td>
                <td>&nbsp; : &nbsp;</td>
                <td>{{ $siswa->nama }}</td>
            </tr>
            <tr>
                <td>NIS / NISN</td>
                <td>&nbsp; : &nbsp;</td>
                <td>{{ $siswa->nis }} / {{ $siswa->nisn }}</td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td>&nbsp; : &nbsp;</td>
                <td>{{ $siswa->kelas->nama }}</td>
            </tr>
            <tr>
                <td>Semester</td>
                <td>&nbsp; : &nbsp;</td>
                <td>
                    <select name="semester" id="semester" class="form-select form-select-sm">
                        @foreach (\Sekolah::semester($siswa->kelas->tingkat) as $sem)
                            @php $ganjilGenap = \Angka::ganjilAtauGenap($sem) @endphp
                            <option value="{{ $ganjilGenap }}" @if ($ganjilGenap == $semester) selected @endif
                                data-link="{{ route('dashboard.rapot.show', [$siswa->nis, 'semester' => $ganjilGenap]) }}">
                                {{ \Angka::romawi($sem) }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
        </table>
    </div>

    <form class="mb-3" action="{{ route('dashboard.rapot.sikap.update', [$siswa->nis]) }}" method="POST">
        @csrf
        @method('PATCH')
        <input type="hidden" name="nis" value="{{ $siswa->nis }}">
        <input type="hidden" name="semester" value="{{ $semester }}">

        <h4 class="mb-3">Nilai Sikap</h4>

        <div class="row g-3 mb-3">
            <div class="col">
                <div class="mb-3">
                    <label for="form-label">Predikat Spiritual</label>
                    <select name="predikat_spiritual" id="predikat_spiritual" class="form-select">
                        <option value=""></option>
                        @foreach ($predikatSikap as $ps)
                            <option value="{{ $ps->predikat }}" @if ($ps->predikat == $dataRapot['sikap']['spiritual']['predikat']) selected @endif>
                                {{ $ps->predikat }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="deskripsi_spiritual" class="form-label">Deskripsi Spiritual</label>
                    <textarea name="deskripsi_spiritual" id="deskripsi_spiritual" class="form-control">{{ old('deskripsi_spiritual', $dataRapot['sikap']['spiritual']['custom']) }}</textarea>
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="form-label">Predikat Sosial</label>
                    <select name="predikat_sosial" id="predikat_sosial" class="form-select">
                        <option value=""></option>
                        @foreach ($predikatSikap as $ps)
                            <option value="{{ $ps->predikat }}" @if ($ps->predikat == $dataRapot['sikap']['sosial']['predikat']) selected @endif>
                                {{ $ps->predikat }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="deskripsi_sosial" class="form-label">Deskripsi Sosial</label>
                    <textarea name="deskripsi_sosial" id="deskripsi_sosial" class="form-control">{{ old('deskripsi_spiritual', $dataRapot['sikap']['sosial']['custom']) }}</textarea>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary"><span class="iconify b-icon" data-icon="carbon:save"></span>
                Simpan</button>
        </div>
    </form>

    <h4 class="mb-3">Nilai Pengetahuan dan Keterampilan</h4>

    <div class="table-responsive mb-3">
        <table class="table table-hover table-bordered border-dark text-center">
            <thead class="align-middle">
                <tr>
                    <th scope="col" style="width: 53.5%">Mata Pelajaran</th>
                    <th scope="col">KBM</th>
                    <th scope="col">Pengetahuan</th>
                    <th scope="col">Keterampilan</th>
                    <th scope="col" style="width: 9.3%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <x-rapot.wali-kelas.nilai-mapel judul="Kelompok A (Umum)" :mata-pelajaran="$dataRapot['mapel']['a']" :nis="$siswa->nis"
                    :semester="$semester" />

                <x-rapot.wali-kelas.nilai-mapel judul="Kelompok B (Umum)" :mata-pelajaran="$dataRapot['mapel']['b']" :nis="$siswa->nis"
                    :semester="$semester" />

                <x-rapot.wali-kelas.nilai-mapel judul="Kelompok C (Peminatan)" :mata-pelajaran="$dataRapot['mapel']['c']" :nis="$siswa->nis"
                    :semester="$semester" />

                <x-rapot.wali-kelas.nilai-mapel judul="Lintas Minat" :mata-pelajaran="$dataRapot['mapel']['lintasMinat']" :nis="$siswa->nis"
                    :semester="$semester" />

                <tr>
                    <td>
                        <a href="{{ route('dashboard.rapot.mapel.create', [$siswa->nis, 'semester' => $semester]) }}"
                            class="btn btn-outline-primary btn-sm">
                            <span class="iconify mb-1" data-icon="carbon:add"></span> Tambah
                        </a>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>

    <h4 class="mb-3">Nilai Ektrakurikuler</h4>

    <div class="table-responsive mb-3">
        <table class="table table-hover table-bordered border-dark">
            <thead class="text-center">
                <tr>
                    <th scope="col" style="width: 53.5%">Nama</th>
                    <th scope="col">Nilai</th>
                    <th scope="col" style="width: 9.3%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataRapot['ekstrakurikuler'] as $ekskul)
                    <tr>
                        <td>{{ $ekskul->nama }}</td>
                        <td class="text-center">{{ $ekskul->pivot->nilai }}</td>
                        <td class="text-center">
                            <a href="{{ route('dashboard.rapot.ekskul.edit', [$siswa->nis, $ekskul->kode, 'semester' => $semester]) }}"
                                class="btn btn-outline-info btn-sm">
                                <span class="iconify" data-icon="carbon:edit"></span> Edit
                            </a>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td class="text-center">
                        <a href="{{ route('dashboard.rapot.ekskul.create', [$siswa->nis, 'semester' => $semester]) }}"
                            class="btn btn-outline-primary btn-sm">
                            <span class="iconify mb-1" data-icon="carbon:add"></span> Tambah
                        </a>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>

    <h4 class="mb-3">Prestasi</h4>

    <div class="table-responsive mb-3">
        <table class="table table-hover table-bordered border-dark">
            <thead class="text-center">
                <tr>
                    <th scope="col" style="width: 53.5%">Jenis Kegiatan</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col" style="width: 9.3%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataRapot['prestasi'] as $prestasi)
                    <tr>
                        <td>{{ $prestasi->jenis_kegiatan }}</td>
                        <td>{{ $prestasi->keterangan ?: '-' }}</td>
                        <td class="text-center">
                            <a href="{{ route('dashboard.rapot.prestasi.edit', [$siswa->nis, $prestasi->id]) }}"
                                class="btn btn-outline-info btn-sm">
                                <span class="iconify" data-icon="carbon:edit"></span> Edit
                            </a>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td class="text-center">
                        <a href="{{ route('dashboard.rapot.prestasi.create', [$siswa->nis, 'semester' => $semester]) }}"
                            class="btn btn-outline-primary btn-sm">
                            <span class="iconify mb-1" data-icon="carbon:add"></span> Tambah
                        </a>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
