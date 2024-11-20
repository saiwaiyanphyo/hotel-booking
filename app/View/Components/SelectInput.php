<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectInput extends Component
{
    public $name;
    public $label;
    public $options;
    public $selected;
    public $value;
    public $error;
    public $required;
    
    /**
     * Create a new component instance.
     */
    public function __construct(
        $name,
        $label,
        $options = [],
        $selected = '',
        $error = '',
        $required = false,
        $value = ''
    ) {
        $this->name = $name;
        $this->label = $label;
        $this->options = $options;
        $this->selected = $selected;
        $this->error = $error;
        $this->required = $required;
        
        if (empty($value)) {
            $this->value = old($name, $selected);
        } else {
            $this->value = $value;
        }
    }
    
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select-input');
    }
}
