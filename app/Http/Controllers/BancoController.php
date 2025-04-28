<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalvarBancoRequest;
use App\Models\Banco;

class BancoController extends Controller {

    public function iniciar(SalvarBancoRequest $request = null) {

        $request = $request ?: SalvarBancoRequest::capture();

        $id = $request->input('id', null);
        $descricao = $request->input('descricao', null);
        $ativo = $request->input('ativo', null);
        
        if($ativo === 'false') {
            $query = Banco::where('ativo', false)->orderBy('id');
        }else if($ativo === 'todos') {
            $query = Banco::orderBy('id');
        }else {
            $query = Banco::where('ativo', true)->orderBy('id');
        }

        if($id != null) {
            $query = $query->where('id', $id);
        }

        if ($descricao != null) {
            $query = $query->where('descricao', 'ILIKE', '%' . $descricao . '%');
        }
 
        $bancos = $query->get();
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

    public function atualizar(SalvarBancoRequest $request, $id) {
        $banco = Banco::findOrFail($id);
        $alterado = false;

        if($request->descricao !== $banco->descricao) {
            $banco->descricao = $request->descricao;
            $banco->save();
            $alterado = true;
        }

        if((int)$request->ativo !== (int)$banco->ativo) {
            $banco->ativo = $request->ativo;
            $banco->save();
            $alterado = true;
        }

        if($alterado === true) {
            return redirect()->route('banco.index')->with('success', 'Alteração(ões) realizada(s) com Sucesso!');
        }else {
           return redirect()->route('banco.index')->with('error', 'Nada para ser alterado');
        }
    }

}

?>