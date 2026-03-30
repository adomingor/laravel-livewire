<div class="p-6">

<flux:button wire:click="modal=true">Nuevo</flux:button>

<flux:modal wire:model="modal">

<flux:input wire:model='producto' label='producto' />
<flux:textarea wire:model='descripcion' label='descripcion' />
<flux:switch wire:model='activo' label='activo' />


<flux:select multiple wire:model='catSeleccionadas' label='cat'>
    @foreach($categorias as $cat)
        <option value="{{ $cat->id }}">{{ $cat->categoria }}</option>
    @endforeach
</flux:select>

<flux:button wire:click="save">Guardar</flux:button>

</flux:modal>

</div>