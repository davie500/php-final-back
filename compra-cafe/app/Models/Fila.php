<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fila extends Model
{
    protected $table = 'filas';
    protected $primaryKey = 'id';

    protected $fillable = [
        'usuario_id',
        'posicao',
        'status',
    ];

    public static function adicionarNaFila($usuarioId)
    {
        // pega maior posição
        $ultimaPos = self::max('posicao');

        if (!$ultimaPos) {
            $ultimaPos = 0;
        }

        return self::create([
            'usuario_id' => $usuarioId,
            'posicao' => $ultimaPos + 1,
            'status' => 'aguardando',
        ]);
    }

    public function usuario() {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
