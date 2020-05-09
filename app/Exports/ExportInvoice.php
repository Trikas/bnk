<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportInvoice implements FromView
{
    private $trans;

    public function __construct($trans)
    {
        $this->trans = $trans;
    }

    public function view(): View
    {
        return view('mail-invoice', [
            'trans' => $this->trans
        ]);
    }
}
