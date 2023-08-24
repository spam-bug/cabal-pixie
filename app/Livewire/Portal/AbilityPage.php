<?php

namespace App\Livewire\Portal;

use App\Models\Portal\Ability\PassiveAbility;
use App\Models\Portal\Ability\PassiveAbilityValue;
use App\Services\AbilityService;
use Illuminate\Support\Facades\Storage;
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
