<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NumberInput extends Component
{
    public $name;
    public $label;
    public $value;
    public $error;
    public $required;
    public $step;
    
    
    /**
     * Create a new component instance.
     */
    public function __construct($name, $label, $value = '', $error = '', $required = false, $step = false)
    {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
        $this->error = $error;
        $this->required = $required;
        $this->step = $step;
    }
    
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.number-input');
    }
}
