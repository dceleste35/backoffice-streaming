<?php

namespace App\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum SubscriptionEnum: string implements HasColor, HasLabel
{
    case Free = 'free';
    case Standard = 'standard';
    case Premium = 'premium';
    case Lifetime = 'lifetime';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Free => 'Gratuit',
            self::Standard => 'Standard',
            self::Premium => 'Premium',
            self::Lifetime => 'Pour la vie',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Free => Color::Blue,
            self::Standard => Color::Green,
            self::Premium => Color::Yellow,
            self::Lifetime => Color::Red,
        };
    }
}
