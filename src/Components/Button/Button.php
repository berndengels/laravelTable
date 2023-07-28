<?php

namespace Bengels\LaravelTable\Component\Button;

use Bengels\LaravelTable\Component\Component;

abstract class Button extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public ?string $route = null,
        public ?string $class = null
    )
    {}
}
