<?php

use Livewire\Component;

new class extends Component
{
    public $title = '';
    public $content = '';
};
?>

<div class="max-w-lg mx-auto mt-10 p-6 bg-white rounded-2xl shadow-md">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">HOLA MUNDO MUNDIAL!</h1>
    <form wire:submit.prevent="createPost" class="space-y-4">
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
            <input type="text" id="title" wire:model="title"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>
        <div>
            <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Content</label>
            <textarea id="content" wire:model="content" rows="4"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"></textarea>
        </div>
        <button type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200">
            Create Post
        </button>
    </form>
    <h5>Post creado: {{ $title }}</h5>
    <p>{{ $content }}</p>

    {{-- Simplicity is the consequence of refined emotions. - Jean D'Alembert --}}
</div>