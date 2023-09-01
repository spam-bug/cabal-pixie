<?php

namespace App\Modules\Abilities;

use App\Models\Portal\Item\Item;
use App\Models\Portal\Ability\PassiveAbility;

class PassiveAbilityCreator
{
    public static function create(array $ability): PassiveAbility
    {
        $item = Item::where('item_idx', $ability['item_idx'])->first();

        $totalRequiredAP = 0;
        foreach ($ability['levels'] as $values) {
            $totalRequiredAP += (int) $values['ap'];
        }

        return PassiveAbility::create([
            'item_id' => $item->id,
            'force_code' => $ability['force_code'],
            'value_type' => $ability['value_type'],
            'icon' => $ability['icon'],
            'max_level' => count($ability['levels']),
            'total_ap_required' => $totalRequiredAP,
        ]);
    }
}
