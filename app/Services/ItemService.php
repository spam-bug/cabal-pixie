<?php

namespace App\Services;

use App\Models\Portal\Item\Item;
use App\Models\Portal\Item\ItemDescription;
use Illuminate\Support\Facades\Storage;

final class ItemService
{
    public function seedDatabase()
    {
        if (preg_match_all(static::itemDescriptionPattern(), static::itemContent(), $itemDescriptionMatches)) {
            foreach ($itemDescriptionMatches[1] as $loopIndex => $loopValue) {
                ItemDescription::create(['value' => $itemDescriptionMatches[2][$loopIndex]]);
            }
        }

        $ItemData = static::buildItemData();

        if (preg_match_all(static::itemPattern(), static::itemContent(), $itemMatches)) {
            foreach ($itemMatches[1] as $loopIndex => $loopValue) {
                $itemDescriptionId = (int) str_replace('item_desc', '', $ItemData[$loopIndex]['desc_id']);

                $slot = $ItemData[$loopIndex]['slot_spaces'];
                preg_match('/_(.*?)\s*\(/', $slot, $matches);
                if (isset($matches[1])) {
                    $fragment = explode('x', $matches[1]);
                    $width = $fragment[0];
                    $height = $fragment[1];
                }

                Item::create([
                    'item_idx' => $itemMatches[1][$loopIndex],
                    'name' => $itemMatches[2][$loopIndex],
                    'description_id' => $itemDescriptionId,
                    'width' =>  $width,
                    'height' => $height,
                ]);
            }
        }
    }

    public static function buildItemData()
    {
        $content = Storage::get('client-files/item.xml');
        $xml = simplexml_load_string($content);
        $array = static::xmlToArray($xml);

        $items = [];
        foreach ($array['variable'][0]['variable'] as $loopIndex => $loopValue) {
            if (!$loopIndex) continue;

            $item = [];
            foreach ($loopValue['variable'] as $loopIndex2 => $loopValue2) {
                if (!array_key_exists('value', $loopValue2)) continue;
                $item[$loopValue2['name']] = $loopValue2['value'];
            }

            foreach ($item as $oldKey => $value) {
                $newKey = preg_replace('/\[\d+\]/', '', $oldKey);
                $newItem[$newKey] = $value;
            }


            $items[] = $newItem;
        }

        return $items;
    }

    public static function xmlToArray($xml)
    {
        $array = array();
        foreach ($xml->children() as $child) {
            $name = $child->getName();
            if ($child->count() > 0) {
                $array[$name][] = static::xmlToArray($child);
            } else {
                $array[$name] = (string) $child;
            }
        }
        return $array;
    }

    public static function itemContent(): string
    {
        return Storage::get('client-files/cabal_msg.dec');
    }

    private static function itemPattern(): string
    {
        return '/<msg\s+id="item(\d+)" cont="([^"]+)"\/>/';
    }

    private static function itemDescriptionPattern(): string
    {
        return '/<msg\s+id="item_desc(\d+)" cont="([^"]*)"\/>/';
    }
}
