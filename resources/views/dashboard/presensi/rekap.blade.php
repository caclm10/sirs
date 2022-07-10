@extends('layouts.dashboard')

@section('dashboard-title', 'Dashboard Riwayat Presensi')

@section('content')

    <h3 class="mb-2">Riwayat Presensi</h3>

    <div class="mb-4">
        <table>
            <td>Nama</td>
            <td>&nbsp; : &nbsp;</td>
            <td>{{ $pengguna->nama }}</td>
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
                                data-link="{{ route('dashboard.rekap-presensi.index', ['semester' => $ganjilGenap]) }}">
                                {{ \Angka::romawi($sem) }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            @if (count($jumlahPresensi) > 0)
                @foreach ($jumlahPresensi as $keterangan => $jumlah)
                    <tr>
                        <td>{{ Str::title($keterangan) }}</td>
                        <td>&nbsp; : &nbsp;</td>
                        <td>{{ $jumlah }}</td>
                    </tr>
                @endforeach
            @endif
        </table>
    </div>

    @if ($presensi)
        <div class="table-responsive">
            <table class="table table-hover text-center">
                <thead>
                    <th scope="col">No</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Waktu Hadir</th>
                    <th scope="col">Keterangan</th>
                </thead>
                <tbody>
                    @foreach ($presensi as $presen)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ Date::parse($presen->tanggal_hadir)->isoFormat('dddd, DD-MM-YYYY') }}</td>
                            <td>{{ $presen->waktu_hadir ?: '-' }}</td>
                            <td>{{ $presen->keterangan ? Str::title($presen->keterangan) : '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="mb-0 fs-5 text-muted text-center">Belum ada riwayat</p>
    @endif

@endsection
