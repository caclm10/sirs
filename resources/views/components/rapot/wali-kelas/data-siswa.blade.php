@if ($inline)
    <div class="mb-3 row">
        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="nama" value="{{ $siswa->nama }}">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="nis" class="col-sm-2 col-form-label">NIS/NISN</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="nis" name="nis"
                value="{{ $siswa->nis }}/{{ $siswa->nisn }}">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="kelas"
                value="{{ $siswa->kelas->nama }}">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="semester" class="col-sm-2 col-form-label">Semester</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="semester"
                value="{{ \Angka::romawi(\Sekolah::semester($siswa->kelas->tingkat, $semester)) }}">
        </div>
    </div>
@else
    <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" readonly class="form-control" id="nama" value="{{ $siswa->nama }}">

    </div>
    <div class="mb-3">
        <label for="nis" class="form-label">NIS/NISN</label>
        <input type="text" readonly class="form-control" id="nis" name="nis"
            value="{{ $siswa->nis }}/{{ $siswa->nisn }}">

    </div>
    <div class="mb-3">
        <label for="kelas" class="form-label">Kelas</label>
        <input type="text" readonly class="form-control" id="kelas" value="{{ $siswa->kelas->nama }}">
    </div>
    <div class="mb-3">
        <label for="semester" class="form-label">Semester</label>
        <input type="text" readonly class="form-control" id="semester"
            value="{{ \Angka::romawi(\Sekolah::semester($siswa->kelas->tingkat, $semester)) }}">
    </div>
@endif
