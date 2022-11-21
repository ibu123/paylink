<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paylink extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'order_id',
        'amount',
        'checkout_url' ,
        'expiration_date',
        'notes',
        'payment_status',
        'send_payment_status',
        'card',
        'commission_percentage',
        'commission'
    ];

    protected static function boot()
    {
        parent::boot();
        if(\Auth::check() && \Auth::user()->type !=0) {
            static::addGlobalScope('store', function(Builder $builder){
                $builder->where('store_id', '=', \Session::get('store'));
            });
        }
    }

    public function store()
    {
        return $this->hasOne(Merchant::class, 'id', 'store_id');
    }
}
