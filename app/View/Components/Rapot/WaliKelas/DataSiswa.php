<?php

namespace App\View\Components\Rapot\WaliKelas;

use Illuminate\View\Component;

class DataSiswa extends Component
{
    public $siswa;
    public $semester;
    public $inline;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($siswa, $semester, $inline = true)
    {
        $this->siswa = $siswa;
        $this->semester = $semester;
        $this->inline = $inline;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.rapot.wali-kelas.data-siswa');
    }
}
