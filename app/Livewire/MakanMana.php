<?php

namespace App\Livewire;

use Livewire\Component;

class MakanMana extends Component
{
    public $title = 'Find';  

    public $locationPermission = 0; //0 for no 1 for yes
    public $locationName = 'Fetching...';

    public $filters = [

    ];
    
    public $currentStep = 1;  // Default to Step 1
    public $stepFinished = [
        'step1' => 0,
        'step2' => 0,
        'step3' => 0,
    ];

    public function setStep($step)
    {
        $this->currentStep = $step;
    }

    public function updated()
    {

    }

    public function render()
    {
        return view('livewire.makan-mana')
            ->layout('components.layouts.app', ['title' => $this->title]);
    }
}
