<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    // Definimos los datos para pasarle a la vista
    $datos = ["web_nombre" => "Juan", "web_edad" => "25"];
    Route::view('dashboard', 'dashboard', $datos)->name('dashboard');
});

require __DIR__.'/settings.php';
