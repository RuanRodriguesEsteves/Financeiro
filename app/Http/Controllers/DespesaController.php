<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalvarDespesaRequest;
use App\Models\Despesa;
use App\Models\MensalidadeCartao;
use App\Models\TipoDespesa;

class DespesaController extends Controller {

    public function iniciar(SalvarDespesaRequest $request = null) {
        $request = $request ?: SalvarDespesaRequest::capture();

        $id = $request->input('id', null);
        $descricao = $request->input('descricao', null);
        $id_tipodespesa = $request->input('id_tipodespesa', null);
        $id_mensalidadecartao = $request->input('id_mensalidadecartao', null);
        $valor = $request->input('valor', null);
        $data = $request->input('data', null);
        $ativo = $request->input('ativo', null);

        if($ativo === 'false') {
            $query = Despesa::where('ativo', false)->orderBy('id');
        }else if($ativo === 'true') {
            $query = Despesa::where('ativo', true)->orderBy('id');
        }else{
            $query = Despesa::orderBy('id');
            //dd($ativo);
        }

        if($id != null) {
            $query = $query->where('id', $id);
        }

        if($descricao != null) {
            $query = $query->where('descricao', $descricao);
        }
        
        if($id_tipodespesa != null) {
            $query = $query->where('id_tipodespesa', $id_tipodespesa);
        }

        if($id_mensalidadecartao != null) {
            if($id_mensalidadecartao === 'null') {
                $query = $query->where('id_mensalidadecartao', null);
            }else {
                $query = $query->where('id_mensalidadecartao', $id_mensalidadecartao);
            }
        }

        if($valor != null) {
            $query = $query->where('valor', $valor);
        }

        if($data != null) {
            $query = $query->where('data', $data);
        }

        $tipoDespesas = TipoDespesa::where('ativo', true)->orderBy('descricao')->get();
        $mensalidadeCartoes = MensalidadeCartao::where('ativo', true)->orderBy('descricao')->get();

        $despesas = $query->get();
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

    public function atualizar(SalvarDespesaRequest $request, $id) {
        $despesa = Despesa::findOrFail($id);
        $alterado = false;

        if($request->descricao !== $despesa->descricao){
            $despesa->descricao = $request->descricao;
            $despesa->save();
            $alterado = true;
        }

        if((int) $request->id_tipodespesa !== (int) $despesa->id_tipodespesa){
            $despesa->id_tipodespesa = $request->id_tipodespesa;
            $despesa->save();
            $alterado = true;
        }
        
        if($request->data !== $despesa->data){
            $despesa->data = $request->data;
            $despesa->save();
            $alterado = true;
            
        }

        if((int) $request->id_mensalidadecartao !== (int) $despesa->id_mensalidadecartao){
            if($request->id_mensalidadecartao == '') {
                $despesa->id_mensalidadecartao = null;
                $despesa->save();
            }else{
                $despesa->id_mensalidadecartao = $request->id_mensalidadecartao;
                $despesa->save();
            }            
            $alterado = true;
        }

        if((double) $request->valor !== (double) $despesa->valor){
            $despesa->valor = $request->valor;
            $despesa->save();
            $alterado = true;
        }

        if((int) $request->ativo !== (int) $despesa->ativo){
            $despesa->ativo = $request->ativo;
            $despesa->save();
            $alterado = true;
        }

        if($alterado === true) {
            return redirect()->route('despesa.index')->with('success', 'Alteração(ões) realizada(s) com Sucesso!');
        }else {
            return redirect()->route('despesa.index')->with('error', 'Nada para ser alterado');
        }
    }

}

?>