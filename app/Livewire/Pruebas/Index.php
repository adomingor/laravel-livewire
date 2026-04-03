<?php

namespace App\Livewire\Pruebas;

use App\Models\Prueba;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function render(): View
    {
        $pruebas = Prueba::paginate();

        return view('livewire.prueba.index', compact('pruebas'))
            ->with('i', $this->getPage() * $pruebas->perPage());
    }

    public function delete(Prueba $prueba)
    {
        $this->authorize('delete', $prueba);

        $prueba->delete();

        return $this->redirectRoute('pruebas.index', navigate: true);
    }
}
