<?php

use Livewire\Component;

new class extends Component
{
    public $title = '';
    public $content = '';
    public $category = 0;


    public function createPost()
    {
        // Aquí puedes agregar la lógica para guardar el post en la base de datos
        // Por ejemplo:
        // Post::create(['title' => $this->title, 'content' => $this->content]);

        // Para este ejemplo, simplemente mostraremos un mensaje de éxito
        session()->flash('message', 'Post creado exitosamente!');
    }
};
?>

<div class="max-w-lg mx-auto mt-10 p-6 bg-white rounded-2xl shadow-md">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Crear nuevo post</h1>
    <form wire:submit.prevent="createPost" class="space-y-4">
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                {{-- hasta q no se hace el submit no actualiza --}}
            {{-- <input type="text" id="title" wire:model="title" placeholder="Título del post"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"/> --}}
                {{-- actualiza en vivo, mientras el usuario escribe, envía muchas solicitudes al servidor, lo que puede ser ineficiente --}}
            {{-- <input type="text" id="title" wire:model.live="title" placeholder="Título del post"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"/> --}}
                {{-- actualiza en vivo pero con un retraso de 300ms después de que el usuario deja de escribir, lo que reduce la cantidad de solicitudes al servidor --}}
            {{-- <input type="text" id="title" wire:model.live.debounce.300ms="title" placeholder="Título del post"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"/> --}}
            {{-- actualiza solo cuando el campo pierde el foco, lo que es eficiente para campos de texto largos o cuando no es necesario actualizar en tiempo real --}}
            <input type="text" id="title" wire:model.live.blur="title" placeholder="Título del post"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"/>
        </div>
        <div>
            <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Contenido</label>
            <textarea id="content" wire:model="content" rows="4" placeholder="Contenido del post"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"></textarea>
        </div>
        <div>
            <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Categoría</label>
            <select id="category" wire:model.live.change="category" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="0">Seleccionar categoría</option>
                <option value="1">Tecnología</option>
                <option value="2">Ciencia</option>
                <option value="3">Cultura</option>
            </select>
        </div>
        <button type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200">
            Create Post
        </button>
    </form>
    <h5>Post creado: {{ $title }}</h5>
    <p>{{ $content }}</p>
    <p>Categoría: {{ $category }}</p>
    {{-- Simplicity is the consequence of refined emotions. - Jean D'Alembert --}}
</div>