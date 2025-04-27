<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalvarTipoDespesaRequest;
use App\Models\TipoDespesa;

class TipoDespesaController extends Controller {

    public function iniciar(SalvarTipoDespesaRequest $request = null) {
        $request = $request ?: SalvarTipoDespesaRequest::capture();

        $id = $request->input('id', null);
        $descricao = $request->input('descricao', null);
        $ativo = $request->input('ativo', null);

        if($ativo === 'false' ) {
            $query = TipoDespesa::where('ativo', false)->orderBy('id');
        }else if($ativo === 'todos') {
            $query = TipoDespesa::query()->orderBy('id');
        }else {
            $query = TipoDespesa::where('ativo', true)->orderBy('id');
        }

        if($id != null) {
            $query = $query->where('id', $id);
        }

        if($descricao != null) {
            
        }

        $tipoDespesas = $query->get();
        return view('tipodespesa')->with([
            'tipoDespesas' => $tipoDespesas
        ]);
    }

    public function salvar(SalvarTipoDespesaRequest $request) {
        $tipoDespesa = TipoDespesa::create([
            'descricao' => $request->input('descricao')
        ]);
        return redirect('tipodespesa');
    }

    public function atualizar(SalvarTipoDespesaRequest $request, $id) {
        $tipoDespesa = TipoDespesa::findOrFail($id);
        $alterado = false;

        if($request->descricao !== $tipoDespesa->descricao) {
            $tipoDespesa->descricao = $request->descricao;
            $tipoDespesa->save();
            $alterado = true;
        }

        if((int)$request->ativo !== (int)$tipoDespesa->ativo) {
            $tipoDespesa->ativo = $request->ativo;
            $tipoDespesa->save();
            $alterado = true;
        }

        if($alterado === true) {
            return redirect()->route('tipodespesa.index')->with('success', 'Alteração(ões) realizada(s) com Sucesso!');
        }else {
           return redirect()->route('tipodespesa.index')->with('error', 'Nada para ser alterado');
        }
    }
}

?>