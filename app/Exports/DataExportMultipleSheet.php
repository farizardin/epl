<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Stand;

class DataExportMultipleSheet implements WithMultipleSheets, ShouldQueue
{
    use Exportable;

    public function __construct($cabang)
    {
        $this->cabang = $cabang;
    }

    public function sheets(): array
    {
        $sheets = [];

        foreach ($this->cabang->pasar as $pasar) {
            $sheets[] = new DataExportPerSheet(Stand::spasar($pasar->id)->get(), $pasar->nama);
        }

        return $sheets;
    }
}