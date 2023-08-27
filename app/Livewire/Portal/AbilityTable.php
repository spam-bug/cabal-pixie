<?php

namespace App\Livewire\Portal;

use App\Models\Portal\Ability\PassiveAbility;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class AbilityTable extends Component
{
    use WithPagination;

    public function render()
    {
        return view('portal.ability-table', [
            'essenceRunes' => PassiveAbility::with(['values', 'item'])->paginate(10),
        ]);
    }
}
