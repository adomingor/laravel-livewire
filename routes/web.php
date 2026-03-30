<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    // Definimos los datos para pasarle a la vista
    $datos = ['web_nombre' => 'Juan', 'web_edad' => '25'];
    Route::view('dashboard', 'dashboard', $datos)->name('dashboard');

    Route::prefix('posts')->name('posts.')->group(function () {
        Route::livewire('/', 'posts.index')->name('index');
        Route::livewire('/create', 'posts.create')->name('create');
        Route::livewire('/{post}', 'posts.show')->name('show');
        Route::livewire('/{post}/edit', 'posts.edit')->name('edit');
    });

    Route::livewire('/productos', 'producto.index')->name('producto.index');
});

require __DIR__.'/settings.php';
