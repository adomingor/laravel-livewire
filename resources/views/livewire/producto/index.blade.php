<div class="py-12">
    <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-zinc-900 shadow sm:rounded-lg">
            <div class="w-full">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <flux:heading size="lg">{{ __('Productos') }}</flux:heading>
                        <flux:text class="mt-2">{{ __('List of') }} {{ __('productos') }}</flux:text>
                    </div>
                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                        <flux:button href="{{ route('productos.create') }}" wire:navigate variant="primary">
                            {{ __('Add') }}
                        </flux:button>
                    </div>
                </div>

                <div class="mt-8 overflow-x-auto">
                    <div class="flex items-center justify-between py-2">
                        {{-- 🔍 BUSCADOR --}}
                        <div class="w-6/12">
                            <flux:input wire:model.live.enter="search"
                                placeholder="Buscar por producto o descripción (enter para buscar 🙊)" />
                        </div>
                        {{-- 📄 REGISTROS POR PÁGINA --}}
                        <x-per-page-selector wire:model.live="perPage" :options="$perPageOptions" />
                    </div>
                    <table class="w-full divide-y divide-zinc-300 dark:divide-zinc-700">
                        <thead>
                            <tr>
                                <th scope="col"
                                    class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-zinc-500 dark:text-zinc-400">
                                    No</th>
                                <th scope="col"
                                    class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-zinc-500 dark:text-zinc-400">
                                    {{ __('Producto') }}
                                </th>
                                <th scope="col"
                                    class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-zinc-500 dark:text-zinc-400">
                                    {{ __('Descripción') }}
                                </th>
                                <th scope="col"
                                    class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-zinc-500 dark:text-zinc-400">
                                    {{ __('Activo') }}
                                </th>
                                <th scope="col"
                                    class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-zinc-500 dark:text-zinc-400">
                                    {{ __('Usuario') }}
                                </th>
                                <th scope="col"
                                    class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-zinc-500 dark:text-zinc-400">
                                    {{ __('Fecha Ins') }}
                                </th>
                                <th scope="col"
                                    class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-zinc-500 dark:text-zinc-400">
                                    {{ __('Fecha Upd') }}
                                </th>
                                <th scope="col" class="px-3 py-3"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                            @foreach ($productos as $producto)
                                <tr class="even:bg-zinc-50 dark:even:bg-zinc-800" wire:key="{{ $producto->id }}">
                                    <td
                                        class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-semibold text-zinc-900 dark:text-zinc-100">
                                        {{ ++$i }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-zinc-600 dark:text-zinc-400">
                                        {{ $producto->producto }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-zinc-600 dark:text-zinc-400">
                                        {{ $producto->descripcion }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm">
                                        <flux:badge :color="$producto->activo ? 'green' : 'zinc'" size="sm">
                                            {{ $producto->activo ? __('Sí') : __('No') }}
                                        </flux:badge>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-zinc-600 dark:text-zinc-400">
                                        {{ $producto->id_users }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-zinc-600 dark:text-zinc-400">
                                        {{ $producto->fecha_ins }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-zinc-600 dark:text-zinc-400">
                                        {{ $producto->fecha_upd }}
                                    </td>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium">
                                        <div class="flex items-center gap-2">
                                            <flux:button href="{{ route('productos.show', $producto->id) }}" wire:navigate
                                                size="sm" variant="ghost">{{ __('Ver') }}</flux:button>
                                            <flux:button href="{{ route('productos.edit', $producto->id) }}" wire:navigate
                                                size="sm" variant="ghost">{{ __('Editar') }}</flux:button>
                                            <flux:button size="sm" variant="danger" wire:click="delete({{ $producto->id }})"
                                                wire:confirm="¿Estás seguro de que quieres eliminar este producto?">
                                                {{ __('Eliminar') }}
                                            </flux:button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4 px-4">
                        {!! $productos->withQueryString()->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>