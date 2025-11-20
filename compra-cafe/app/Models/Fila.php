<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fila extends Model
{
    protected $table = 'filas';
    protected $primaryKey = 'id';
    // public $timestamps = false;

    public function fila(): HasMany
    {
        return $this->hasMany(Fila::class, 'fila_id', 'id');
    }
}
