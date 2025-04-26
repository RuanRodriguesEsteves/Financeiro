<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoDespesa extends Model {

    public $timestamps = false;

    protected $table = 'tipodespesa';

    protected $fillable = [
        'id',
        'descricao',
        'ativo',
    ];

}

?>