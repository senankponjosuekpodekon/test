<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AuthLayout extends AbstractLayout
{

    /**
     * Get the view / contents that represent the component.
     */

     public function __construct(
        public string $title = '',
        public string $action ='',
        public string $submitMessage = 'Soumettre',

        
        )
     {

        parent::__construct($title);
    }

    public function render(): View|Closure|string
    {
        return view('layouts.auth');
    }
}
