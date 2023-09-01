<?php

namespace App\Modules\Abilities;

use App\Models\Portal\Ability\BlendedAbility;
use App\Models\Portal\Item\Item;

class BlendedAbilityCreator
{
    public static function create(array $ability): BlendedAbility
    {
        $item = Item::where('item_idx', $ability['index'])->first();
        $ability['item_id'] = $item->id;

        $ability['blended_idx'] = $ability['index'];
        unset($ability['index']);

        $ability['icon'] = str_replace('J_icn_', '', $ability['iconfilename']);
        unset($ability['iconfilename']);

        return BlendedAbility::create($ability);
    }
}
