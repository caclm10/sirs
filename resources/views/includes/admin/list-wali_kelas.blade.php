<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <th scope="col">#</th>
            <th scope="col">NIP</th>
            <th scope="col">Nama</th>
            <th scope="col">Kelas</th>
            <th scope="col" style="width:17%">Aksi</th>
        </thead>
        <tbody>
            @foreach ($waliKelas as $wali)
                <tr>
                    <th scope="row">{{ $waliKelas->firstItem() + $loop->iteration - 1 }}</th>
                    <td>{{ $wali->nip }}</td>
                    <td>{{ $wali->nama }}</td>
                    <td>{{ $wali->kelas ? $wali->kelas->nama : '-' }}</td>
                    <td class="d-flex">
                        <a href="{{ route('dashboard.admin.wali-kelas.edit', [$wali->nip]) }}"
                            class="btn btn-sm btn-outline-info me-2">
                            <span class="iconify" data-icon="carbon:edit"></span> Edit
                        </a>
                        <form action="{{ route('dashboard.admin.wali-kelas.destroy', [$wali->nip]) }}" method="POST"
                            onsubmit="return confirm('Hapus wali kelas ini?')">
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
