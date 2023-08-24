<?php

namespace App\Services;

use App\Models\Portal\Ability\PassiveAbility;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

final class AbilityService
{
    public static function seedDatabase(): Collection
    {
        foreach (static::buildAbilityData() as $ability) {
            $passiveAbility = PassiveAbility::create([
                'item_idx' => $ability['item_idx'],
                'force_code' => $ability['force_code'],
                'value_type' => $ability['value_type'],
                'icon' => $ability['icon'],
            ]);

            foreach ($ability['levels'] as $values) {
                $passiveAbility->values()->create([
                    'level' => $values['level'],
                    'ap' => $values['ap'],
                    'item1_idx' => $values['item1']['idx'],
                    'item1_option' => $values['item1']['option'],
                    'item1_count' => $values['item1']['count'],
                    'item2_idx' => $values['item2']['idx'],
                    'item2_option' => $values['item2']['option'],
                    'item2_count' => $values['item2']['count'],
                    'force_value' => $values['force_value']
                ]);
            }
        }

        return PassiveAbility::with('values')->get();
    }

    private static function buildAbilityData(): array
    {
        $abilities = [];

        if (preg_match_all(static::costAbilityItemPattern(), static::abilityContent(), $costAbilityItemMatches)) {
            foreach ($costAbilityItemMatches[0] as $loopIndex => $loopValue) {
                $abilities[$loopIndex]['item_idx'] = $costAbilityItemMatches[1][$loopIndex];

                $abilityCostContent = $costAbilityItemMatches[2][$loopIndex];

                if (preg_match_all(static::abilityCostPattern(), $abilityCostContent, $abilityCostMatches)) {
                    $abilityCosts = [];

                    foreach ($abilityCostMatches[1] as $match) {
                        $attributes = static::parseAttribute($match);

                        $attributes['item1'] = static::parseItemAttribute($attributes['item1']);
                        $attributes['item2'] = static::parseItemAttribute($attributes['item2']);

                        $abilities[$loopIndex]['levels'][] = $attributes;
                    }
                }
            }
        }

        if (preg_match_all(static::valueAbilityItemPattern(), static::abilityContent(), $valueAbilityItemMatches)) {

            foreach ($valueAbilityItemMatches[0] as $loopIndex => $loopValue) {
                $abilities[$loopIndex]['force_code'] = (int) $valueAbilityItemMatches[2][$loopIndex];
                $abilities[$loopIndex]['value_type'] = (int) $valueAbilityItemMatches[3][$loopIndex];
                $abilities[$loopIndex]['icon'] = str_replace('J_icn_', '', $valueAbilityItemMatches[4][$loopIndex]) . '.png';

                $abilityValueContent = $valueAbilityItemMatches[5][$loopIndex];

                if (preg_match_all(static::abilityValuePattern(), $abilityValueContent, $abilityValueMatches)) {
                    $abilityValues = [];
                    foreach ($abilityValueMatches[1] as $loopIndex2 => $match) {
                        $attributes = static::parseAttribute($match);

                        unset($attributes['level']);

                        $abilities[$loopIndex]['levels'][$loopIndex2] += $attributes;
                    }
                }
            }
        }


        return $abilities;
    }

    private static function abilityContent(): string
    {
        return Storage::get('client-files/Ability.dec');
    }

    private static function costAbilityItemPattern(): string
    {
        return '/<cost_abilityitem\s+index="(\d+)"[^>]*>(.*?)<\/cost_abilityitem>/s';
    }

    private static function abilityCostPattern(): string
    {
        return '/<ability_cost\s+([^\/>]*)\/>/';
    }

    private static function valueAbilityItemPattern(): string
    {
        return '/<value_abilityitem\s+index="(\d+)"[^>]*forcecode="(\d+)"[^>]*valuetype="(\d+)"[^>]*forcecode_iconfilename="([^"]+)"[^>]*>(.*?)<\/value_abilityitem>/s';
    }

    private static function abilityValuePattern(): string
    {
        return '/<ability_value\s+([^\/>]*)\/>/';
    }

    private static function parseAttribute(string $attributes): array
    {
        $attributesArray = [];

        preg_match_all('/(\w+)="([^"]+)"/', $attributes, $attributeMatches);

        for ($loopIndex = 0; $loopIndex < count($attributeMatches[0]); $loopIndex++) {
            $attributesArray[$attributeMatches[1][$loopIndex]] = $attributeMatches[2][$loopIndex];
        }

        return $attributesArray;
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
