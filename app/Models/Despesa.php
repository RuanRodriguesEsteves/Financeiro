<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Despesa extends Model {

    public $timestamps = false;

    protected $table = 'despesa';

    protected $fillable = [
        'id',
        'id_tipodespesa',
        'valor',
        'data',
        'id_mensalidadecartao',
        'descricao',
        'ativo'
    ];

    public function tipoDespesa() {
        return $this->belongsTo(TipoDespesa::class, 'id_tipodespesa');
    }

    public function mensalidadeCartao() {
        return $this->belongsTo(MensalidadeCartao::class, 'id_mensalidadecartao');
    }

}

?>