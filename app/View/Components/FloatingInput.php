<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FloatingInput extends Component
{
    /**
     * Create a new component instance.
     */
    public $type, $name, $value, $label;
    public function __construct(
        $type = null,
        $name = null,
        $value = null,
        $label = null,
    ) {
        $this->type = $type;
        $this->name = $name;
        $this->value = $value;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.floating-input');
    }
}