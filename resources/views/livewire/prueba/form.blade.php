<div class="space-y-6">
    

    <flux:field>
        <flux:label>{{ __('Apellido') }}</flux:label>
        <flux:input wire:model="form.apellido" id="apellido" name="apellido" type="text" placeholder="Apellido" />
        <flux:error name="form.apellido" />
    </flux:field>

    <flux:field>
        <flux:label>{{ __('Nombre') }}</flux:label>
        <flux:input wire:model="form.nombre" id="nombre" name="nombre" type="text" placeholder="Nombre" />
        <flux:error name="form.nombre" />
    </flux:field>

    <flux:field>
        <flux:label>{{ __('Edad') }}</flux:label>
        <flux:input wire:model="form.edad" id="edad" name="edad" type="text" placeholder="Edad" />
        <flux:error name="form.edad" />
    </flux:field>

    <div class="flex items-center gap-4">
        <flux:button variant="primary" type="submit">{{ __('Save') }}</flux:button>
    </div>
</div>
