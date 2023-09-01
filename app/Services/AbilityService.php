<?php

namespace App\Services;

use App\Common\FileReader;
use App\Models\Portal\Ability\BlendedAbility;
use App\Models\Portal\Ability\BlendedAbilityRecipe;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Portal\Ability\PassiveAbility;
use App\Models\Portal\Ability\PassiveAbilityValue;
use App\Modules\Abilities\BlendedAbilityCreator;
use App\Modules\Abilities\BlendedAbilityParser;
use App\Modules\Abilities\BlendedAbilityRecipeCreator;
use App\Modules\Abilities\PassiveAbilityParser;
use App\Modules\Abilities\PassiveAbilityCreator;
use App\Modules\Abilities\PassiveAbilityValueCreator;

final class AbilityService
{
    private const CLIENT_FILE_NAME = 'Ability.dec';
    private const SERVER_FILE_NAME = 'Ability.scp';

    public static function seedDatabase(bool $truncate = false): void
    {
        $content = FileReader::client(static::CLIENT_FILE_NAME)->read();

        static::seedPassiveAbility($content, $truncate);
        static::seedBlendedAbility($content, $truncate);
    }

    public static function seedPassiveAbility(string $content, bool $truncate = false): void
    {
        if ($truncate) {
            PassiveAbility::truncate();
            PassiveAbilityValue::truncate();
        }

        $abilities = PassiveAbilityParser::parse($content);

        foreach ($abilities as $ability) {
            $passiveAbility = PassiveAbilityCreator::create($ability);

            foreach ($ability['levels'] as $values) {
                PassiveAbilityValueCreator::create($passiveAbility, $values);
            }
        }
    }

    public static function seedBlendedAbility(string $content, bool $truncate = false): void
    {
        if ($truncate) {
            BlendedAbility::truncate();
            BlendedAbilityRecipe::truncate();
        }

        extract(BlendedAbilityParser::parse($content));

        foreach ($abilities as $ability) {
            BlendedAbilityCreator::create($ability);
        }

        foreach ($recipes as $recipe) {
            BlendedAbilityRecipeCreator::create($recipe);
        }
    }
}
