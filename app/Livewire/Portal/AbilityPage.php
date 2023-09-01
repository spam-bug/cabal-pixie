<?php

namespace App\Livewire\Portal;

use App\Models\Portal\Ability\BlendedAbility;
use App\Models\Portal\Ability\PassiveAbility;
use App\Models\Portal\Ability\PassiveAbilityValue;
use App\Models\Portal\Item\Item;
use App\Services\AbilityService;
use Livewire\Component;

class AbilityPage extends Component
{
    public function mount(): void
    {
        if (!PassiveAbility::count() && !PassiveAbilityValue::count()) {
            (new AbilityService)->seedDatabase();
        }
    }
}
