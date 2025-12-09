<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $table = 'vendas';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'pedido_id',
        'usuario_id',
        'valor_total'
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function getVendaData()
    {
        return $this->all();
    }
}
