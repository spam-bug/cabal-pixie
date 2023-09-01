<?php

namespace App\Modules\Abilities;

use App\Common\AttributeParser;
use App\Common\FileReader;

class BlendedAbilityParser
{
    public const ABILITY_RECIPE_PATTERN = '/<ability_recipe\s+([^\/>]*)\/>/';
    public const ABILITY_DESC_PATTERN = '/<msg\s+id="ability_recipe(\d+)"\s+([^\/>]*)\/>/';
    public const ABILITY_COST_PATTERN = '/<ability_cost\s+index="(\d+)"\s+ap="(\d+)"\s+cost="(\d+):(\d+)"\s+\/>/';
    public const VALUE_ABILITYITEM_PATTERN = '/<value_abilityitem\s+index="(\d+)"\s+act_rate="(\d+)"\s+target_type="(\d+)"\siconfilename="J_icn_force([^"]+)"[^>]*>(.*?)<\/value_abilityitem>/s';

    public static function parse(string $content): array
    {
        return [
            'recipes' => static::buildBlendedRecipeData($content),
            'abilities' => static::buildBlendedAbilityData($content),
        ];
    }

    public static function buildBlendedRecipeData(string $content): array
    {
        if (preg_match_all(static::ABILITY_RECIPE_PATTERN, $content, $blendedRecipeMatches)) {
            // Get all recipe
            $recipes = [];

            foreach ($blendedRecipeMatches[1] as $blendedRecipe) {
                $recipeAttributes = AttributeParser::parse($blendedRecipe);

                $recipeAttributes['material1'] = static::parseMaterialAttribute($recipeAttributes['material1']);
                $recipeAttributes['material2'] = static::parseMaterialAttribute($recipeAttributes['material2']);
                $recipeAttributes['material3'] = static::parseMaterialAttribute($recipeAttributes['material3']);

                // Get the name of the recipe at the cabal_msg.dec
                $cabalMsgContent = FileReader::client('cabal_msg.dec')->read();
                $descriptions = [];

                if (preg_match_all(static::ABILITY_DESC_PATTERN, $cabalMsgContent, $blendedDescriptionMatches)) {
                    foreach ($blendedDescriptionMatches[0] as $blendedDrescription) {
                        $blendedDescriptionAttributes = AttributeParser::parse($blendedDrescription);
                        $descriptions[$blendedDescriptionAttributes['id']] = $blendedDescriptionAttributes['cont'];
                    }
                }

                $recipeAttributes['name_value'] = $descriptions[$recipeAttributes['name_key']];

                $recipes[] = $recipeAttributes;
            }
        }

        return $recipes;
    }

    public static function buildBlendedAbilityData(string $content): array
    {
        $blendedAbilities = [];

        if (preg_match_all(static::ABILITY_COST_PATTERN, $content, $abilityCostMatches)) {
            foreach ($abilityCostMatches[0] as $abilityCost) {
                $blendedAbilityAttributes = AttributeParser::parse($abilityCost);

                $blendedAbilityAttributes['cost'] = static::parseMaterialAttribute($blendedAbilityAttributes['cost']);

                $blendedAbilities[] = $blendedAbilityAttributes;
            }
        }

        if (preg_match_all(static::VALUE_ABILITYITEM_PATTERN, $content, $valueAbilityItemMatches)) {
            foreach ($valueAbilityItemMatches[0] as $loopIndex => $valueAbilityItem) {
                $valueAbilityItemAttributes = AttributeParser::parse($valueAbilityItem);

                $valueAbilityItemAttributes['effect1'] = static::parseEffectAttribute($valueAbilityItemAttributes['effect1']);
                $valueAbilityItemAttributes['effect2'] = static::parseEffectAttribute($valueAbilityItemAttributes['effect2']);
                $valueAbilityItemAttributes['effect3'] = static::parseEffectAttribute($valueAbilityItemAttributes['effect3']);
                $valueAbilityItemAttributes['effect4'] = static::parseEffectAttribute($valueAbilityItemAttributes['effect4']);

                if ($blendedAbilities[$loopIndex]['index'] == $valueAbilityItemAttributes['index']) {
                    $blendedAbilities[$loopIndex] += $valueAbilityItemAttributes;
                }
            }
        }

        return $blendedAbilities;
    }

    private static function parseMaterialAttribute(string $materialAttribute): array
    {
        $fragments = explode(':', $materialAttribute);

        return [
            'item_idx' => $fragments[0],
            'count' => $fragments[1],
        ];
    }

    private static function parseEffectAttribute(string $effectAttribute): array
    {
        $fragments = explode(':', $effectAttribute);

        return [
            'option' => $fragments[0],
            'value' => $fragments[1],
            'value_type' => $fragments[2],
        ];
    }
}
