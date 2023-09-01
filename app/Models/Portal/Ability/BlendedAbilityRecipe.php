<?php

namespace App\Models\Portal\Ability;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BlendedAbilityRecipe extends Model
{
    protected $connection = 'web';

    protected $fillable = [
        'rate',
        'alz',
        'material1',
        'material2',
        'material3',
        'result_index',
        'blended_ability_id',
        'name_key',
        'name_value',
    ];

    protected $casts = [
        'material1' => 'array',
        'material2' => 'array',
        'material3' => 'array',
    ];

    public function result(): BelongsTo
    {
        return $this->belongsTo(BlendedAbility::class);
    }
}
