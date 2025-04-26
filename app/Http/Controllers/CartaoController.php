<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalvarCartaoRequest;
use App\Models\Banco;
use App\Models\Cartao;

class CartaoController extends Controller {

    public function iniciar() {
        $bancos = Banco::where('ativo', true)->orderBy('descricao')->get();
        $cartoes = Cartao::where('ativo', true)->with('banco')->orderBy('id')->get();
        return view('cartao')->with([
            'cartoes' => $cartoes,
            'bancos' => $bancos
        ]);
    }

    public function salvar(SalvarCartaoRequest $request) {
        $cartao = Cartao::create([
            'descricao' => $request->input('descricao'),
            'id_banco' => $request->input('id_banco')
        ]);

        return $this->iniciar();
    }
    
}

?>