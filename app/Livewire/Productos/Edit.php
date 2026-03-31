<?php

namespace App\Livewire\Productos;

use App\Livewire\Forms\ProductoForm;
use App\Models\Producto;
use Flux\Flux;
use Livewire\Component;

class Edit extends Component
{
    public ProductoForm $form;

    public function mount(Producto $producto)
    {
        $this->form->setProductoModel($producto);
    }

    public function save()
    {
        $this->form->update();

        $this->form->reset();
        // Si envío varios mensajes, hay que mostrarlos en el blade con una agrupación, Solo tiene esas 3 variantes
        // Flux::toast(text: __('Saved'), variant: 'danger', duration: 5000);
        // Flux::toast(text: __('Saved'), variant: 'warning', duration: 5000);
        Flux::toast(text: __('Saved'), variant: 'success', duration: 3000);

        // Si necesitás un ícono de info, tendrías que usar el callout (en el blade) que sí lo permite:
        // <flux:callout variant="success" icon="information-circle" class="mb-4">
        //     <flux:callout.heading>{{ __('Información') }}</flux:callout.heading>
        // </flux:callout>
        // El ícono information-circle está en Heroicons
        // return $this->redirectRoute('productos.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.producto.edit');
    }
}
