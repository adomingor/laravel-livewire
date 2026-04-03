<div class="py-12">
    <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-zinc-900 shadow sm:rounded-lg">
            <div class="w-full">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <flux:heading size="lg">{{ __('Prueba') }}</flux:heading>
                        <flux:text class="mt-2">{{ __('Showing data Prueba.') }}</flux:text>
                    </div>
                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                        <flux:button href="{{ route('pruebas.index') }}" wire:navigate variant="primary">
                            {{ __('Volver') }}
                        </flux:button>
                    </div>
                </div>

                <div class="mt-6 border-t border-zinc-200 dark:border-zinc-700">
                    <dl class="divide-y divide-zinc-200 dark:divide-zinc-700">
                        
                                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                        <dt class="text-sm font-medium leading-6 text-gray-900">Apellido</dt>
                                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $prueba->apellido }}</dd>
                                    </div>
                                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                        <dt class="text-sm font-medium leading-6 text-gray-900">Nombre</dt>
                                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $prueba->nombre }}</dd>
                                    </div>
                                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                        <dt class="text-sm font-medium leading-6 text-gray-900">Edad</dt>
                                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $prueba->edad }}</dd>
                                    </div>

                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
