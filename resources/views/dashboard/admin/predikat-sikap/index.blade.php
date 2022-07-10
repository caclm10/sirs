@extends('layouts.dashboard')

@section('dashboard-title', 'Dashboard Admin')

@section('content')

    <h3 class="mb-3">Daftar Predikat Sikap</h3>

    <x-success-alert />

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('dashboard.admin.predikat-sikap.create') }}" class="btn btn-primary">+ Predikat Sikap</a>
    </div>


    <form action="#" id="search-form" class="d-flex mb-1" style="max-width:350px">
        <input type="hidden" name="link" value="{{ route('dashboard.admin.predikat-sikap.index') }}">
        <input class="form-control me-2" type="search" name="search" placeholder="Cari" aria-label="Search"
            value="{{ $search }}">
        <button class="btn btn-outline-success" type="submit">Cari</button>
    </form>
    <div id="table-container">
        @include('includes/admin/list-predikat-sikap')
    </div>
@endsection
