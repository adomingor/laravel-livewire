<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Producto;

class Productos extends Component
{
    use WithPagination;

    public $search = '';
    public $mostrarPapelera = false;

    // FORM
    public $nuevoProducto = '';

    protected $rules = [
        'nuevoProducto' => 'required|min:3'
    ];

    protected $paginationTheme = 'tailwind';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function togglePapelera()
    {
        $this->mostrarPapelera = !$this->mostrarPapelera;
        $this->resetPage();
    }

    // 🟢 CREAR
    public function crear()
    {
        $this->validate();

        Producto::create([
            'producto' => $this->nuevoProducto,
            'activo' => true
        ]);

        $this->reset('nuevoProducto');

        session()->flash('success', 'Producto creado');
        session()->flash('toast_time', 3000);
    }

    // 🗑️ SOFT DELETE
    public function eliminar($id)
    {
        Producto::where('id', $id)->update(['activo' => false]);

        session()->flash('eliminated', 'Enviado a papelera');
    }

    // ♻️ RESTAURAR
    public function restaurar($id)
    {
        Producto::where('id', $id)->update(['activo' => true]);

        session()->flash('success', 'Restaurado');
    }

    // 💀 DELETE REAL
    public function eliminarDefinitivo($id)
    {
        $producto = Producto::findOrFail($id);

        if ($producto->activo) return;

        $producto->categorias()->detach();
        $producto->delete();

        session()->flash('error', 'Eliminado definitivamente');
    }

    public function render()
    {
        $query = Producto::query()
            ->where('producto', 'like', "%{$this->search}%")
            ->where('activo', !$this->mostrarPapelera);

        $productos = $query->paginate(5);

        return view('livewire.productos', compact('productos'));
    }
}