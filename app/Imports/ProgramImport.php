<?php

namespace App\Imports;

use App\Program;
use Maatwebsite\Excel\Concerns\ToModel;

class ProgramImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        
        return new Program([
            //
            'edulevel_id' => $row[1],
            'name' => $row[2],
            'student_price' => $row[3],
            'info' => $row[5],
        ]);
    }
}
