<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cartao extends Model {

    public $timestamps = false;

    protected $table = 'cartao';

    protected $fillable = [
        'id',
        'descricao',
        'ativo',
        'id_banco'
    ];

    public function banco() {
        return $this->belongsTo(Banco::class, 'id_banco');
    }

}

?>