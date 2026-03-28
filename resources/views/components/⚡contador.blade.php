<?php

use Livewire\Component;

new class extends Component
{
    public int $count = 0;
    private int $max = 10;

    public function incrementar(){
        if ($this->count < $this->max)
            $this->count++;
    }
};
?>

<div>
    <h1>Contador: {{ $this->count}}</h1>
    <button wire:click="incrementar" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200">Incrementar</button>
    <p>Max: {{ $this->max}}</p> {{-- podemos acceder a la variable privada a través de $this-> --}}
</div>