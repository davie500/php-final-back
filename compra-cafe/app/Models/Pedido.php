<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';

    protected $fillable = [
        'usuario_id',
        'valor_total',
        'status',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function itens()
    {
        return $this->hasMany(ItemPedido::class, 'pedido_id');
    }

    public function venda()
    {
        return $this->hasOne(Venda::class, 'pedido_id');
    }
}