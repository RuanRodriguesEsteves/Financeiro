<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalvarBancoRequest;
use App\Models\Banco;

class BancoController extends Controller {

    public function iniciar() {
        $bancos = Banco::where('ativo', true)->orderBy('id')->get();
        return view('banco')->with([
            'bancos' => $bancos
        ]);
    }

    public function salvar(SalvarBancoRequest $request) {
        $banco = Banco::create([
            'descricao' => $request->input('descricao')
        ]);
        return $this->iniciar();
    }

}

?>