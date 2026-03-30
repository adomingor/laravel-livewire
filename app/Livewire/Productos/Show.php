<?php

namespace App\Livewire\Productos;

use App\Livewire\Forms\ProductoForm;
use App\Models\Producto;
use Livewire\Component;

class Show extends Component
{
    public ProductoForm $form;

    public function mount(Producto $producto)
    {
        $this->form->setProductoModel($producto);
    }

    public function render()
    {
        return view('livewire.producto.show', ['producto' => $this->form->productoModel]);
    }
}
