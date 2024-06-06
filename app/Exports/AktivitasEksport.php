<?php

namespace App\Exports;

use App\Models\ActivityMutationServiceTol;
use Maatwebsite\Excel\Concerns\FromCollection;

class AktivitasEksport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ActivityMutationServiceTol::all();
    }
}
