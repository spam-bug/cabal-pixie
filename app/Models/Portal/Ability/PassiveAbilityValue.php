<?php

namespace App\Models\Portal\Ability;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PassiveAbilityValue extends Model
{
    protected $connection = 'web';

    protected $fillable = [
        'level',
        'ap',
        'item1_idx',
        'item1_option',
        'item1_count',
        'item2_idx',
        'item2_option',
        'item2_count',
        'force_value',
    ];

    public function passiveAbility(): BelongsTo
    {
        return $this->belongsTo(PassiveAbility::class);
    }
}
