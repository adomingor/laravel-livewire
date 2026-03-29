<div class="space-y-6">

    <flux:field>
        <flux:label for="post">{{ __('Post') }}</flux:label>
        <flux:input wire:model="form.post" id="post" name="post" type="text" autocomplete="post" placeholder="Post" />
        <flux:error name="form.post" />
    </flux:field>

    <flux:field>
        <flux:label for="contenido">{{ __('Contenido') }}</flux:label>
        <flux:textarea wire:model="form.contenido" id="contenido" name="contenido" placeholder="Contenido" />
        <flux:error name="form.contenido" />
    </flux:field>

    <div class="flex items-center gap-4">
        <flux:button type="submit" variant="primary">Submit</flux:button>
    </div>

</div>