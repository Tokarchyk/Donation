<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SortDirection extends Component
{
    public $sortDirection;
    public $sortColumn;

    public function __construct($sort, $column)
    {
        $this->sortDirection = $sort;
        $this->sortColumn = $column;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sort-direction');
    }
}
