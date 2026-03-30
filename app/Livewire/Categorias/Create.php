<?php

namespace App\Livewire\Categorias;

use App\Livewire\Forms\CategoriaForm;
use App\Models\Categoria;
use Livewire\Component;

class Create extends Component
{
    public CategoriaForm $form;

    public function mount(Categoria $categoria)
    {
        $this->form->setCategoriaModel($categoria);
    }

    public function save()
    {
        $this->form->store();

        return $this->redirectRoute('categorias.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.categoria.create');
    }
}
