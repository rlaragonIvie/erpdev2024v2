<?php

namespace App\Models;

use App\Models\Concurrencia;
use App\Models\ContratoCliente;
use App\Models\Recurrencia;
use App\Models\Tipologia;
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
         'fecha_alta'       => 'datetime:d/m/Y',
         'fecha_baja'       => 'datetime:d/m/Y',
         'fecha_inicio'     => 'datetime:d/m/Y',
         'fecha_fin'        => 'datetime:d/m/Y',
         'fecha_entrega'    => 'datetime:d/m/Y',
         'cerrado'          => 'datetime:d/m/Y',
     ];

    protected $table = 'proyectos';    

    public function contratoCliente(): BelongsTo
    {
        return $this->belongsTo(ContratoCliente::class, 'codigo_contrato');
    }   
    
    public function concurrencia(): BelongsTo
    {
        return $this->belongsTo(Concurrencia::class);
    }      

    public function recurrencia(): BelongsTo
    {
        return $this->belongsTo(Recurrencia::class);
    }          
    
    public function tipologia(): BelongsTo
    {
        return $this->belongsTo(Tipologia::class, 'cod_tipologia', 'tipologia');
    }          
}
