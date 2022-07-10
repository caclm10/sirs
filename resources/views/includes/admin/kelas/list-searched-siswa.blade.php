<div id="searched-siswa">
    @foreach ($siswa->sortBy('nis') as $siswa)
        <div class="row mb-3">
            <div class="col">
                <span class="fw-bold">{{ $siswa->nis }}/{{ $siswa->nisn }}</span>
            </div>
            <div class="col">
                {{ $siswa->nama }}
            </div>
            <div class="col d-flex justify-content-end">
                @if ($siswa->id_kelas == $id_kelas)
                    <span class="badge rounded-pill bg-success">Sudah ditambah</span>
                @else
                    <button type="button" class="btn btn-primary btn-sm" name="tambah" data-nis="{{ $siswa->nis }}">
                        Tambah
                    </button>
                @endif
            </div>
        </div>
    @endforeach
</div>
