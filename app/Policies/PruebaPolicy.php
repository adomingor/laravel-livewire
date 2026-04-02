<?php

namespace App\Policies;

use App\Models\Prueba;
use App\Models\User;

class PruebaPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('ver pruebas');
    }

    public function view(User $user, Prueba $prueba): bool
    {
        return $user->hasPermissionTo('ver pruebas');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('crear pruebas');
    }

    public function update(User $user, Prueba $prueba): bool
    {
        return $user->hasPermissionTo('editar pruebas');
    }

    public function delete(User $user, Prueba $prueba): bool
    {
        return $user->hasPermissionTo('eliminar pruebas');
    }

    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('eliminar pruebas');
    }
}
