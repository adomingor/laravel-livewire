<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Prueba
 *
 * @property $id
 * @property $apellido
 * @property $nombre
 * @property $edad
 * @property $created_at
 * @property $updated_at
 *
 * @mixin Builder
 */
class Prueba extends Model
{
    use HasFactory;

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['apellido', 'nombre', 'edad'];
}
