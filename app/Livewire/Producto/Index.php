<?php

namespace App\Livewire\Producto;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\View\View;
use Livewire\Component;

class Index extends Component
{
    public $items;

    public bool $modal = false;

    public ?int $editingId = null;

    public string $producto = '';

    public string $descripcion = '';

    public bool $activo = true;

    public array $catSeleccionadas = [];

    public function mount(): void
    {
        $this->loadData();
    }

    public function loadData(): void
    {
        $this->items = Producto::all();
    }

    public function edit(int $id): void
    {
        $item = Producto::findOrFail($id);
        $this->editingId = $id;
        $this->producto = $item->producto;
        $this->descripcion = $item->descripcion ?? '';
        $this->activo = $item->activo;
        $this->catSeleccionadas = $item->categorias()->pluck('categorias.id')->toArray();
        $this->modal = true;
    }

    public function save(): void
    {
        $this->validate([
            'producto' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'activo' => 'boolean',
            'catSeleccionadas' => 'array',
            'catSeleccionadas.*' => 'exists:categorias,id',
        ]);

        $pivotData = array_fill_keys($this->catSeleccionadas, [
            'id_users' => auth()->id() ?? 1,
            'fecha_ins' => now(),
        ]);

        if ($this->editingId) {
            $model = Producto::findOrFail($this->editingId);
            $model->update([
                'producto' => $this->producto,
                'descripcion' => $this->descripcion,
                'activo' => $this->activo,
                'fecha_upd' => now(),
            ]);
        } else {
            $model = Producto::create([
                'producto' => $this->producto,
                'descripcion' => $this->descripcion,
                'activo' => $this->activo,
                'id_users' => auth()->id() ?? 1,
                'fecha_ins' => now(),
            ]);
        }

        $model->categorias()->sync($pivotData);

        $this->reset(['producto', 'descripcion', 'activo', 'catSeleccionadas', 'editingId']);
        $this->modal = false;
        $this->loadData();
    }

    public function render(): View
    {
        return view('livewire.producto.index', [
            'categorias' => Categoria::all(),
        ]);
    }
}
