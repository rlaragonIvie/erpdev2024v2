<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concurrencia extends Model
{
    use HasFactory;
    protected $table        = 'tipo_concurrencia';  
    protected $primaryKey   = 'concurrencia';
    protected $guarded = [];

    public function proyecto() : HasMany
    {
        return $this->hasMany(Proyecto::class);
    }
}
