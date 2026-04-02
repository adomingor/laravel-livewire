<?php

namespace App\Livewire\Categorias;

use App\Livewire\Forms\CategoriaForm;
use App\Models\Categoria;
use Livewire\Component;

class Edit extends Component
{
    public CategoriaForm $form;

    public function mount(Categoria $categoria)
    {
        $this->authorize('update', $categoria);

        $this->form->setCategoriaModel($categoria);
    }

    public function save()
    {
        $this->authorize('update', $this->form->categoriaModel);

        $this->form->update();

        return $this->redirectRoute('categorias.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.categoria.edit');
    }
}
