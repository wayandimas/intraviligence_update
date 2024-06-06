<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class PengisianBahanBakarExport implements FromView
{
    protected $pengisian;

    public function __construct($pengisian)
    {
        $this->pengisian = $pengisian;
    }

    public function view(): View
    {
        return view('exports.pengisianBahanBakar', [
            'pengisian' => $this->pengisian
        ]);
    }
}