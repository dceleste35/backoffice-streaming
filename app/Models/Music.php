<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

class Music extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'release_date',
        'duration',
        'play_count',
        'file_path',
    ];

    protected $casts = [
        'release_date' => 'datetime:Y-m-d H:i:s',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function playlists(): BelongsToMany
    {
        return $this->belongsToMany(Playlist::class);
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }

    public function artists(): BelongsToMany
    {
        return $this->belongsToMany(Artist::class);
    }

    public function albums(): BelongsToMany
    {
        return $this->belongsToMany(Album::class);
    }

    public function imageUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                return match (true) {
                    $this->file_path !== null => Storage::disk('covers')->url($this->file_path),
                    default => "https://via.placeholder.com/400x400/000000/FFFFFF/?text={$this->name}",
                };
            }
        );
    }
}
