<?php

namespace App\Modules\Abilities;

use App\Models\Portal\Ability\BlendedAbility;
use App\Models\Portal\Ability\BlendedAbilityRecipe;

class BlendedAbilityRecipeCreator
{
    public static function create(array $recipe): void
    {
        $ability = BlendedAbility::where('blended_idx', $recipe['result_index'])->first();

        $recipe['blended_ability_id'] = $ability->id;

        BlendedAbilityRecipe::create($recipe);
    }
}
