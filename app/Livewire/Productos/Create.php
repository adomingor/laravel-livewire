<?php

namespace App\Livewire\Productos;

use App\Livewire\Forms\ProductoForm;
use App\Models\Producto;
use Livewire\Component;

class Create extends Component
{
    public ProductoForm $form;

    public function mount(Producto $producto)
    {
        $this->form->setProductoModel($producto);
    }

    public function save()
    {
        $this->form->store();

        // return $this->redirectRoute('productos.index', navigate: true);
        return redirect()->back()->with('success', {{ _('Saved')}}');
    }

    public function render()
    {
        return view('livewire.producto.create');
    }
}
