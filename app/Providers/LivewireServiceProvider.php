<?php

namespace App\Providers;

use App\Livewire\Portal\AbilityDatabaseForm;
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
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
