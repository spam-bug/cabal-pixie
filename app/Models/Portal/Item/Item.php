<?php

namespace App\Models\Portal\Item;

use App\Models\Portal\Item\ItemDescription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Item extends Model
{
    protected $fillable = [
        'item_idx',
        'name',
        'description_id',
        'width',
        'height',
    ];

    public function description(): HasOne
    {
        return $this->hasOne(ItemDescription::class);
    }
}
