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
            'merchant_name' => ['required','regex:/^[\pL\s]+$/u'],
            'cr_number' => ['required', 'digits:10'],
            'vat' => ['required','digits:15'],
            'iban' => ['required','regex:/^[\pL\pN\s]+$/u'],
            'domain' => ['required','regex:/^[a-zA-Z0-9-]+$/'],
            'phone_no' => ['required','digits:10', function($attribute, $value, $fail){
                if($value == \Auth::user()->phone_no) {
                    $fail(__('Admin is not able to create store for himself'));
                }
            }],
            'store_display_name' => ['required','regex:/^[\pL\s]+$/u', 'unique:merchants,store_display_name']
        ];
    }

    /**
     * @return array
     */
    public function customValidationMessages()
    {
        return [
            'merchant_name.*' => __('The Merchant Name field is required and it only contains letters'),
            'cr_number.*' => __('The Commercial No field is required and it must require to have 10 digits'),
            'vat.*' => __('The Vat No field is required and it must require to have 15 digits'),
            'iban.*' => __('The IBan field is required and it must require to have letters and digits'),
            'domain.*' => __('The Domain field is required and it only contains letters, numbers and dashes(-)'),
            'phone_no.required' => __('The Phone No field is required and it must require to have 10 digits'),
            'phone_no.digits' => __('The Phone No field is required and it must require to have 10 digits'),
            'store_display_name.*' => __('The Store Display Name field is required and it only contains letters'),
        ];
    }


}
