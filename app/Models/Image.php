<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'url',
    ];

    public function property(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Property::class);
    }
}
