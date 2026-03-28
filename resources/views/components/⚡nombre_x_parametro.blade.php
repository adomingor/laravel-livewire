<?php

use Livewire\Component;

new class extends Component
{
    public string $nombre = '';
    public string $edad = '';

    public function mount($param_nombre, $param_edad){
        // dd($param_nombre);
        $this->nombre = $param_nombre;
        $this->edad = $param_edad;
        $this->param_nombre = $param_nombre;
        $this->param_edad = $param_edad;
    }
};
?>

<div>
    En el componente
    <p>Hola {{ $this->nombre }} Tienes {{ $this->edad }} años.</p>
    <p>Hola {{ $nombre }}! Tienes {{ $edad }} años.</p>
    <p>Hola {{ $this->param_nombre }}! Tienes {{ $this->param_edad }} años.</p>
</div>