<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipologia extends Model
{
    use HasFactory;
    protected $table        = 'tipologia_proyecto'; 
    protected $primaryKey   = 'cod_tipologia'; 
    protected $guarded = [];

    public function proyecto() : HasMany
    {
        return $this->hasMany(Proyecto::class, 'cod_tipologia', 'tipologia');
    }
}
