<?php

namespace App\Policies;

use App\Models\Categoria;
use App\Models\User;

class CategoriaPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('ver categorias');
    }

    public function view(User $user, Categoria $categoria): bool
    {
        return $user->hasPermissionTo('ver categorias');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('crear categorias');
    }

    public function update(User $user, Categoria $categoria): bool
    {
        return $user->hasPermissionTo('editar categorias');
    }

    public function delete(User $user, Categoria $categoria): bool
    {
        return $user->hasPermissionTo('eliminar categorias');
    }

    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('eliminar categorias');
    }
}
