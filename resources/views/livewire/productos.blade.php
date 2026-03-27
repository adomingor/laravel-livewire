<div x-data="{ open:false, id:null, nombre:'' }" class="max-w-5xl mx-auto p-4">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-bold">
            {{ $mostrarPapelera ? '🗑️ Papelera' : '📦 Productos' }}
        </h1>

        <button wire:click="togglePapelera"
            class="text-sm text-blue-600 hover:underline">
            {{ $mostrarPapelera ? '← Volver' : 'Ver papelera' }}
        </button>
    </div>

    <!-- 🔍 BUSCADOR -->
    <input type="text"
        wire:model.live="search"
        placeholder="Buscar producto..."
        class="w-full mb-4 border rounded p-2 text-sm">

    <!-- ➕ FORM ALTA -->
    @if(!$mostrarPapelera)
        <form wire:submit.prevent="crear" class="flex gap-2 mb-4">
            <input type="text"
                wire:model="nuevoProducto"
                placeholder="Nuevo producto..."
                class="border rounded p-2 text-sm w-full">

            <button class="bg-green-600 text-white px-4 rounded">
                Agregar
            </button>
        </form>

        @error('nuevoProducto')
            <span class="text-red-600 text-xs">{{ $message }}</span>
        @enderror
    @endif

    <!-- LISTADO -->
    @forelse($productos as $producto)
        <div class="flex justify-between items-center border p-3 mb-2 rounded shadow">

            <span>{{ $producto->producto }}</span>

            <div class="flex gap-2">

                @if(!$mostrarPapelera)
                    <button wire:click="eliminar({{ $producto->id }})"
                        class="text-orange-600 text-sm">
                        Eliminar
                    </button>
                @else
                    <button wire:click="restaurar({{ $producto->id }})"
                        class="text-green-600 text-sm">
                        Restaurar
                    </button>

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
            Sin resultados
        </div>
    @endforelse

    <!-- 📄 PAGINACIÓN -->
    <div class="mt-4">
        {{ $productos->links() }}
    </div>

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
                <button @click="open=false" class="text-gray-500">
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