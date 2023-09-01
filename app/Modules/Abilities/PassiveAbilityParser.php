<?php

namespace App\Modules\Abilities;

use App\Common\AttributeParser;

class PassiveAbilityParser
{
    private const COST_ABILITYITEM_PATTERN = '/<cost_abilityitem\s+index="(\d+)"[^>]*>(.*?)<\/cost_abilityitem>/s';
    private const VALUE_ABILITYITEM_PATTERN = '/<value_abilityitem\s+index="(\d+)"[^>]*forcecode="(\d+)"[^>]*valuetype="(\d+)"[^>]*forcecode_iconfilename="([^"]+)"[^>]*>(.*?)<\/value_abilityitem>/s';
    private const ABILITYCOST_PATTERN = '/<ability_cost\s+([^\/>]*)\/>/';
    private const ABILITY_VALUE_PATTERN = '/<ability_value\s+([^\/>]*)\/>/';

    public static function parse(string $content): array
    {
        $abilities = [];

        if (preg_match_all(static::COST_ABILITYITEM_PATTERN, $content, $costAbilityItemMatches)) {
            foreach ($costAbilityItemMatches[0] as $loopIndex => $loopValue) {
                $abilities[$loopIndex]['item_idx'] = $costAbilityItemMatches[1][$loopIndex];
                $abilityCostContent = $costAbilityItemMatches[2][$loopIndex];

                if (preg_match_all(static::ABILITYCOST_PATTERN, $abilityCostContent, $abilityCostMatches)) {
                    foreach ($abilityCostMatches[1] as $match) {
                        $attributes = AttributeParser::parse($match);

                        $attributes['item1'] = static::parseItemAttribute($attributes['item1']);
                        $attributes['item2'] = static::parseItemAttribute($attributes['item2']);

                        $abilities[$loopIndex]['levels'][] = $attributes;
                    }
                }
            }
        }

        if (preg_match_all(static::VALUE_ABILITYITEM_PATTERN, $content, $valueAbilityItemMatches)) {
            foreach ($valueAbilityItemMatches[0] as $loopIndex => $loopValue) {
                $abilities[$loopIndex]['force_code'] = (int) $valueAbilityItemMatches[2][$loopIndex];
                $abilities[$loopIndex]['value_type'] = (int) $valueAbilityItemMatches[3][$loopIndex];
                $abilities[$loopIndex]['icon'] = str_replace('J_icn_', '', $valueAbilityItemMatches[4][$loopIndex]) . '.png';

                $abilityValueContent = $valueAbilityItemMatches[5][$loopIndex];

                if (preg_match_all(static::ABILITY_VALUE_PATTERN, $abilityValueContent, $abilityValueMatches)) {
                    foreach ($abilityValueMatches[1] as $loopIndex2 => $match) {
                        $attributes = AttributeParser::parse($match);

                        unset($attributes['level']);

                        $abilities[$loopIndex]['levels'][$loopIndex2] += $attributes;
                    }
                }
            }
        }

        return $abilities;
    }

    private static function parseItemAttribute(string $itemAttribute): array
    {
        $fragments = explode(':', $itemAttribute);

        return [
            'idx' => $fragments[0],
            'option' => $fragments[1],
            'count' => $fragments[2],
        ];
    }
}
