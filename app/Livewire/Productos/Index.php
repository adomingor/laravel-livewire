<?php

namespace App\Livewire\Productos;

use App\Models\Producto;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $search = '';

    public function render(): View
    {
        // $productos = Producto::paginate(); muestra todos los registros paginados
        // $productos = Producto::where('activo', 1)->orderBy('producto', 'asc')->paginate(); // solo los activos ordenados por producto

        // return view('livewire.producto.index', compact('productos'))
        //     ->with('i', $this->getPage() * $productos->perPage());

        $productos = Producto::query()
            ->when($this->search, function ($query) {
                $query->where('producto', 'ilike', '%' . $this->search . '%')
                    ->orWhere('descripcion', 'ilike', '%' . $this->search . '%');
            })
            ->orderByDesc('producto', 'descripcion', 'asc')
            ->paginate();

        return view('livewire.producto.index', [
            'productos' => $productos,
            'i' => ($productos->currentPage() - 1) * $productos->perPage()
        ]);
    }

    public function delete(Producto $producto)
    {
        $producto->delete();

        return $this->redirectRoute('productos.index', navigate: true);
    }
}
