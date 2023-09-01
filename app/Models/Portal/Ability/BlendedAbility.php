<?php

namespace App\Models\Portal\Ability;

use App\Models\Portal\Item\Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BlendedAbility extends Model
{
    protected $connection = 'web';

    protected $fillable = [
        'item_id',
        'blended_idx',
        'ap',
        'cost',
        'act_rate',
        'target_type',
        'effect1',
        'effect2',
        'effect3',
        'effect4',
        'icon',
    ];

    protected $casts = [
        'cost' => 'array',
        'effect1' => 'array',
        'effect2' => 'array',
        'effect3' => 'array',
        'effect4' => 'array',
    ];

    public function recipe(): HasOne
    {
        return $this->hasOne(BlendedAbilityRecipe::class);
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
}
