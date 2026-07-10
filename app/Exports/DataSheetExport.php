<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataSheetExport implements FromCollection, WithTitle, WithHeadings
{
    protected $data;
    protected $title;
    protected $headings;

    public function __construct($data, $title, $headings)
    {
        $this->data = $data;
        $this->title = $title;
        $this->headings = $headings;
    }

    public function collection()
    {
        return collect($this->data);
    }

    public function title(): string
    {
        return $this->title;
    }

    public function headings(): array
    {
        return $this->headings;
    }
}
