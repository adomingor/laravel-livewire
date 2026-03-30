<?php

namespace App\Livewire\Categorias;

use App\Livewire\Forms\CategoriaForm;
use App\Models\Categoria;
use Livewire\Component;

class Show extends Component
{
    public CategoriaForm $form;

    public function mount(Categoria $categoria)
    {
        $this->form->setCategoriaModel($categoria);
    }

    public function render()
    {
        return view('livewire.categoria.show', ['categoria' => $this->form->categoriaModel]);
    }
}
