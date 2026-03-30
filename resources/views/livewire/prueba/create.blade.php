<div class="py-12">
    <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-zinc-900 shadow sm:rounded-lg">
            <div class="w-full">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <flux:heading size="lg">{{ __('Crear Prueba') }}</flux:heading>
                        <flux:text class="mt-2">{{ __('Agrega un nuevo Prueba.') }}</flux:text>
                    </div>
                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                        <flux:button href="{{ route('pruebas.index') }}" wire:navigate variant="primary">
                            {{ __('Volver') }}
                        </flux:button>
                    </div>
                </div>

                <div class="mt-8 max-w-xl">
                    <form wire:submit="save">
                        @include('livewire.prueba.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
