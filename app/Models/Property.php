<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin \Eloquent
 * @mixin IdeHelperProperty
 */
class Property extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function options(): BelongsToMany
    {
        return $this->belongsToMany(\App\Models\Option::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(\App\Models\Image::class);
    }
}
