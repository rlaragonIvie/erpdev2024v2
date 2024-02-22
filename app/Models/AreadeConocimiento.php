<?php

namespace App\Models;

use App\Models\Proyecto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AreadeConocimiento extends Model
{
    use HasFactory;
    protected $table        = 'area_conocimiento';  
    protected $primaryKey   = 'codigo_area';
    protected $guarded = [];

    public function proyectos(): BelongsToMany
    {
        return $this->belongsToMany(Proyecto::class, 'proyecto_area', 'codigo_area', 'codigopr');
    }
}
