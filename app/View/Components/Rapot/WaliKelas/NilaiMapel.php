<?php

namespace App\View\Components\Rapot\WaliKelas;

use Illuminate\View\Component;

class NilaiMapel extends Component
{
    public $judul;
    public $mataPelajaran;
    public $semester;
    public $nis;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($judul, $mataPelajaran, $semester, $nis)
    {
        $this->judul = $judul;
        $this->mataPelajaran = $mataPelajaran;
        $this->semester = $semester;
        $this->nis = $nis;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        // dd($this->mataPelajaran->filter(fn ($mapel) => $mapel->kelompok == $this->kelompok && $mapel->peminatan = $this->peminatan));
        return view('components.rapot.wali-kelas.nilai-mapel');
    }
}
