<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <th scope="col">#</th>
            <th scope="col">NIS/NISN</th>
            <th scope="col">Nama</th>
            <th scope="col">Kelas</th>
            <th scope="col" style="width:17%">Aksi</th>
        </thead>
        <tbody>
            @foreach ($presensi as $p)
                <tr>
                    <th scope="row">{{ $loop->iteration + $presensi->firstItem() - 1 }}</th>
                    <td>{{ $p->nis }} / {{ $p->siswa->nisn }}</td>
                    <td>{{ $p->siswa->nama }}</td>
                    <td>{{ $p->siswa->kelas->nama }}</td>
                    <td class="d-flex">
                        <a href="{{ route('dashboard.admin.presensi.edit', [$p, 'search' => $search, 'tanggal' => $tanggal]) }}"
                            class="btn btn-sm btn-outline-info me-2">
                            <span class="iconify b-icon" data-icon="bi:eye"></span> Detail
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-end">
        {{ $presensi->links() }}
    </div>
</div>
