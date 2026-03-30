<?php

namespace App\Livewire\Forms;

use App\Models\Prueba;
use Livewire\Form;

class PruebaForm extends Form
{
    public ?Prueba $pruebaModel;
    
    public $apellido = '';
    public $nombre = '';
    public $edad = '';

    public function rules(): array
    {
        return [
			'apellido' => 'required|string',
			'nombre' => 'required|string',
			'edad' => 'required',
        ];
    }

    public function setPruebaModel(Prueba $pruebaModel): void
    {
        $this->pruebaModel = $pruebaModel;
        
        $this->apellido = $this->pruebaModel->apellido;
        $this->nombre = $this->pruebaModel->nombre;
        $this->edad = $this->pruebaModel->edad;
    }

    public function store(): void
    {
        $this->pruebaModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->pruebaModel->update($this->validate());

        $this->reset();
    }
}
