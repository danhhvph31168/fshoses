<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;


class ProductExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    use Exportable;

    public function __construct(protected $dashboard) {}

    public function collection()
    {
        return $this->dashboard->map(function ($item) {
            return [
                'name' => $item->name,
                'price_regular' => $item->price_regular,
                'price_sale' => $item->price_sale,
                'description' => html_entity_decode(strip_tags($item->description), ENT_QUOTES, 'UTF-8'),
                'total_sold' => $item->total_sold,
                'total_amount' => number_format($item->total_amount),
                'count_orders' => $item->count_orders,
                'stock' => $item->stock,
            ];
        });
    }

    public function headings(): array
    {
        return [
            "Name",
            "Price Regular",
            "Price Sale",
            "Description",
            "Total Sold",
            "Total Amount",
            "Count Order",
            "Stock",
        ];
    }
}
