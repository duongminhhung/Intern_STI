<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;


class UsersExport implements FromCollection, WithHeadings, WithColumnWidths

{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::select('id','name','email')
        ->where('role', '=','0')
        ->get();
    }
 

    public function headings(): array
    {
        return ['Id', 'Name','Email'];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 30,
            'C' => 40,
        ];
    }

   

}
