<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaccion;

class Comercio extends Model
{
    use HasFactory;

    protected $table = 'comercios';
    protected $fillable = [
        'nombre_comercio',
        'rubro',
        'fecha_afiliacion',
        'telefono',
        'correo_contacto'
    ];

    public function transacciones() 
   { 
      return $this->hasMany(Transaccion::class, 'comercio_id');
   } 
}

