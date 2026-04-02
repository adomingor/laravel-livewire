<?php

namespace App\Policies;

use App\Models\Producto;
use App\Models\User;

class ProductoPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('ver productos');
    }

    public function view(User $user, Producto $producto): bool
    {
        return $user->hasPermissionTo('ver productos');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('crear productos');
    }

    public function update(User $user, Producto $producto): bool
    {
        return $user->hasPermissionTo('editar productos');
    }

    public function delete(User $user, Producto $producto): bool
    {
        return $user->hasPermissionTo('eliminar productos');
    }

    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('eliminar productos');
    }
}
