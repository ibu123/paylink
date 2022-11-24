<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaylinkInvoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'paylink_id'
    ];
}

