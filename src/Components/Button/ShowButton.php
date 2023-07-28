<?php

namespace Bengels\LaravelTable\Component\Button;

use Closure;
use Illuminate\Contracts\View\View;

class ShowButton extends Button
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('components.button.show-button');
    }
}
