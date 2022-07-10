@php
if ($presensi->waktu_hadir) {
    $icon = 'circle-check';
    $pesan = 'Anda sudah melakukan presensi pada pukul ' . $presensi->waktu_hadir;
    $textColor = 'text-success';
} else {
    $icon = 'circle-x-fill';
    $textColor = 'text-danger';
    if ($presensi->keterangan) {
        $pesan = "Anda tidak hadir\n Keterangan:  " . ucfirst($presensi->keterangan);
    } else {
        $pesan = 'Anda belum melakukan presensi';
    }
}

$parsed = Date::parse($presensi->tanggal_hadir)->toImmutable();

$now = now();
@endphp

@extends('layouts.halamanpresensi')

@section('dashboard-title', 'Halaman Presensi')

@section('content')
    <div class="mx-auto card" style="max-width: 600px; border-radius: 20px">
        <div class="card-body text-center" style="padding:40px 10px">
            <div class="mb-3">
                <span class="iconify {{ $textColor }}" style="font-size: 45px;"
                    data-icon="akar-icons:{{ $icon }}"></span>
            </div>
            <div class="mb-4 mx-auto fs-4 lh-sm" style="max-width: 360px; font-weight:500">
                <p class="mb-1">{{ $parsed->isoFormat('dddd, LL') }}</p>
                <p>{!! nl2br(e($pesan)) !!}</p>
            </div>
            @if (!$presensi->waktu_hadir && !$presensi->keterangan && $parsed->toDateString() == $now->toDateString() && $now->diffInDays($parsed, false) >= 0)
                <form action="{{ route('dashboard.presensi.presen', [$presensi]) }}" class="d-grid mx-auto" method="POST"
                    style="max-width:274px;">
                    @csrf
                    <button class="btn btn-primary">Hadir Sekarang</button>
                </form>
            @endif
        </div>
    </div>

    @error('presensi')
        <script>
            window.addEventListener('load', () => {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: `{{ $message }}`,
                })
            })
        </script>
    @enderror

    @if (session()->has('presensi-success'))
        <script>
            window.addEventListener('load', () => {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: `{{ session('presensi-success') }}`,
                })
            })
        </script>
    @endif
@endsection
