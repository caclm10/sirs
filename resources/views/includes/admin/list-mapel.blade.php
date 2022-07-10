<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <th scope="col">#</th>
            <th scope="col">Kode</th>
            <th scope="col">Nama</th>
            <th scope="col">Kelompok</th>
            <th scope="col">Peminatan</th>
            <th scope="col" style="width:17%">Aksi</th>
        </thead>
        <tbody>
            @foreach ($mapel as $m)
                <tr>
                    <th scope="row">{{ $loop->iteration + $mapel->firstItem() - 1 }}</th>
                    <td>{{ $m->kode }}</td>
                    <td>{{ $m->nama }}</td>
                    <td>{{ $m->kelompok }}</td>
                    <td class="@if ($m->peminatan == 'umum') text-capitalize @else text-uppercase @endif">
                        {{ $m->peminatan }}</td>
                    <td class="d-flex">
                        <a href="{{ route('dashboard.admin.mapel.edit', [$m->kode]) }}"
                            class="btn btn-sm btn-outline-info me-2">
                            <span class="iconify" data-icon="carbon:edit"></span> Edit
                        </a>
                        <form action="{{ route('dashboard.admin.mapel.destroy', [$m->kode]) }}" method="POST"
                            onsubmit="return confirm('Hapus mata pelajaran ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">
                                <span class="iconify" data-icon="carbon:trash-can"></span> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-end">
        {{ $mapel->links() }}
    </div>
</div>
