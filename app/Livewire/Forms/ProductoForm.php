<?php

namespace App\Livewire\Forms;

use App\Models\Producto;
use Livewire\Form;

class ProductoForm extends Form
{
    public ?Producto $productoModel;

    public $producto = '';

    public $descripcion = '';

    public $activo = true;

    public $id_users = '';

    public $fecha_ins = '';

    public $fecha_upd = '';

    public function rules(): array
    {
        return [
            'producto' => 'required|string',
            'descripcion' => 'string',
            'activo' => 'boolean',
            'id_users' => 'required',
            'fecha_ins' => 'required|date',
            'fecha_upd' => 'required|date',
        ];
    }

    public function setProductoModel(Producto $productoModel): void
    {
        $this->productoModel = $productoModel;

        $this->producto = $this->productoModel->producto;
        $this->descripcion = $this->productoModel->descripcion;
        $this->activo = $this->productoModel->activo ?? true;
        $this->id_users = $this->productoModel->id_users ?? auth()->id();
        $this->fecha_ins = $this->productoModel->fecha_ins ?? now()->toDateString();
        $this->fecha_upd = now()->toDateString();
    }

    public function store(): void
    {
        $this->fecha_upd = now()->toDateString();

        $this->productoModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->fecha_upd = now()->toDateString();

        $this->productoModel->update($this->validate());

        $this->reset();
    }
}
