<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Merchant;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportMerchant implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {



        foreach ($rows as $row) {
            $validator = Validator::make($row, [
                'merchant_name' => 'required|regex:/^[a-zA-Z\s]+$/',
                'cr_number' => 'required|digits:10',
                'vat' => 'required|alpha_num',
                'iban' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
                'domain' => 'required|regex:/^[a-zA-Z0-9.]+$/',
                'phone_no' => 'required|digits:10',
                'store_display_name' => 'required'
            ]);

            if($validator->fails()) {
                continue;
            }

            $user = User::updateOrCreate(
                [
                    'phone_no' => $row->phone_no
                ],[
                    'phone_no' => $row->phone_no
                ]);

            Merchant::create([
                'merchant_name' => $row->merchant_name,
                'cr_number' =>  $row->cr_number,
                'user_id' => $row->id,
                'vat' => $row->vat,
                'iban' => $row->iban,
                'domain' => $row->domain,
                'store_display_name' => $row->store_display_name
            ]);
    }

    }
}
