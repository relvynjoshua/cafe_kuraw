<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Footer extends Component
{
    public $activePage;

    public function __construct($activePage = null)
    {
        $this->activePage = $activePage;
    }

    public function render()
    {
        return view('components.footer');
    }
}
