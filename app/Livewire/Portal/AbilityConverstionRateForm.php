<?php

namespace App\Livewire\Portal;

use App\Models\Portal\Configuration;
use Livewire\Attributes\Rule;
use Livewire\Component;

class AbilityConverstionRateForm extends Component
{
    public bool $editable = false;

    #[Rule('required|integer')]
    public int|string $rate = 10000000;
    private int|string $originalRate = '';

    public function mount(): void
    {
        $config = Configuration::where('key', 'ap_conversion_rate')->first();

        if (is_null($config)) {
            $this->rate = "Not Set";
            return;
        }

        $this->rate = $config->value;
        $this->originalRate = $this->rate;
    }

    public function edit(): void
    {
        if (!$this->editable) {
            $this->editable = true;

            if ($this->rate === 'Not Set') {
                $this->rate = '';
            }
        } else {
            $this->editable = false;

            $this->rate = $this->originalRate;
        }
    }

    public function render()
    {
        return view('portal.ability-converstion-rate-form');
    }
}
