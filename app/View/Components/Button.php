<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    /**
     * Create a new component instance.
     */
    public $type, $btn, $label, $icon;
    public function __construct(
        $type = null,
        $btn = null,
        $label = null,
        $icon = null
    ) {
        $this->type = $type;
        $this->btn = $btn;
        $this->label = $label;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button');
    }
}