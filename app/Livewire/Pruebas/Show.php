<?php

namespace App\Livewire\Pruebas;

use App\Livewire\Forms\PruebaForm;
use App\Models\Prueba;
use Livewire\Component;

class Show extends Component
{
    public PruebaForm $form;

    public function mount(Prueba $prueba)
    {
        $this->form->setPruebaModel($prueba);
    }

    public function render()
    {
        return view('livewire.prueba.show', ['prueba' => $this->form->pruebaModel]);
    }
}
