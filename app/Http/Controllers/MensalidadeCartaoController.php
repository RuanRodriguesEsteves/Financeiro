<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalvarMensalidadeCartaoRequest;
use App\Models\Cartao;
use App\Models\MensalidadeCartao;

class MensalidadeCartaoController extends Controller {

    public function iniciar() {
        $cartoes = Cartao::where('ativo', true)->orderBy('descricao')->get();
        $mensalidadecartoes = MensalidadeCartao::where('ativo', true)->with('cartao')->orderBy('id')->get();

        return view('mensalidadecartao')->with([
            'cartoes' => $cartoes,
            'mensalidadecartoes' => $mensalidadecartoes
        ]);
    }

    public function salvar(SalvarMensalidadeCartaoRequest $request) {

        $mensalidadeCartoes = MensalidadeCartao::create([
            'descricao' => $request->input('descricao'),
            'valor' => $request->input('valor'),
            'datafechamento' => $request->input('datafechamento'),
            'datavencimento' => $request->input('datavencimento'),
            'mesreferencia' => $request->input('mesreferencia') . '-01',
            'id_cartao' => $request->input('id_cartao')
        ]);

        return redirect('/');

    }

}

?>