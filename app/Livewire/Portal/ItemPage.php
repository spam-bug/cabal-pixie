<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use App\Services\ItemService;
use App\Models\Portal\Item\Item;
use App\Models\Portal\Item\ItemDescription;

class ItemPage extends Component
{
    public function mount(): void
    {
        // ItemDescription::truncate();
        // Item::truncate();
        //  (new ItemService)->seedDatabase();

        //$item = Item::find(1);



        // dd(ItemDescription::find($item->description_id));
    }
}
