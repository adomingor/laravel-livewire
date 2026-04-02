<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    // Definimos los datos para pasarle a la vista
    $datos = ['web_nombre' => 'Juan', 'web_edad' => '25'];
    Route::view('dashboard', 'dashboard', $datos)->name('dashboard');

    // Route::prefix('posts')->name('posts.')->group(function () {
    //     Route::livewire('/', 'posts.index')->name('index');
    //     Route::livewire('/create', 'posts.create')->name('create');
    //     Route::livewire('/{post}', 'posts.show')->name('show');
    //     Route::livewire('/{post}/edit', 'posts.edit')->name('edit');
    // });

    Route::prefix('productos')->name('productos.')->group(function () {
        Route::livewire('/', 'productos.index')->name('index');
        Route::livewire('/create', 'productos.create')->name('create');
        Route::livewire('/{producto}', 'productos.show')->name('show');
        Route::livewire('/{producto}/edit', 'productos.edit')->name('edit');
    });

    Route::prefix('pruebas')->name('pruebas.')->group(function () {
        Route::livewire('/', 'pruebas.index')->name('index');
        Route::livewire('/create', 'pruebas.create')->name('create');
        Route::livewire('/{prueba}', 'pruebas.show')->name('show');
        Route::livewire('/{prueba}/edit', 'pruebas.edit')->name('edit');
    });

    Route::prefix('categorias')->name('categorias.')->group(function () {
        Route::livewire('/', 'categorias.index')->name('index');
        Route::livewire('/create', 'categorias.create')->name('create');
        Route::livewire('/{categoria}', 'categorias.show')->name('show');
        Route::livewire('/{categoria}/edit', 'categorias.edit')->name('edit');
    });

});

require __DIR__.'/settings.php';
