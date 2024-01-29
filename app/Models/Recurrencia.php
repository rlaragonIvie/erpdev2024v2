<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recurrencia extends Model
{
    use HasFactory;
    protected $table        = 'tipo_recurrencia';  
    protected $primaryKey   = 'recurrencia';
    protected $guarded = [];

    public function proyecto() : HasMany
    {
        return $this->hasMany(Proyecto::class, 'recurrencia');
    }
}
