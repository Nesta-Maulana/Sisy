<?php

namespace App\Exports\Rollie;

use App\Models\Transaction\Rollie\WoNumber;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReportRpdFilling implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return WoNumber::all();
    }
}
