<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'full_name',
        'phone',
        'hours',
        'skate_id',
        'skate_size',
        'status', // pending, paid, cancelled
        'total_price',
    ];

    protected $casts = [
        'hours' => 'integer',
        'skate_size' => 'integer',
        'total_price' => 'decimal:2',
    ];

    public function skate()
    {
        return $this->belongsTo(Skate::class);
    }
}
