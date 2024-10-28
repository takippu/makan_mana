<?php

namespace App\Livewire;

use Livewire\Component;

class HomeIndex extends Component
{
    public $title = 'Home';
    
    public function mount(){

    }

    public function render()
    {
        return view('livewire.index')
        ->layout('components.layouts.app', ['title' => $this->title]);

    }
}
