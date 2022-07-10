@extends('layouts.main')


@section('pageTitle', 'Halaman Utama')

@section('content')

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-xxl">
            <a class="navbar-brand" href="#">
                <img src="/images/logo.png" alt="logo" width="40" height="49" />
                <span class="d-inline-block ms-2">SMA Swasta Eria Medan</span>
            </a>
            <div class="text-light d-flex align-items-center">
                <span class="me-2">{{ auth()->user()->nama }}</span>
                <span class="iconify fs-2" data-icon="bx:bx-user-circle"></span>
            </div>
        </div>
    </nav>
    <div class="d-grid gtc-1-1 position-relative">
        <img src="/images/sekolah-1.png" alt="" class="mw-100 w-100 h-420px object-cover">
        <img src="/images/sekolah-2.png" alt="" class="mw-100 w-100 h-420px object-cover">
        <div class="absolute-full bg-black bg-opacity-50 d-flex align-items-center justify-content-center">
            <div class="text-light text-center mb-5">
                <h1>YAYASAN PENDIDIKAN ANI IDRUS</h1>
                <h2 class="mb-5">SMA SWASTA ERIA MEDAN</h2>
                <img src="/images/logo.png" alt="logo" width="120" height="151" class="object-cover">
            </div>
        </div>
    </div>
    <div class="container-xxl mb-5">
        <div class="bg-white rounded-20px shadow position-relative p-5 -top-40px">
            <div class="row mb-5">
                <div class="col text-center py-5">
                    <h3 style="font-size: 50px;">Selamat Datang</h3>
                    <p style="font-size:35px;">Selamat Datang di website <br>
                        SMA SWASTA ERIA MEDAN</p>
                </div>
                <div class="col">
                    <img src="/images/sekolah-2.png" alt="" class="img-fluid rounded-20px">
                </div>
            </div>

            <div class="mb-5">
                <div class="border-start border-primary border-5 px-3 mb-3">
                    <h4 class="text-primary fw-normal mb-0">Absensi</h4>
                </div>
                <div class="bg-white rounded-20px shadow p-4">
                    <div class="row">
                        <div class="col-2">1</div>
                        <div class="col">2</div>
                    </div>
                </div>
            </div>
            <div>
                <div class="border-start border-primary border-5 px-3 mb-3">
                    <h4 class="text-primary fw-normal mb-0">Nilai</h4>
                </div>
                <a href="{{ route('dashboard.rapot.index') }}"
                    class="d-block bg-white rounded-20px shadow p-4 text-decoration-none">
                    <div class="row">
                        <div class="col-3">
                            <img src="/images/ilustrasi-nilai.png" alt="ilustrasi nilai" class="img-fluid">
                        </div>
                        <div class="col d-flex flex-column text-dark">
                            <h6 class="fs-5 mb-0 text-reset">Nilai</h6>
                            <p class="flex-grow-1 d-flex align-items-center text-muted">Lihat nilai kamu di sini</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="h-25px bg-primary-light"></div>
    <div class="h-100px bg-primary"></div>

@endsection
