<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PortalLayout extends Component
{
    public function __construct(public string $pageName)
    {
    }

    public function isActive(string $uri): bool
    {
        return request()->is("portal/$uri");
    }

    public function render(): View
    {
        return view('components.layouts.portal');
    }
}
