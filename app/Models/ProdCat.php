<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $id_productos
 * @property int $id_categorias
 * @property bool $activo
 * @property int $id_users
 * @property Carbon $fecha_ins
 * @property Carbon|null $fecha_upd
 *
 * @mixin Builder
 */
class ProdCat extends Model
{
    public $timestamps = false;

    protected $table = 'prod_cat';

    protected $fillable = ['id_productos', 'id_categorias', 'activo', 'id_users', 'fecha_ins', 'fecha_upd'];

    protected function casts(): array
    {
        return [
            'activo' => 'boolean',
            'fecha_ins' => 'datetime',
            'fecha_upd' => 'datetime',
        ];
    }

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class, 'id_productos');
    }

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'id_categorias');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_users');
    }
}
