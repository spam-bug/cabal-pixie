<?php

use App\Livewire\Portal\AbilityPage;
use App\Livewire\Portal\ItemPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('abilities', AbilityPage::class)->name('abilities');
Route::get('items', ItemPage::class)->name('items');
