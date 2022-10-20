<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Merchant;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Collection;

class ImportMerchant implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $rows)
    {

            $user = User::updateOrCreate(
            [
                'phone_no' => $rows['phone_no']
            ],[
                'phone_no' => $rows['phone_no']
            ]);

            Merchant::create([
                'merchant_name' => $rows['merchant_name'],
                'cr_number' =>  $rows['cr_number'],
                'user_id' => $user->id,
                'vat' => $rows['vat'],
                'iban' => $rows['iban'],
                'domain' => $rows['domain'],
                'store_display_name' => $rows['store_display_name']
            ]);


    }

     /**
     * @param  Failure  ...$failures
     */
    public function onFailure(Failure ...$failures)
    {
        $this->failures = array_merge($this->failures, $failures);
    }

    /**
     * @return Failure[]|Collection
     */
    public function failures(): Collection
    {
        return new Collection($this->failures);
    }

    public function rules(): array
    {
        return [
            'store_display_name' => ['required']
        ];
    }



}
