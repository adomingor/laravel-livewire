<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Producto
 *
 * @property $id
 * @property $producto
 * @property $descripcion
 * @property $activo
 * @property $id_users
 * @property $fecha_ins
 * @property $fecha_upd
 * @property User $user
 * @property ProdCat[] $prodCats
 *
 * @mixin Builder
 */
class Producto extends Model
{
    use HasFactory;

    public $timestamps = false; // Desactiva la gestión automática de timestamps

    protected $perPage = 4;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['producto', 'descripcion', 'activo', 'id_users', 'fecha_ins', 'fecha_upd'];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_users', 'id');
    }

    /**
     * @return HasMany
     */
    public function prodCats()
    {
        return $this->hasMany(ProdCat::class, 'id', 'id_productos');
    }
}
