<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Proyecto extends Model
{
    use HasFactory;
    protected $primaryKey = 'codigopr';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = [];
    protected $casts = [
         'fecha_inicio'     => 'datetime:d/m/Y',
         'fecha_fin'        => 'datetime:d/m/Y',
         'fecha_entrega'    => 'datetime:d/m/Y',
         'cerrado'          => 'datetime:d/m/Y',
     ];

    protected $table = 'proyectos';    

    public function contratoCliente(): BelongsTo
    {
        return $this->belongsTo(ContratoCliente::class);
    }    
}
