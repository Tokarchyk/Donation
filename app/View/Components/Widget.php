<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Widget extends Component
{
    public $title;
    public $amount;
    public $email;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $title,
        $amount,
        $email = null)
    {
        $this->title = $title;
        $this->amount = $amount;
        $this->email = $email;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.widget');
    }
}
