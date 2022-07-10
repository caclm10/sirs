<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <th scope="col">#</th>
            <th scope="col">Kode</th>
            <th scope="col">Nama</th>
            <th scope="col" style="width:17%">Aksi</th>
        </thead>
        <tbody>
            @foreach ($ekskul as $e)
                <tr>
                    <th scope="row">{{ $loop->iteration + $ekskul->firstItem() - 1 }}</th>
                    <td>{{ $e->kode }}</td>
                    <td>{{ $e->nama }}</td>
                    <td class="d-flex">
                        <a href="{{ route('dashboard.admin.ekskul.edit', [$e->kode]) }}"
                            class="btn btn-sm btn-outline-info me-2">
                            <span class="iconify" data-icon="carbon:edit"></span> Edit
                        </a>
                        <form action="{{ route('dashboard.admin.ekskul.destroy', [$e->kode]) }}" method="POST"
                            onsubmit="return confirm('Hapus ekstrakurikuler ini?')">
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

    <div class="d-flex justify-content-end">
        {{ $ekskul->links() }}
    </div>
</div>
