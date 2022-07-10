<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <th scope="col">#</th>
            <th scope="col">Predikat</th>
            <th scope="col">Deskripsi Spiritual</th>
            <th scope="col">Deskripsi Sosial</th>
            <th scope="col" style="width:17%">Aksi</th>
        </thead>
        <tbody>
            @foreach ($predikatSikap as $ps)
                <tr>
                    <th scope="row">{{ $loop->iteration + $predikatSikap->firstItem() - 1 }}</th>
                    <td>{{ $ps->predikat }}</td>
                    <td>{{ $ps->deskripsi_spiritual }}</td>
                    <td>{{ $ps->deskripsi_sosial }}</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('dashboard.admin.predikat-sikap.edit', [$ps->predikat]) }}"
                                class="btn btn-sm btn-outline-info me-2">
                                <span class="iconify" data-icon="carbon:edit"></span> Edit
                            </a>
                            <form action="{{ route('dashboard.admin.predikat-sikap.destroy', [$ps->predikat]) }}"
                                method="POST" onsubmit="return confirm('Hapus predikat sikap ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">
                                    <span class="iconify mb-1" data-icon="carbon:trash-can"></span> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-end">
        {{ $predikatSikap->links() }}
    </div>
</div>
