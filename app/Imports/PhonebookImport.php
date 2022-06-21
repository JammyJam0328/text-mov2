<?php

namespace App\Imports;
use App\Models\Phonebook;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class PhonebookImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Phonebook([
            'name' => $row[0],
            'contact_number' => $row[1],
            'year_level' => $row[3],
            'department_id' => $row[2],
        ]);
    }
}
