<div x-data="{ open:false, id:null, nombre:'' }" class="p-4 max-w-4xl mx-auto">

    <!-- HEADER -->
    <div class="flex justify-between mb-4">
        <h1 class="text-xl font-bold">
            <span x-text="$wire.mostrarPapelera ? '🗑️ Papelera' : '📦 Productos'"></span>
        </h1>

        <button wire:click="togglePapelera"
            class="text-sm text-blue-600 hover:underline">
            <span x-text="$wire.mostrarPapelera ? '← Volver' : 'Ver papelera'"></span>
        </button>
    </div>

    <!-- LISTADO -->
    @forelse($productos as $producto)
        <div class="flex justify-between items-center border p-3 mb-2 rounded shadow">

            <span>{{ $producto->producto }}</span>

            <div class="flex gap-2">

                @if(!$mostrarPapelera)
                    <!-- Enviar a papelera -->
                    <button wire:click="eliminar({{ $producto->id }})"
                        class="text-orange-600 text-sm">
                        Eliminar
                    </button>
                @else
                    <!-- Restaurar -->
                    <button wire:click="restaurar({{ $producto->id }})"
                        class="text-green-600 text-sm">
                        Restaurar
                    </button>

                    <!-- Eliminar definitivo -->
                    <button 
                        @click="open=true; id={{ $producto->id }}; nombre=@js($producto->producto)"
                        class="text-red-600 text-sm">
                        Eliminar definitivo
                    </button>
                @endif

            </div>
        </div>
    @empty
        <div class="text-gray-500 text-sm">
            Sin registros
        </div>
    @endforelse

    <!-- MODAL -->
    <div x-show="open"
         x-transition
         class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">

        <div class="bg-white p-5 rounded shadow w-80">

            <h2 class="font-bold mb-2">⚠️ Confirmar</h2>

            <p class="text-sm mb-4">
                ¿Eliminar definitivamente 
                <b x-text="nombre"></b>?
            </p>

            <div class="flex justify-end gap-2">
                <button @click="open=false"
                    class="text-gray-500">
                    Cancelar
                </button>

                <button 
                    @click="$wire.eliminarDefinitivo(id); open=false"
                    class="bg-red-600 text-white px-3 py-1 rounded">
                    Eliminar
                </button>
            </div>
        </div>
    </div>

</div>