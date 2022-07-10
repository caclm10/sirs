@extends('layouts.dashboard')

@section('dashboard-title', 'Dashboard Raport')

@section('content')

    <h3 class="mb-2">
        @auth('wali_kelas')
            Daftar Siswa
        @endauth

        @auth('siswa')
            Raport Siswa
        @endauth
    </h3>

    <div class="d-flex justify-content-end mb-4">
        <table>
            @auth('siswa')
                <tr>
                    <td>Nama</td>
                    <td>&nbsp; : &nbsp;</td>
                    <td>{{ $pengguna->nama }}</td>
                </tr>
                <tr>
                    <td>NIS/NISN</td>
                    <td>&nbsp; : &nbsp;</td>
                    <td>{{ $pengguna->nis }} / {{ $pengguna->nisn }}</td>
                </tr>
            @endauth
            @if ($kelas)
                <tr>
                    <td>Kelas</td>
                    <td>&nbsp; : &nbsp;</td>
                    <td>{{ $kelas->nama }}</td>
                </tr>
                <tr>
                    <td>Semester</td>
                    <td>&nbsp; : &nbsp;</td>
                    <td>
                        <select name="semester" id="semester" class="form-select form-select-sm">
                            @foreach (\Sekolah::semester($kelas->tingkat) as $sem)
                                @php $ganjilGenap = \Angka::ganjilAtauGenap($sem) @endphp
                                <option value="{{ $ganjilGenap }}" @if ($ganjilGenap == $semester) selected @endif
                                    data-link="{{ route('dashboard.rapot.index', ['semester' => $ganjilGenap]) }}">
                                    {{ \Angka::romawi($sem) }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
            @endif
        </table>
    </div>

    @auth('wali_kelas')
        <div class="table-responsive">
            <table class="table table-hover text-center">
                <thead>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">NIS</th>
                    <th scope="col">Nilai</th>
                </thead>
                <tbody>
                    @foreach ($kelas->siswa as $siswa)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td class="text-start">{{ $siswa->nama }}</td>
                            <td>{{ $siswa->nis }}</td>
                            <td>
                                <a href="{{ route('dashboard.rapot.show', [$siswa->nis, 'semester' => $semester]) }}"
                                    class="btn btn-outline-info btn-sm">
                                    <span class="iconify" data-icon="carbon:edit"></span> Edit
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endauth

    @auth('siswa')
        <div class="mb-5">
            <h4 class="mb-3">A. Sikap</h4>

            <x-rapot.siswa.nilai-sikap :nilai="$lainnya['sikap']" />

        </div>

        <div class="mb-5">
            <h4 class="mb-3">B. Pengetahuan dan Keterampilan</h4>
            <div class="table-responsive mb-3">
                <table class="table table-bordered border-dark text-center">
                    <thead>
                        <tr class="align-middle">
                            <th scope="col" rowspan="2" style="width:6%">No</th>
                            <th scope="col" rowspan="2" style="width:55.4%">Mata Pelajaran</th>
                            <th scope="col" rowspan="2">KBM</th>
                            <th scope="col" colspan="2">Pengetahuan</th>
                            <th scope="col" colspan="2">Keterampilan</th>
                        </tr>
                        <tr>
                            <th scope="col" style="width:7.6%">Nilai</th>
                            <th scope="col" style="width:7.6%">Predikat</th>
                            <th scope="col" style="width:7.6%">Nilai</th>
                            <th scope="col" style="width:7.6%">Predikat</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <x-rapot.siswa.nilai-mapel judul="Kelompok A (Umum)" :mata-pelajaran="$mapel['a']" />
                        <x-rapot.siswa.nilai-mapel judul="Kelompok B (Umum)" :mata-pelajaran="$mapel['b']" />
                        <x-rapot.siswa.nilai-mapel judul="Kelompok C (Peminatan)" :mata-pelajaran="$mapel['c']" />
                        <x-rapot.siswa.nilai-mapel judul="Lintas Minat" :mata-pelajaran="$mapel['lintasMinat']" />
                    </tbody>
                </table>
            </div>

            {{-- <h5>Deskripsi Pengetahuan dan Keterampilan</h5> --}}
            <table class="table table-bordered border-dark">
                <thead class="text-center">
                    <tr class="align-middle">
                        <th scope="col" style="width:6%">No</th>
                        <th scope="col" style="width:27%">Mata Pelajaran</th>
                        <th scope="col" style="width:9%">Aspek</th>
                        <th scope="col">Deskirpsi</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    <x-rapot.siswa.nilai-mapel judul="Kelompok A (Umum)" :mata-pelajaran="$mapel['a']" :is-deskripsi="true" />
                    <x-rapot.siswa.nilai-mapel judul="Kelompok B (Umum)" :mata-pelajaran="$mapel['b']" :is-deskripsi="true" />
                    <x-rapot.siswa.nilai-mapel judul="Kelompok C (Peminatan)" :mata-pelajaran="$mapel['c']" :is-deskripsi="true" />
                    <x-rapot.siswa.nilai-mapel judul="Lintas Minat" :mata-pelajaran="$mapel['lintasMinat']" :is-deskripsi="true" />
                </tbody>
            </table>
        </div>

        <div class="mb-5">
            <h4 class="mb-3">C. Ekstrakurikuler</h4>
            <div class="table-responsive">
                <table class="table table-bordered border-dark">
                    <thead class="text-center">
                        <tr>
                            <th scope="col" style="width:6%">No</th>
                            <th scope="col" style="width:41%">Kegiatan Ekstrakurikuler</th>
                            <th scope="col">Nilai</th>
                            <th scope="col">Dekripsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($lainnya['ekstrakurikuler'] as $ekskul)
                            <tr>
                                <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                                <td>{{ $ekskul->nama }}</td>
                                <td class="text-center">{{ $ekskul->pivot->nilai }}</td>
                                <td>{{ $ekskul->pivot->deskripsi }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td>&nbsp;</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mb-5">
            <h4 class="mb-3">D. Prestasi</h4>
            <div class="table-responsive">
                <table class="table table-bordered border-dark">
                    <thead class="text-center">
                        <tr>
                            <th scope="col" style="width:6%">No</th>
                            <th scope="col" style="width:41%">Jenis Kegiatan</th>
                            <th scope="col">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($lainnya['prestasi'] as $prestasi)
                            <tr>
                                <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                                <td>{{ $prestasi->jenis_kegiatan }}</td>
                                <td>{{ $prestasi->keterangan }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td>&nbsp;</td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>


        <div class="mb-5">
            <h4 class="mb-3">E. Ketidakhadiran</h4>
            <table class="table table-bordered border-dark" style="max-width: 450px">
                <tbody>
                    <tr>
                        <td>Sakit</td>
                        <td>{{ $jumlahPresensi ? ($jumlahPresensi['sakit'] == 0 ? '-' : $jumlahPresensi['sakit']) : '-' }}
                            hari
                        </td>
                    </tr>
                    <tr>
                        <td>Izin</td>
                        <td>{{ $jumlahPresensi ? ($jumlahPresensi['izin'] == 0 ? '-' : $jumlahPresensi['izin']) : '-' }} hari
                        </td>
                    </tr>
                    <tr>
                        <td>Tanpa Keterangan</td>
                        <td>{{ $jumlahPresensi ? ($jumlahPresensi['tanpa keterangan'] == 0 ? '-' : $jumlahPresensi['tanpa keterangan']) : '-' }}
                            hari</td>
                    </tr>
                </tbody>
            </table>
        </div>

        @if ($semester == 'genap')
            <div class="border border-3 border-dark mb-5 py-1">
                <h4 class="mb-0">F. Keterangan Kelulusan : <span
                        class="@if (!$isLulus) text-decoration-line-through @endif">{{ $kelas->tingkat == 12 ? 'LULUS' : 'NAIK KELAS' }}</span>
                    /
                    <span
                        class="@if ($isLulus) text-decoration-line-through @endif">{{ $kelas->tingkat == 12 ? 'TIDAK LULUS' : 'TINGGAL KELAS' }}</span>
                </h4>
            </div>
        @endif
    @endauth

@endsection
