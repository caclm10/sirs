<table id="siswa-kelas" class="table table-hover">
    <thead>
        <th scope="col">#</th>
        <th scope="col">NIS / NISN</th>
        <th scope="col">Nama</th>
        <th scope="col" style="width:17%">Aksi</th>
    </thead>
    <tbody>
        <tr>
            <td></td>
            <td>
                <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                    data-bs-target="#tambahSiswaModal">
                    <span class="iconify mb-1" data-icon="carbon:add"></span> Tambah
                </button>
            </td>
            <td></td>
            <td></td>
        </tr>
        @foreach ($kelas->siswa->sortBy('nis') as $siswa)
            <tr>
                <th scope="row" name="number">{{ $loop->iteration }}</th>
                <td>{{ $siswa->nis }} / {{ $siswa->nisn }}</td>
                <td>{{ $siswa->nama }}</td>
                <td>
                    <button type="button" name="hapus" class="btn btn-sm btn-danger"
                        data-nis="{{ $siswa->nis }}">Hapus</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
