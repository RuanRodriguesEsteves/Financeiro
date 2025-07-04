<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipoRendaRequest;
use App\Models\TipoRenda;

class TipoRendaController extends Controller {

    public function iniciar(TipoRendaRequest $request = null){
        $request = $request ?: TipoRendaRequest::capture();

        $id = $request->input('id', null);
        $descricao = $request->input('descricao', null);
        $ativo = $request->input('ativo', null);

        if ($ativo === 'false') {
            $query = TipoRenda::where('ativo', false)->orderBy('id');
        } else if ($ativo === 'todos') {
            $query = TipoRenda::query()->orderBy('id');
        } else {
            $query = TipoRenda::where('ativo', true)->orderBy('id');
        }

        if($id != null) {
            $query = $query->where('id', $id);
        }

        if($descricao != null) {
            $query = $query->where('descricao', 'ilike', '%' . $descricao . '%');
        }
        
        $tiporenda = $query->get();
        return view('tiporenda')->with([
            'tiporendas' => $tiporenda
        ]);
    }

    public function salvar(TipoRendaRequest $request) {
        TipoRenda::create([
            'descricao' => $request->input('descricao')
        ]);
        
        return redirect()->route('tiporenda.index')->with('successoSalvar', 'Renda salva com sucesso!');
    }

    public function atualizar(TipoRendaRequest $request, $id) {
        $tiporenda = TipoRenda::findOrFail($id);
        $alterado = false;

        if($request->descricao !== $tiporenda->descricao) {
            $tiporenda->descricao = $request->descricao;
            $tiporenda->save();
            $alterado = true;
        }

        if((int) $request->ativo !== (int) $tiporenda->ativo) {
            $tiporenda->ativo = $request->ativo;
            $tiporenda->save();
            $alterado = true;
        }

        if($alterado === true) {
            return redirect()->route('tiporenda.index')->with('success', 'Alteração(ões) realizada(s) com Sucesso!');
        }else {
           return redirect()->route('tiporenda.index')->with('error', 'Nada para ser alterado');
        }

    }

}

?>