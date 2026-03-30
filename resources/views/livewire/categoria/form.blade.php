<div class="space-y-6">
    
    <div>
        <x-input-label for="categoria" :value="__('Categoria')"/>
        <x-text-input wire:model="form.categoria" id="categoria" name="categoria" type="text" class="mt-1 block w-full" autocomplete="categoria" placeholder="Categoria"/>
        @error('form.categoria')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="activo" :value="__('Activo')"/>
        <x-text-input wire:model="form.activo" id="activo" name="activo" type="text" class="mt-1 block w-full" autocomplete="activo" placeholder="Activo"/>
        @error('form.activo')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="id_users" :value="__('Id Users')"/>
        <x-text-input wire:model="form.id_users" id="id_users" name="id_users" type="text" class="mt-1 block w-full" autocomplete="id_users" placeholder="Id Users"/>
        @error('form.id_users')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="fecha_ins" :value="__('Fecha Ins')"/>
        <x-text-input wire:model="form.fecha_ins" id="fecha_ins" name="fecha_ins" type="text" class="mt-1 block w-full" autocomplete="fecha_ins" placeholder="Fecha Ins"/>
        @error('form.fecha_ins')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="fecha_upd" :value="__('Fecha Upd')"/>
        <x-text-input wire:model="form.fecha_upd" id="fecha_upd" name="fecha_upd" type="text" class="mt-1 block w-full" autocomplete="fecha_upd" placeholder="Fecha Upd"/>
        @error('form.fecha_upd')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>