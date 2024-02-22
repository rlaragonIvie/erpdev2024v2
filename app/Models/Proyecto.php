<?php

namespace App\Models;

use App\Models\AreadeConocimiento;
use App\Models\Concurrencia;
use App\Models\ContratoCliente;
use App\Models\Recurrencia;
use App\Models\Tipologia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
    
    public function concurrencia_(): BelongsTo
    {
        return $this->belongsTo(Concurrencia::class, 'concurrencia', 'concurrencia');
    }      

    public function recurrencia_(): BelongsTo
    {
        return $this->belongsTo(Recurrencia::class, 'recurrencia', 'recurrencia');
    }          
    
    public function tipologia_(): BelongsTo
    {
        return $this->belongsTo(Tipologia::class, 'tipologia', 'cod_tipologia');
    }          
    
    public function areas(): BelongsToMany
    {
        return $this->belongsToMany(AreadeConocimiento::class, 'proyecto_area', 'codigopr','codigo_area');
    }

    public function area_unica($codigopr): int
    {
        $proyecto = Proyecto::where('codigopr',$codigopr)->get()->first()->areas->first();
        return $proyecto->codigo_area;
    }
}
