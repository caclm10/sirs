@extends('layouts.dashboard')

@section('dashboard-title', 'Dashboard Presensi')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div class="border-start border-primary border-3 px-3">
            <h4 class="fw-normal mb-0">Jadwal Presensi</h4>
        </div>
        <span class="fs-4">Keterangan</span>
    </div>

    <div class="mb-4">
        @if ($isJadwalPresensiCreated)
            @foreach ($presensi as $p)
                <a href="{{ route('dashboard.presensi.presensi', ['presensi' => $p]) }}"
                    class="border-start border-primary border-5 d-block bg-white shadow p-4 text-decoration-none mb-3 text-reset"
                    style="border-radius: 10px">
                    <div class="row align-items-center">
                        <div class="col-3">
                            <h4 class="text-primary fw-bold ">
                                {{ Date::parse($p->tanggal_hadir)->isoFormat('dddd, D MMMM YYYY') }}</h4>
                        </div>
                        @if ($p->waktu_hadir)
                            <span class="col text-end">Hadir pada pukul
                                {{ Date::parse($p->waktu_hadir)->isoFormat('LT') }}</span>
                        @else
                            <span class="col text-end text-capitalize">{{ $p->keterangan ?: 'Belum Presensi' }}</span>
                        @endif

                    </div>
                </a>
            @endforeach
        @else
            <p class="text-center fs-5 text-muted">Jadwal presensi belum dibuat</p>
        @endif
    </div>
@endsection
