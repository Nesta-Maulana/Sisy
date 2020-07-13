<?php

namespace App\Exports\Rollie;

use App\Models\Transaction\Rollie\WoNumber;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
class ReportRpdFilling implements FromView, WithHeadings, ShouldAutoSize
{
    use Exportable;
    public function __construct($woNumbers)
    {
        $this->woNumbers   = $woNumbers;
    }
    
    public function headings(): array
    {

    }
    public function view(): View
    {
        // dd($this->woNumbers);
        // $sheet->freezeFirstRow();

        return view('rollie.reports.rpd_filling.export',['woNumbers' => $this->woNumbers]);
    }
}
