<?php

use App\Livewire\Portal\AbilityPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('abilities', AbilityPage::class);
