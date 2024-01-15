<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContratoCliente extends Model
{
    use HasFactory;
    protected $primaryKey   = 'codigo_contrato';
    protected $table        = 'contrato_cliente';  
    protected $guarded = [];

    protected $casts = [
        'fecha_inicio'     => 'datetime:d/m/Y',
        'fecha_fin'        => 'datetime:d/m/Y',
        'fecha_entrega'    => 'datetime:d/m/Y',
        'fecha_cerrado'    => 'datetime:d/m/Y',
        'updated_at'       => 'datetime:Y-m-d H:i:s',
        'created_at'       => 'datetime:Y-m-d H:i:s',
    ];

    public function proyecto() : HasMany
    {
        return $this->hasMany(Proyecto::class);
    }
}
