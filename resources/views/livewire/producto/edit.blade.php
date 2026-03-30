<div class="py-12">
    @if (session('success'))
        <flux:callout variant="success" icon="check-circle" class="mb-4">
            <flux:callout.heading>{{ session('success') }}</flux:callout.heading>
        </flux:callout>
    @endif

    <!-- Muestra un solo mensaje -->
    <flux:toast position="top end" />

    <!-- Muestra todos los mensajes apilados -->
    <!-- <flux:toast.group position="top end" expanded>
        <flux:toast />
    </flux:toast.group> -->

    <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-zinc-900 shadow sm:rounded-lg">
            <div class="w-full">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <flux:heading size="lg">{{ __('Editar Producto') }}</flux:heading>
                        <flux:text class="mt-2">{{ __('Actualiza los datos del producto.') }}</flux:text>
                    </div>
                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                        <flux:button href="{{ route('productos.index') }}" wire:navigate variant="primary">
                            {{ __('Volver') }}
                        </flux:button>
                    </div>
                </div>

                <div class="mt-8 max-w-xl">
                    <form wire:submit="save">
                        @include('livewire.producto.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>