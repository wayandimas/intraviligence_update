<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class PerbaikanKerusakanDanPerawatanKendaraanExport implements FromView
{
    protected $perawatan;

    public function __construct($perawatan)
    {
        $this->perawatan = $perawatan;
    }

    public function view(): View
    {
        return view('exports.perbaikanKerusakanDanPerawatanKendaraan', [
            'perawatan' => $this->perawatan
        ]);
    }
}