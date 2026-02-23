<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkateSize extends Model
{
    protected $table = 'skate_sizes';

    protected $fillable = [
        'skate_id',
        'size',
        'quantity',
    ];

    protected $casts = [
        'size' => 'integer',
        'quantity' => 'integer',
    ];

    public function skate()
    {
        return $this->belongsTo(Skate::class);
    }
}
