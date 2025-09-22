<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'description',
        'amount',
        'receipt_image',
        'booking_date',
        'cash_box_id',
        'category_id',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'booking_date' => 'date',
    ];

    public function cashBox()
    {
        return $this->belongsTo(CashBox::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
