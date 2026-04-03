<?php

namespace App\Livewire\Forms;

use App\Models\Categoria;
use Livewire\Form;

class CategoriaForm extends Form
{
    public ?Categoria $categoriaModel;

    public $categoria = '';

    public $activo = '';

    public $id_users = '';

    public $fecha_ins = '';

    public $fecha_upd = '';

    public function rules(): array
    {
        return [
            'categoria' => 'required|string',
            'activo' => 'required|boolean',
            'id_users' => 'required',
            'fecha_ins' => 'required',
        ];
    }

    public function setCategoriaModel(Categoria $categoriaModel): void
    {
        $this->categoriaModel = $categoriaModel;

        $this->categoria = $this->categoriaModel->categoria;
        $this->activo = $this->categoriaModel->activo;
        $this->id_users = $this->categoriaModel->id_users;
        $this->fecha_ins = $this->categoriaModel->fecha_ins;
        $this->fecha_upd = $this->categoriaModel->fecha_upd;
    }

    public function store(): void
    {
        $this->categoriaModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->categoriaModel->update($this->validate());

        $this->reset();
    }
}
