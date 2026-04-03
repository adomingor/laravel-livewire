<div class="py-12">
    <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-zinc-900 shadow sm:rounded-lg">
            <div class="w-full">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <flux:heading size="lg">{{ __('Categorias') }}</flux:heading>
                        <flux:text class="mt-2">{{ __('List of Categorias.') }}</flux:text>
                    </div>
                    @can('create', \App\Models\Categoria::class)
                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                        <flux:button href="{{ route('categorias.create') }}" wire:navigate variant="primary">
                            {{ __('Agregar') }}
                        </flux:button>
                    </div>
                    @endcan
                </div>

                <div class="mt-8 overflow-x-auto">
                    <table class="w-full divide-y divide-zinc-300 dark:divide-zinc-700">
                        <thead>
                            <tr>
                                <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-zinc-500 dark:text-zinc-400">No</th>
                                
									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Categoria</th>
									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Activo</th>
									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Id Users</th>
									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Fecha Ins</th>
									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Fecha Upd</th>

                                <th scope="col" class="px-3 py-3"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                            @foreach ($categorias as $categoria)
                                <tr class="even:bg-zinc-50 dark:even:bg-zinc-800" wire:key="{{ $categoria->id }}">
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-semibold text-zinc-900 dark:text-zinc-100">{{ ++$i }}</td>
                                    
										<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $categoria->categoria }}</td>
										<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $categoria->activo }}</td>
										<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $categoria->id_users }}</td>
										<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $categoria->fecha_ins }}</td>
										<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $categoria->fecha_upd }}</td>

                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium">
                                        <div class="flex items-center gap-2">
                                            @can('view', $categoria)
                                            <flux:button href="{{ route('categorias.show', $categoria->id) }}" wire:navigate size="sm" variant="ghost">{{ __('Ver') }}</flux:button>
                                            @endcan
                                            @can('update', $categoria)
                                            <flux:button href="{{ route('categorias.edit', $categoria->id) }}" wire:navigate size="sm" variant="ghost">{{ __('Editar') }}</flux:button>
                                            @endcan
                                            @can('delete', $categoria)
                                            <flux:button
                                                size="sm"
                                                variant="danger"
                                                wire:click="delete({{ $categoria->id }})"
                                                wire:confirm="¿Estás seguro de que quieres eliminar este registro?"
                                            >{{ __('Eliminar') }}</flux:button>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4 px-4">
                        {!! $categorias->withQueryString()->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
