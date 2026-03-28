<x-layouts::app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <!-- <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
        </div> -->
        
        <livewire:create-post />

        <h1>Parte del contador</h1>
        <p></p>
        <livewire:contador />

        <h1>Paso de parámetros</h1>
        Estáticos al componente
        <livewire:nombre_x_parametro param_nombre="Dom!" param_edad="49" />

        Dinámicos al componente
        <p>Desde web.php Hola {{ $web_nombre }}! Tienes {{ $web_edad }} años.</p>
        {{-- Para pasar los parámetros al componente, se pone : antes del nombre del parámetro, y se le asigna el valor con comillas dobles, y dentro de las comillas dobles se pone el nombre de la variable que se quiere pasar, con el signo $ antes del nombre de la variable. Ejemplo: :param_nombre="$web_nombre" :param_edad="$web_edad" --}}
        <livewire:nombre_x_parametro :param_nombre="$web_nombre" :param_edad="$web_edad" />

    </div>
</x-layouts::app>