<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CashBox extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'balance',
    ];

    protected $casts = [
        'balance' => 'decimal:2',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
