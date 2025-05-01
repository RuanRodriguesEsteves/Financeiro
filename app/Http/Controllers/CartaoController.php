<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartaoRequest;
use App\Models\Banco;
use App\Models\Cartao;

class CartaoController extends Controller {

    public function iniciar(CartaoRequest $request = null) {
        $request = $request ?: CartaoRequest::capture();

        $id = $request->input('id', null);
        $descricao = $request->input('descricao', null);
        $id_banco = $request->input('id_banco', null);
        $ativo = $request->input('ativo', null);

        if($ativo === 'false') {
            $query = Cartao::where('ativo', false)->orderBy('id');
        }else if($ativo === 'todos') {
            $query = Cartao::orderBy('id');
        }else {
            $query = Cartao::where('ativo', true)->orderBy('id');
        }

        if($id != null) {
            $query = $query->where('id', $id);
        }

        if ($descricao != null) {
            $query = $query->where('descricao', 'ILIKE', '%' . $descricao . '%');
        }

        if ($id_banco != null) {
            $query = $query->where('id_banco', $id_banco);
        }

        $bancos = Banco::where('ativo', true)->orderBy('descricao')->get();
        $cartoes = $query->get();
        return view('cartao')->with([
            'cartoes' => $cartoes,
            'bancos' => $bancos
        ]);
    }

    public function salvar(CartaoRequest $request) {
        $cartao = Cartao::create([
            'descricao' => $request->input('descricao'),
            'id_banco' => $request->input('id_banco')
        ]);

        return redirect()->route('cartao.index')->with('successoSalvar', 'Renda salva com sucesso!');
    }

    public function atualizar(CartaoRequest $request, $id) {
        $cartao = Cartao::findOrFail($id);
        $alterado = false;

        if($request->descricao !== $cartao->descricao) {
            $cartao->descricao = $request->descricao;
            $cartao->save();
            $alterado = true;
        }

        if((int) $request->id_banco !== (int) $cartao->id_banco) {
            $cartao->id_banco = $request->id_banco;
            $cartao->save();
            $alterado = true;
        }

        if((int) $request->ativo !== (int) $cartao->ativo) {
            $cartao->ativo = $request->ativo;
            $cartao->save();
            $alterado = true;
        }

        if($alterado === true) {
            return redirect()->route('cartao.index')->with('success', 'Alteração(ões) realizada(s) com Sucesso!');
        }else {
           return redirect()->route('cartao.index')->with('error', 'Nada para ser alterado');
        }
    }
    
}

?>