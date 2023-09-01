<?php

namespace App\Livewire\Portal;

use App\Models\Portal\Ability\BlendedAbility;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Models\Portal\Ability\PassiveAbility;

class AbilityTable extends Component
{
    use WithPagination;

    #[Url]
    public string $currentTab = 'essence';

    #[Url]
    public string $search = '';

    public function getAbilities()
    {
        $query = null;

        if ($this->currentTab == 'essence') {
            $query = PassiveAbility::with(['values', 'item']);
        } elseif ($this->currentTab == 'blended') {
            $query = BlendedAbility::with(['recipe', 'item']);
        }

        if (is_null($query)) return [];

        return $query->whereHas('item', function ($itemQuery) {
            $itemQuery->where('name', 'like', '%' . $this->search . '%');
        })->paginate(10);
    }

    public function render()
    {
        return view('portal.ability-table', [
            'abilities' => $this->getAbilities()
        ]);
    }
}
