<?php

namespace App\Exports;

use App\Program;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProgramExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Program::all();
    }
}
