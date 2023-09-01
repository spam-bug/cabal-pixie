<?php

namespace App\Modules\Abilities;

use App\Models\Portal\Item\Item;

class PassiveAbilityValueCreator
{
    public static function create($passiveAbility, array $values): void
    {
        if ($values['item1']['idx'] == 0) {
            $item1ID = null;
        } else {
            $item = Item::where('item_idx', $values['item1']['idx'])->first();
            $item1ID = $item->id;
        }

        if ($values['item2']['idx'] == 0) {
            $item2ID = null;
        } else {
            $item = Item::where('item_idx', $values['item2']['idx'])->first();
            $item2ID = $item->id;
        }

        $passiveAbility->values()->create([
            'level' => $values['level'],
            'ap' => $values['ap'],
            'item1_id' => $item1ID,
            'item1_option' => $values['item1']['option'],
            'item1_count' => $values['item1']['count'],
            'item2_id' => $item2ID,
            'item2_option' => $values['item2']['option'],
            'item2_count' => $values['item2']['count'],
            'force_value' => $values['force_value']
        ]);
    }
}
