<?php

namespace App\Http\Controllers;

use App\Http\Requests\RendaRequest;
use App\Models\Renda;
use App\Models\TipoRenda;

class RendaController extends Controller {

    public function iniciar(RendaRequest $request = null) {
        $request = $request ?: RendaRequest::capture();

        $id = $request->input('id', null);
        $descricao = $request->input('descricao', null);
        $id_tiporenda = $request->input('id_tiporenda', null);
        $valor = $request->input('valor', null);
        $dataInicio = $request->input('datainicio', null);
        $dataTermino = $request->input('datatermino', null);
        $ativo = $request->input('ativo', null);
        
        if ($ativo === 'false') {
            $query = Renda::where('ativo', false)->orderBy('id');
        } else if ($ativo === 'todos') {
            $query = Renda::orderBy('id');
        } else {
            $query = Renda::where('ativo', true)->orderBy('id');
        }

        if($id != null) {
            $query = $query->where('id', $id);
        }

        if($descricao != null) {
            $query = $query->where('descricao', 'ilike', '%' . $descricao . '%');
        }

        if($id_tiporenda != null) {
            $query = $query->where('id_tiporenda', $id_tiporenda);
        }

        if($valor != null) {
            $query = $query->where('valor', $valor);
        }

        if($dataInicio != null && $dataTermino != null) {
            $query = $query->whereBetween('data', [$dataInicio, $dataTermino]);
        }else if ($dataInicio != null) {
            $query = $query->where('data', $dataInicio);
        }else if ($dataTermino != null) {
            $query = $query->where('data', $dataTermino);
        }

        $tipoRendas = TipoRenda::where('ativo', true)->orderBy('descricao')->get();
        $rendas = $query->get();
        return view('renda')->with([
            'tipoRendas' => $tipoRendas,
            'rendas' => $rendas
        ]);
    }

    public function salvar(RendaRequest $request) {
        $renda = Renda::create([
                'id_tiporenda' => $request->input('id_tiporenda'),
                'valor' => $request->input('valor'),
                'data' => $request->input('data'),
                'descricao' => $request->input('descricao'),
        ]);

        return redirect()->route('renda.index')->with('successoSalvar', 'Renda salva com sucesso!');
    }

    public function atualizar(RendaRequest $request, $id){
        $renda = Renda::findOrFail($id);
        $alterado = false;

        if($request->descricao !== $renda->descricao){
            $renda->descricao = $request->descricao;
            $renda->save();
            $alterado = true;
        }

        if((int) $request->id_tiporenda !== (int) $renda->id_tiporenda){
            $renda->id_tiporenda = $request->id_tiporenda;
            $renda->save();
            $alterado = true;
        }

        if((double) $request->valor !== (double) $renda->valor){
            $renda->valor = $request->valor;
            $renda->save();
            $alterado = true;
        }

        if($request->data !== $renda->data){
            $renda->data = $request->data;
            $renda->save();
            $alterado = true;
        }

        if((int) $request->ativo !== (int) $renda->ativo){
            $renda->ativo = $request->ativo;
            $renda->save();
            $alterado = true;
        }

        if($alterado === true) {
            return redirect()->route('renda.index')->with('success', 'Alteração(ões) realizada(s) com Sucesso!');
        }else {
           return redirect()->route('renda.index')->with('error', 'Nada para ser alterado');
        }
    }

}

?>