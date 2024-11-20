<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TextInput extends Component
{
    
    public $name;
    public $label;
    public $value;
    public $error;
    public $required;
    
    /**
     * Create a new component instance.
     */
    public function __construct($name, $label, $value = '', $error = '', $required = false)
    {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
        $this->error = $error;
        $this->required = $required;
    }
    
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.text-input');
    }
}
