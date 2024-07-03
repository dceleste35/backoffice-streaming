<?php

namespace App\Models;

use App\Enums\SubscriptionEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    protected $casts = [
        'name' => SubscriptionEnum::class,
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->using(UserSubscription::class)
            ->withPivot('start_date', 'end_date');
    }
}
