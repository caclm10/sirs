@extends('layouts.dashboard')

@section('dashboard-title', 'Dashboard Admin')

@section('content')

    <h3 class="mb-3">Daftar Presensi Siswa</h3>

    <x-success-alert />

    <div class="clearfix mb-3">
        <div class="float-end">
            <a href="{{ route('dashboard.admin.presensi.pengaturan.index') }}" class="btn btn-primary">
                <span class="iconify b-icon" data-icon="bi:gear"></span> Pengaturan
            </a>
        </div>
    </div>


    <div class="d-flex justify-content-between">
        <form action="#" id="search-form" class="d-flex mb-1" style="max-width:350px">
            <input type="hidden" name="link" value="{{ route('dashboard.admin.presensi.index') }}">
            <input class="form-control me-2" type="search" name="search" placeholder="Cari" aria-label="Search"
                value="{{ $search }}">
            <button class="btn btn-outline-success" type="submit">Cari</button>
        </form>

        <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ $tanggal }}"
            style="width: initial">
    </div>
    <div id="table-container">
        @include('includes/admin/list-presensi')
    </div>


@endsection
