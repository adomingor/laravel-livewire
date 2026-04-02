<?php

namespace App\Livewire\Hooks;

use Flux\Flux;
use Illuminate\Auth\Access\AuthorizationException;
use Livewire\ComponentHook;

class AuthorizationExceptionHook extends ComponentHook
{
    public function exception($e, $stopPropagation): void
    {
        \Illuminate\Support\Facades\Log::debug('AuthorizationExceptionHook::exception called', [
            'exception_class' => get_class($e),
            'is_auth' => $e instanceof AuthorizationException,
        ]);

        if (! ($e instanceof AuthorizationException)) {
            return;
        }

        $stopPropagation();

        try {
            Flux::toast(
                text: 'No tenés permiso para realizar esta acción.',
                variant: 'danger',
            );
        } catch (\Throwable) {
            // No hay contexto de Livewire activo (ej: primer render de página)
        }
    }
}
