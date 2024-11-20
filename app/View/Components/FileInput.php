<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FileInput extends Component
{
    public $name;
    public $label;
    public $value;
    public $error;
    public $required;
    public $accept;
    public $multiple;
    
    /**
     * Create a new component instance.
     */
    public function __construct(
        $name,
        $label,
        $value = '',
        $error = '',
        $required = false,
        $accept = '',
        $multiple = false
    ) {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
        $this->error = $error;
        $this->required = $required;
        $this->accept = $accept;
        $this->multiple = $multiple;
    }
    
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.file-input');
    }
}
