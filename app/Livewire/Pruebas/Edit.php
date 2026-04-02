<?php

namespace App\Livewire\Pruebas;

use App\Livewire\Forms\PruebaForm;
use App\Models\Prueba;
use Livewire\Component;

class Edit extends Component
{
    public PruebaForm $form;

    public function mount(Prueba $prueba)
    {
        $this->authorize('update', $prueba);

        $this->form->setPruebaModel($prueba);
    }

    public function save()
    {
        $this->authorize('update', $this->form->pruebaModel);

        $this->form->update();

        return $this->redirectRoute('pruebas.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.prueba.edit');
    }
}
