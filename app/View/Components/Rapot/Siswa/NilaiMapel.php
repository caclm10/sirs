<?php

namespace App\View\Components\Rapot\Siswa;

use Illuminate\View\Component;

class NilaiMapel extends Component
{
    public $judul;
    public $mataPelajaran;
    public $isDeskripsi;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($judul, $mataPelajaran, $isDeskripsi = false)
    {
        $this->judul = $judul;
        $this->mataPelajaran = $mataPelajaran;
        $this->isDeskripsi = $isDeskripsi;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.rapot.siswa.nilai-mapel');
    }
}
