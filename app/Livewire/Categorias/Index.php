<?php

namespace App\Livewire\Categorias;

use App\Models\Categoria;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function render(): View
    {
        $categorias = Categoria::paginate();

        return view('livewire.categoria.index', compact('categorias'))
            ->with('i', $this->getPage() * $categorias->perPage());
    }

    public function delete(Categoria $categoria)
    {
        $categoria->delete();

        return $this->redirectRoute('categorias.index', navigate: true);
    }
}
