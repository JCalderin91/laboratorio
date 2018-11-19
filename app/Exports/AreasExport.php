<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Area;
use Maatwebsite\Excel\Concerns\FromCollection;

class AreasExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Area::all();
    }
    public function headings(): array
    {
        return [
            '#',
            'Date',
            'c',
            'd',
            'e',
            'f',
            'g'
        ];
    }
}
