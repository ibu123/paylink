<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Merchant;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Style;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExcelExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithMapping
{


    public function __construct($livewire, $collection)
    {
        $this->_livewire = $livewire;
        $this->_collection = $collection;
    }

    public function collection()
    {
        return  $this->_collection;
    }


    public function headings(): array
    {
        $columnDef = [];

        if(!empty($this->_livewire->column)) {
            foreach( $this->_livewire->column as $value) {
                if($value == 'id') {
                    $columnDef[] = __('id');
                } elseif ($value == 'store_display_name') {
                    $columnDef[] = __('Display Name');
                } elseif ($value == 'phone_no') {
                    $columnDef[] = __('Phone No');
                } elseif ($value == 'no_links') {
                    $columnDef[] = __('No Links');
                } elseif ($value == 'revenue') {
                    $columnDef[] = __('Revenue');
                } elseif ($value == 'net_profit') {
                    $columnDef[] = __('Net profit');
                }
            }

            return $columnDef;
        }


        return [
            __('id'),
            __('Display Name'),
            __('Phone No'),
            __('No Links'),
            __('Revenue') ,
            __('Net profit')
        ];
    }

    public function map($merchant): array
    {
        $columnDef = [];
        if(!empty($this->_livewire->column)) {
            foreach( $this->_livewire->column as $value) {
                if($value == 'id') {
                    $columnDef[] = $merchant->id;
                } elseif ($value == 'store_display_name') {
                    $columnDef[] = $merchant->store_display_name;
                } elseif ($value == 'phone_no') {
                    $columnDef[] = $merchant->user->phone_no;
                } elseif ($value == 'no_links') {
                    $columnDef[] = $merchant->no_of_links;
                } elseif ($value == 'revenue') {
                    $columnDef[] = $merchant->revenues." ريال ";
                } elseif ($value == 'net_profit') {
                    $columnDef[] = $merchant->net_profit." ريال ";
                }
            }
            return $columnDef;
        } else {
            return [
                $merchant->id,
                $merchant->store_display_name,
                $merchant->user->phone_no,
                $merchant->no_of_links,
                $merchant->revenues." ريال ",
                $merchant->net_profit." ريال "
            ];
        }

    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => [
                'font' => ['bold' => true],
            ]
        ];
    }


}
