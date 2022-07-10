@foreach ($nilai as $key => $n)
    <div>
        <h5>{{ $loop->iteration }}. Sikap {{ ucfirst($key) }}</h5>
        <div class="table-responsive">
            <table class="table table-bordered border-dark">
                <thead>
                    <tr class="text-center">
                        <th scope="col" class="w-20pc">Predikat</th>
                        <th scope="col">Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center align-middle">
                            {{ $n['predikat'] ?? '-' }}
                        </td>
                        <td>
                            {{ $n['custom'] ?? ($n['deskripsi'] ?? '') }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endforeach
