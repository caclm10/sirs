@auth
    @waliKelasOrSiswa
        <a href="{{ route('dashboard.rapot.index') }}" class="@if (\Str::contains(url()->current(), 'rapot')) --active @endif">
            <span class="iconify me-3" data-icon="healthicons:i-exam-qualification-outline"
                style="width: 18px; height: 18px;"></span>
            <span>Raport</span>
        </a>
    @endwaliKelasOrSiswa

    @auth('siswa')
        <a href="{{ route('dashboard.presensi.index') }}"
            class="{{ url()->current() == route('dashboard.presensi.index') ? '--active' : '' }}">
            <span class="iconify me-3" data-icon="ci:dashboard"></span>
            <span>Presensi</span>
        </a>
        <a href="{{ route('dashboard.rekap-presensi.index') }}"
            class="{{ url()->current() == route('dashboard.rekap-presensi.index') ? '--active' : '' }}">
            <span class="iconify me-3" data-icon="carbon:result"></span>
            <span>Riwayat Presensi</span>
        </a>
    @endauth

    @auth('admin')
        <a href="{{ route('dashboard.admin.siswa.index') }}" class="@if (\Str::contains(url()->current(), 'admin/siswa')) --active @endif">
            <span class="iconify me-3" data-icon="fluent:people-28-regular"></span>
            <span>Siswa</span>
        </a>
        <a href="{{ route('dashboard.admin.wali-kelas.index') }}" class="@if (\Str::contains(url()->current(), 'admin/wali-kelas')) --active @endif">
            <span class="iconify me-3" data-icon="fluent:people-28-regular"></span>
            <span>Wali Kelas</span>
        </a>
        <a href="{{ route('dashboard.admin.admin.index') }}" class="@if (\Str::contains(url()->current(), 'admin/admin')) --active @endif">
            <span class="iconify me-3" data-icon="fluent:people-28-regular"></span>
            <span>Admin</span>
        </a>
        <a href="{{ route('dashboard.admin.kelas.index') }}" class="@if (\Str::contains(url()->current(), 'admin/kelas')) --active @endif">
            <span class="iconify me-3" data-icon="cil:room"></span>
            <span>Kelas</span>
        </a>
        <a href="{{ route('dashboard.admin.mapel.index') }}" class="@if (\Str::contains(url()->current(), 'admin/mapel')) --active @endif">
            <span class="iconify me-3" data-icon="carbon:course"></span>
            <span>Mata Pelajaran</span>
        </a>
        <a href="{{ route('dashboard.admin.ekskul.index') }}" class="@if (\Str::contains(url()->current(), 'admin/ekskul')) --active @endif">
            <span class="iconify me-3" data-icon="ic:outline-more-time"></span>
            <span>Ekstrakurikuler</span>
        </a>
        <a href="{{ route('dashboard.admin.predikat-sikap.index') }}"
            class="@if (\Str::contains(url()->current(), 'admin/predikat-sikap')) --active @endif">
            <span class="iconify me-3" data-icon="bi:journals"></span>
            <span>Predikat Sikap</span>
        </a>
        <a href="{{ route('dashboard.admin.presensi.index') }}" class="@if (\Str::contains(url()->current(), 'admin/presensi')) --active @endif">
            <span class="iconify me-3" data-icon="ci:dashboard"></span>
            <span>Presensi</span>
        </a>
    @endauth


    <a href="{{ route('dashboard.profil.index') }}" class="@if (\Str::contains(url()->current(), 'profil')) --active @endif">
        <span class="iconify me-3" data-icon="carbon:user-avatar"></span>
        <span>Profil</span>
    </a>
    <a href="{{ route('logout') }}">
        <span class="iconify me-3" data-icon="carbon:logout"></span>
        <span>Logout</span>
    </a>
@endauth
