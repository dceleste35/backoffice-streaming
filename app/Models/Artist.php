<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Artist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function albums(): HasMany
    {
        return $this->hasMany(Album::class);
    }

    public function music(): BelongsToMany
    {
        return $this->belongsToMany(Music::class);
    }
}
