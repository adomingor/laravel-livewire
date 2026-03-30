<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $producto
 * @property string|null $descripcion
 * @property bool $activo
 * @property int $id_users
 * @property Carbon $fecha_ins
 * @property Carbon|null $fecha_upd
 *
 * @mixin Builder
 */
class Producto extends Model
{
    public $timestamps = false;

    protected $fillable = ['producto', 'descripcion', 'activo', 'id_users', 'fecha_ins', 'fecha_upd'];

    protected function casts(): array
    {
        return [
            'activo' => 'boolean',
            'fecha_ins' => 'datetime',
            'fecha_upd' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_users');
    }

    public function categorias(): BelongsToMany
    {
        return $this->belongsToMany(Categoria::class, 'prod_cat', 'id_productos', 'id_categorias')
            ->withPivot(['activo', 'id_users', 'fecha_ins', 'fecha_upd']);
    }
}
