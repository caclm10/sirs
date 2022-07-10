@if ($waliKelas->isNotEmpty())
    <div id="searched-wali-kelas">
        @foreach ($waliKelas->sortBy('nip') as $waliKelas)
            <div class="row mb-3">
                <div class="col">
                    <span class="fw-bold">{{ $waliKelas->nip }}</span>
                </div>
                <div class="col">
                    {{ $waliKelas->nama }}
                </div>
                <div class="col d-flex justify-content-end">
                    @if ($waliKelas->kelas && $waliKelas->kelas->id == $id_kelas)
                        <span class="badge rounded-pill bg-success">Terpilih</span>
                    @else
                        <button type="button" class="btn btn-primary btn-sm" name="pilih"
                            data-nip="{{ $waliKelas->nip }}">
                            Pilih
                        </button>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="text-center text-muted">Data wali kelas tidak ditemukan</div>
@endif
