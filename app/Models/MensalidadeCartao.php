<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MensalidadeCartao extends Model {

    public $timestamps = false;

    protected $table = 'mensalidadecartao';

    protected $fillable = [
        'id',
        'descricao',
        'valor',
        'datafechamento',
        'datavencimento',
        'mesreferencia',
        'id_cartao',
        'ativo'
    ];

    public function cartao() {
        return $this->belongsTo(Cartao::class, 'id_cartao');
    }
}

?>