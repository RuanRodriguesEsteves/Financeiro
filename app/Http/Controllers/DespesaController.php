<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalvarDespesaRequest;
use App\Models\Despesa;
use App\Models\MensalidadeCartao;
use App\Models\TipoDespesa;

class DespesaController extends Controller {

    public function iniciar() {
        $tipoDespesas = TipoDespesa::where('ativo', true)->orderBy('descricao')->get();
        $mensalidadeCartoes = MensalidadeCartao::where('ativo', true)->orderBy('descricao')->get();
        $despesas = Despesa::where('ativo', true)->with(['tipoDespesa', 'mensalidadeCartao'])->orderBy('id')->get();
        return view('despesa')->with([
            'despesas' => $despesas,
            'tipoDespesas' => $tipoDespesas,
            'mensalidadeCartoes' => $mensalidadeCartoes
        ]);
    }

    public function salvar(SalvarDespesaRequest $request) {
        $despesa = Despesa::create([
            'descricao' => $request->input('descricao'),
            'id_tipodespesa' => $request->input('id_tipodespesa'),
            'valor' => $request->input('valor'),
            'data' => $request->input('data'),
            'id_mensalidadecartao' => $request->input('id_mensalidadecartao')
        ]);

        return $this->iniciar();
    }

}

?>