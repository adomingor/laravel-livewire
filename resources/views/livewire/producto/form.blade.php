<div class="space-y-6">

    <flux:field>
        <flux:label for="producto">{{ __('Producto') }}</flux:label>
        <flux:input wire:model="form.producto" id="producto" name="producto" type="text" placeholder="Nombre del producto" />
        <flux:error name="form.producto" />
    </flux:field>

    <flux:field>
        <flux:label for="descripcion">{{ __('Descripción') }}</flux:label>
        <flux:textarea wire:model="form.descripcion" id="descripcion" name="descripcion" placeholder="Descripción del producto" rows="3" />
        <flux:error name="form.descripcion" />
    </flux:field>

    <flux:field variant="inline">
        <flux:label>{{ __('Activo') }}</flux:label>
        <flux:switch wire:model="form.activo" />
        <flux:error name="form.activo" />
    </flux:field>

    <flux:field>
        <flux:label for="id_users">{{ __('Usuario') }}</flux:label>
        <flux:input wire:model="form.id_users" id="id_users" name="id_users" type="number" placeholder="ID del usuario" />
        <flux:error name="form.id_users" />
    </flux:field>

    <flux:field>
        <flux:label for="fecha_ins">{{ __('Fecha de alta') }}</flux:label>
        <flux:input wire:model="form.fecha_ins" id="fecha_ins" name="fecha_ins" type="date" />
        <flux:error name="form.fecha_ins" />
    </flux:field>

    <flux:field>
        <flux:label for="fecha_upd">{{ __('Fecha de actualización') }}</flux:label>
        <flux:input wire:model="form.fecha_upd" id="fecha_upd" name="fecha_upd" type="date" />
        <flux:error name="form.fecha_upd" />
    </flux:field>

    <div class="flex items-center gap-4">
        <flux:button type="submit" variant="primary">{{ __('Guardar') }}</flux:button>
    </div>

</div>
