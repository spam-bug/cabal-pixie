<?php

namespace App\Common;

class AttributeParser
{
    public static function parse(string $attributes): array
    {
        $attributesArray = [];

        preg_match_all('/(\w+)="([^"]+)"/', $attributes, $attributeMatches);

        for ($loopIndex = 0; $loopIndex < count($attributeMatches[0]); $loopIndex++) {
            $attributesArray[$attributeMatches[1][$loopIndex]] = $attributeMatches[2][$loopIndex];
        }

        return $attributesArray;
    }
}
