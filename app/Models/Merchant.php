<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Merchant extends Model
{
    use HasFactory;

    protected $fillable = [
        'merchant_name',
        'user_id',
        'cr_number' ,
        'vat' ,
        'iban',
        'domain' ,
        'phone_no' ,
        'store_display_name'
    ];

    /**
     * Get the user that owns the Merchant
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function links()
    {
        return $this->hasMany(Paylink::class, 'store_id', 'id');
    }

    public function sumAmount()
    {
        return $this->hasMany(Paylink::class, 'store_id', 'id')->addSelect(
            \DB::raw('SUM(amount), SUM(commission)')
        )->group_by('store_id');
    }
}
