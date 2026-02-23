<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skate extends Model
{
    protected $fillable = [
        'name',
        'brand',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function sizes()
    {
        return $this->hasMany(SkateSize::class);
    }
}
