<?php

namespace App\Models\Portal\Ability;

use App\Models\Portal\Item\Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PassiveAbility extends Model
{
    protected $connection = 'web';

    protected $fillable = [
        'item_id',
        'force_code',
        'value_type',
        'icon',
        'max_level',
        'total_ap_required',
    ];

    public function values(): HasMany
    {
        return $this->hasMany(PassiveAbilityValue::class);
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
}
