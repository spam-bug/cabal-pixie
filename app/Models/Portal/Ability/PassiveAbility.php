<?php

namespace App\Models\Portal\Ability;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PassiveAbility extends Model
{
    protected $connection = 'web';

    protected $fillable = [
        'item_idx',
        'force_code',
        'value_type',
        'icon',
    ];

    public function values(): HasMany
    {
        return $this->hasMany(PassiveAbilityValue::class);
    }
}
