<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <th scope="col">#</th>
            <th scope="col">Kode Admin</th>
            <th scope="col">Nama</th>
            <th scope="col" style="width:17%">Aksi</th>
        </thead>
        <tbody>
            @foreach ($admin as $a)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $a->kode }}</td>
                    <td>{{ $a->nama }}</td>
                    <td class="d-flex">
                        <a href="{{ route('dashboard.admin.admin.edit', [$a->kode]) }}"
                            class="btn btn-sm btn-outline-info me-2">
                            <span class="iconify" data-icon="carbon:edit"></span> Edit
                        </a>
                        @if (auth()->id() != $a->kode)
                            <form action="{{ route('dashboard.admin.admin.destroy', [$a->kode]) }}" method="POST"
                                onsubmit="return confirm('Hapus admin ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">
                                    <span class="iconify mb-1" data-icon="carbon:trash-can"></span> Hapus
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
