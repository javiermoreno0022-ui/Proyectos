<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Enums\EstadoTransaccion;

class Transaccion extends Model
{
    use HasFactory;

    protected $table = 'transacciones';

    protected $fillable = [
    'comercio_id',
    'monto',
    'cliente_nombre',
    'estado',
    'metodo',
    'comision',
    ];

    protected $casts = [
    'monto' => 'decimal:2',
    'comision' => 'decimal:2',
    'estado' => EstadoTransaccion::class,
    ];
    /**
     * Una Transacción pertenece a un Comercio.
     */
    public function comercio(): BelongsTo
    {
        return $this->belongsTo(Comercio::class);
    }

    /**
     * Una Transacción tiene muchos Eventos (bitácora/auditoría).
     */
    public function eventos(): HasMany
    {
        return $this->hasMany(EventoTransaccion::class);
    }
}
