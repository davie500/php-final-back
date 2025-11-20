<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $table = 'vendas';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function getVendaData()
    {
        return $this->all();
    }
}
