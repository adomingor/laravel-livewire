<?php

namespace App\Livewire\Productos;

use App\Livewire\Forms\ProductoForm;
use App\Models\Producto;
use Flux\Flux;
use Livewire\Component;

class Create extends Component
{
    public ProductoForm $form;

    public function mount(Producto $producto)
    {
        $this->authorize('create', Producto::class);

        $this->form->setProductoModel($producto);
    }

    public function save()
    {
        $this->authorize('create', Producto::class);

        $this->form->store();

        // session()->flash('success', __('Saved'));
        // return $this->redirectRoute('productos.create', navigate: true);

        $this->form->reset();

        // Opción 1 — Callout inline en la vista (requiere @if session en el blade)
        // session()->flash('success', __('Saved'));

        // Opción 2 — Toast flotante de Flux (requiere <flux:toast /> en el blade)
        Flux::toast(text: __('Saved'), variant: 'success', duration: 3000);
    }

    public function render()
    {
        return view('livewire.producto.create');
    }
}
