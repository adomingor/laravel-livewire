<?php

namespace App\Livewire\Pruebas;

use App\Livewire\Forms\PruebaForm;
use App\Models\Prueba;
use Livewire\Component;

class Create extends Component
{
    public PruebaForm $form;

    public function mount(Prueba $prueba)
    {
        $this->form->setPruebaModel($prueba);
    }

    public function save()
    {
        $this->form->store();

        return $this->redirectRoute('pruebas.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.prueba.create');
    }
}
