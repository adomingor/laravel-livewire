<?php

namespace App\Livewire\Productos;

use App\Models\Producto;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $search = '';

    public int $perPage;

    public function mount(): void
    {
        $this->perPage = (new Producto)->getPerPage();
    }

    public function updatedPerPage(): void
    {
        $this->resetPage();
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function render(): View
    {
        $productos = Producto::query()
            ->where('activo', true)
            ->when($this->search, function ($query) {
                $query->where('producto', 'ilike', '%'.$this->search.'%')
                    ->orWhere('descripcion', 'ilike', '%'.$this->search.'%');
            })
            ->orderBy('producto')
            ->paginate($this->perPage > 0 ? $this->perPage : PHP_INT_MAX);

        return view('livewire.producto.index', [
            'productos' => $productos,
            'i' => ($productos->currentPage() - 1) * $productos->perPage(),
            'perPageOptions' => $this->perPageOptions(),
        ]);
    }

    public function delete(Producto $producto): mixed
    {
        \Illuminate\Support\Facades\Log::debug('IndexProductos::delete called', ['user_id' => auth()->id(), 'producto_id' => $producto->id]);
        $this->authorize('delete', $producto);

        $producto->delete();

        return $this->redirectRoute('productos.index', navigate: true);
    }

    private function perPageOptions(): array
    {
        $options = [5, 15, 30, 50];
        $modelDefault = (new Producto)->getPerPage();

        if (! in_array($modelDefault, $options)) {
            $options[] = $modelDefault;
            sort($options);
        }

        return $options;
    }
}
