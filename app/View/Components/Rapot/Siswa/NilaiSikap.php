<?php

namespace App\View\Components\Rapot\Siswa;

use Illuminate\View\Component;
use Illuminate\Support\Str;

class NilaiSikap extends Component
{
    public $nilai;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($nilai)
    {
        $this->nilai = $nilai;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.rapot.siswa.nilai-sikap');
    }
}
