<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithTitle;

class DataExportPerSheet implements FromView, WithTitle
{
    public function __construct($data, $title)
    {
        $this->stands = $data;
        $this->title = $title;
    }

    public function view(): View
    {
        return view('exports.data', [
            'stands' => $this->stands
        ]);
    }

    public function title(): string {
        return $this->title;
    }
}