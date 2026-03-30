<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
 *
 * @property User $user
 * @property ProdCat[] $prodCats
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Producto extends Model
{
    
    public $timestamps = false; // Desactiva la gestión automática de timestamps
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['producto', 'descripcion', 'activo', 'id_users', 'fecha_ins', 'fecha_upd'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'id_users', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prodCats()
    {
        return $this->hasMany(\App\Models\ProdCat::class, 'id', 'id_productos');
    }
    
}
