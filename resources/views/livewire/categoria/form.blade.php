<div class="space-y-6">
    

    <flux:field>
        <flux:label>{{ __('Categoria') }}</flux:label>
        <flux:input wire:model="form.categoria" id="categoria" name="categoria" type="text" placeholder="Categoria" />
        <flux:error name="form.categoria" />
    </flux:field>

    <flux:field>
        <flux:label>{{ __('Activo') }}</flux:label>
        <flux:input wire:model="form.activo" id="activo" name="activo" type="text" placeholder="Activo" />
        <flux:error name="form.activo" />
    </flux:field>

    <flux:field>
        <flux:label>{{ __('Id Users') }}</flux:label>
        <flux:input wire:model="form.id_users" id="id_users" name="id_users" type="text" placeholder="Id Users" />
        <flux:error name="form.id_users" />
    </flux:field>

    <flux:field>
        <flux:label>{{ __('Fecha Ins') }}</flux:label>
        <flux:input wire:model="form.fecha_ins" id="fecha_ins" name="fecha_ins" type="text" placeholder="Fecha Ins" />
        <flux:error name="form.fecha_ins" />
    </flux:field>

    <flux:field>
        <flux:label>{{ __('Fecha Upd') }}</flux:label>
        <flux:input wire:model="form.fecha_upd" id="fecha_upd" name="fecha_upd" type="text" placeholder="Fecha Upd" />
        <flux:error name="form.fecha_upd" />
    </flux:field>

    <div class="flex items-center gap-4">
        <flux:button variant="primary" type="submit">{{ __('Save') }}</flux:button>
    </div>
</div>
