<?php

namespace App\Providers;

use App\Livewire\Portal\AbilityConverstionRateForm;
use App\Livewire\Portal\AbilityDatabaseForm;
use App\Livewire\Portal\AbilityTable;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LivewireServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        Livewire::component('ability-database-form', AbilityDatabaseForm::class);
        Livewire::component('ability-conversion-rate-form', AbilityConverstionRateForm::class);
        Livewire::component('ability-table', AbilityTable::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
