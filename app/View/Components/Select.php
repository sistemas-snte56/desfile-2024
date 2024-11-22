<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{
    /**
     * Create a new component instance.
     */

    public $name;
    public $selected;
    public $options;
    public function __construct($name, $selected = null, $options = [])
    {
        $this->name = $name;
        $this->selected = $selected;
        $this->options = $options;
        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select');
    }
}
