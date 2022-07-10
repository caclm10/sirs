<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <th scope="col">#</th>
            <th scope="col">NIS / NISN</th>
            <th scope="col">Nama</th>
            <th scope="col">Kelas</th>
            <th scope="col" style="width:17%">Aksi</th>
        </thead>
        <tbody>
            @foreach ($siswa as $s)
                <tr>
                    <th scope="row">{{ $siswa->firstItem() + $loop->iteration - 1 }}</th>
                    <td>{{ $s->nis }} / {{ $s->nisn }}</td>
                    <td>{{ $s->nama }}</td>
                    <td>{{ $s->kelas ? $s->kelas->nama : '-' }}</td>
                    <td class="d-flex">
                        <a href="{{ route('dashboard.admin.siswa.edit', [$s->nis]) }}"
                            class="btn btn-sm btn-outline-info me-2">
                            <span class="iconify" data-icon="carbon:edit"></span> Edit
                        </a>
                        <form action="{{ route('dashboard.admin.siswa.destroy', [$s->nis]) }}" method="POST"
                            onsubmit="return confirm('Hapus siswa ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">
                                <span class="iconify mb-1" data-icon="carbon:trash-can"></span> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
