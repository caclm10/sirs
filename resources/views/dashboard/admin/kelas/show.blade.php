@extends('layouts.dashboard')

@section('dashboard-title', 'Dashboard Admin')

@section('content')

    <h2 class="mb-3">Kelas {{ $kelas->nama }}</h2>

    <div class="alert-success-container">
        <x-success-alert />
    </div>

    <input type="hidden" name="id-kelas" value="{{ $kelas->id }}">

    <div class="d-flex justify-content-end mb-3">
        <table>
            <tr>
                <td>Wali Kelas</td>
                <td>&nbsp;: &nbsp;</td>
                <td id="nama-wali">{{ $kelas->wali ? $kelas->wali->nama : '-' }}</td>
                <td>
                    &nbsp;
                    <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal"
                        data-bs-target="#gantiWaliModal">
                        <span class="iconify mb-1" data-icon="carbon:edit"></span> Ganti
                    </button>
                </td>
            </tr>
            <tr>
                <td>Jumlah Siswa</td>
                <td>&nbsp;: &nbsp;</td>
                <td id="jumlah-siswa">{{ $kelas->siswa->count() }}</td>
            </tr>
        </table>
    </div>

    <div id="table-container" class="table-responsive">
        @include('includes/admin/kelas/list-siswa')
    </div>


    <!-- Modal -->
    <div class="modal fade" id="tambahSiswaModal" tabindex="-1" aria-labelledby="tambahSiswaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahSiswaModalLabel">Tambah Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" class="d-flex mb-4" id="search-siswa-form">
                        <input type="search" name="search-siswa" id="search-siswa" class="form-control me-3"
                            placeholder="Cari Siswa">
                        <button class="btn btn-outline-success">Cari</button>
                    </form>

                    <div id="searched-siswa-container" class="mb-3">
                        <div class="text-center text-muted">Pencarian kosong</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="gantiWaliModal" tabindex="-1" aria-labelledby="gantiWaliModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="gantiWaliModalLabel">Ganti Wali</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" class="d-flex mb-4" id="search-wali-kelas-form">
                        <input type="search" name="search-wali-kelas" id="search-wali-kelas" class="form-control me-3"
                            placeholder="Cari Wali Kelas">
                        <button class="btn btn-outline-success">Cari</button>
                    </form>

                    <div id="searched-wali-kelas-container" class="mb-3">
                        <div class="text-center text-muted">Pencarian kosong</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
