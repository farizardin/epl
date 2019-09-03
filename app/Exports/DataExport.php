<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class DataExport implements FromView
{
    use Exportable;

    public function __construct($data)
    {
        $this->stands = $data;
    }

    public function view(): View
    {
        return view('exports.data', [
            'stands' => $this->stands
        ]);
    }
}