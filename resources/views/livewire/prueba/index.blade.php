<div class="py-12">
    <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-zinc-900 shadow sm:rounded-lg">
            <div class="w-full">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <flux:heading size="lg">{{ __('Pruebas') }}</flux:heading>
                        <flux:text class="mt-2">{{ __('Listado de todos los Pruebas.') }}</flux:text>
                    </div>
                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                        <flux:button href="{{ route('pruebas.create') }}" wire:navigate variant="primary">
                            {{ __('Agregar') }}
                        </flux:button>
                    </div>
                </div>

                <div class="mt-8 overflow-x-auto">
                    <table class="w-full divide-y divide-zinc-300 dark:divide-zinc-700">
                        <thead>
                            <tr>
                                <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-zinc-500 dark:text-zinc-400">No</th>
                                
									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Apellido</th>
									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Nombre</th>
									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Edad</th>

                                <th scope="col" class="px-3 py-3"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                            @foreach ($pruebas as $prueba)
                                <tr class="even:bg-zinc-50 dark:even:bg-zinc-800" wire:key="{{ $prueba->id }}">
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-semibold text-zinc-900 dark:text-zinc-100">{{ ++$i }}</td>
                                    
										<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $prueba->apellido }}</td>
										<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $prueba->nombre }}</td>
										<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $prueba->edad }}</td>

                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium">
                                        <div class="flex items-center gap-2">
                                            <flux:button href="{{ route('pruebas.show', $prueba->id) }}" wire:navigate size="sm" variant="ghost">{{ __('Ver') }}</flux:button>
                                            <flux:button href="{{ route('pruebas.edit', $prueba->id) }}" wire:navigate size="sm" variant="ghost">{{ __('Editar') }}</flux:button>
                                            <flux:button
                                                size="sm"
                                                variant="danger"
                                                wire:click="delete({{ $prueba->id }})"
                                                wire:confirm="¿Estás seguro de que quieres eliminar este registro?"
                                            >{{ __('Eliminar') }}</flux:button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4 px-4">
                        {!! $pruebas->withQueryString()->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
