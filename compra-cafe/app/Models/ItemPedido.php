<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ItemPedido extends Model
{
    use HasFactory;

    protected $table = 'itens_pedido';
    protected $fillable = [
    'pedido_id',
    'cafe_id',
    'quantidade',
    'preco_unit'
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function cafe()
    {
        return $this->belongsTo(Cafe::class, 'cafe_id');
    }
}
