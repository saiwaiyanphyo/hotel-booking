<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DateTimeInput extends Component
{
    public string $name;
    public string $id;
    public string $label;
    public string $value;
    public bool $required;
    
    /**
     * Create a new component instance.
     */
    public function __construct(
        string $name,
        string $id,
        string $label,
        string $value,
        bool $required = false
    ) {
        $this->name = $name;
        $this->id = $id;
        $this->label = $label;
        $this->value = $value;
        $this->required = $required;
    }
    
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.date-time-input');
    }
}
