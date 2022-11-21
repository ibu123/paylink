<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Merchant;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Style;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LinkExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithMapping
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


        return [
            'الرقم',
            'المبلغ',
            'حالة الدفع',
            'حالة الاستلام',
        ];
    }

    public function map($paylink): array
    {
        $date = Carbon::parse($paylink->expiration_date);
        $now = Carbon::now();
        $expirationTime = '';
        if($now->gt($date)) {
            $expirationTime = '';
        } else {
            $diff = $date->diff($now);
            $expirationTime = json_encode($diff);
        }

        $columnDef[] = $paylink->id;
        $columnDef[] = $paylink->amount." ريال ";

        if($paylink->payment_status == 0) {
            $columnDef[] = "ملغي";
        } elseif($paylink->payment_status == 1 && !empty($expirationTime)) {
            $columnDef[] = "بانتظار الدفع";
        } elseif($paylink->payment_status == 1 && empty($expirationTime)) {
            $columnDef[] = "منتهي";
        } elseif($paylink->payment_status == 2) {
            $columnDef[] ="تم الدفع";
        }


        if($paylink->send_payment_status == 0) {
            $columnDef[] = "ملغي";
        } elseif($paylink->payment_status == 1 && !empty($expirationTime)) {
            $columnDef[] = "غير مستلم";
        } elseif($paylink->payment_status == 1 && empty($expirationTime)) {
            $columnDef[] = "منتهي";
        } elseif($paylink->payment_status == 2) {
            $columnDef[] ="تم الاستلام";
        }



        return $columnDef;
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
