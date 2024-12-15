<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;


class CategoryExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    use Exportable;

    public function __construct(protected $dashboard) {}

    public function collection()
    {
        return $this->dashboard->map(function ($item) {
            return [
                'category_name' => $item->category_name,
                'category_description' => $item->category_description,
                'total_sold' => $item->total_sold,
                'total_amount' => number_format($item->total_amount),
                'stock' => $item->stock,
            ];
        });
    }

    public function headings(): array
    {
        return [
            "Name",
            "Description",
            "Total Sold",
            "Total Amount",
            "Stock",
        ];
    }
}