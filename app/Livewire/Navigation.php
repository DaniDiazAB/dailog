<?php

namespace App\Livewire;

use App\Models\Tipo;
use Livewire\Component;

class Navigation extends Component
{
    public function render()
    {

        $tipos = Tipo::all();
        return view('livewire.navigation', compact('tipos'));
    }
}
