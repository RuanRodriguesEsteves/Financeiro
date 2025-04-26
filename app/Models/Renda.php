<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Renda extends Model{

    public $timestamps = false;

    protected $table = 'renda';

    protected $fillable = [
        'id',
        'id_tiporenda',
        'valor',
        'data',
        'descricao',
        'ativo'
    ];

    public function tipoRenda() {
        return $this->belongsTo(TipoRenda::class, 'id_tiporenda');
    }

}

?>