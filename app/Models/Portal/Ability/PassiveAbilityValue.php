<?php

namespace App\Models\Portal\Ability;

use App\Models\Portal\Item\Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PassiveAbilityValue extends Model
{
    protected $connection = 'web';

    protected $fillable = [
        'level',
        'ap',
        'item1_id',
        'item1_option',
        'item1_count',
        'item2_id',
        'item2_option',
        'item2_count',
        'force_value',
    ];

    public function passiveAbility(): BelongsTo
    {
        return $this->belongsTo(PassiveAbility::class);
    }

    public function item1(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'item1_id', 'id');
    }

    public function item2(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'item2_id', 'id');
    }
}
