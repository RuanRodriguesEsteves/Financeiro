<?php

namespace App\Http\Controllers;

use App\Http\Requests\MensalidadeCartaoRequest;
use App\Models\Cartao;
use App\Models\MensalidadeCartao;

class MensalidadeCartaoController extends Controller {

    public function iniciar(MensalidadeCartaoRequest $request = null) {
        $request = $request ?: MensalidadeCartaoRequest::capture();

        $id = $request->input('id', null);
        $descricao = $request->input('descricao', null);
        $id_cartao = $request->input('id_cartao', null);
        $valor = $request->input('valor', null);
        $dataFechamentoInicio = $request->input('datafechamentoinicio', null);
        $dataFechamentoTermino = $request->input('datafechamentotermino', null);
        $dataVencimentoInicio = $request->input('datavencimentoinicio', null);
        $dataVencimentoTermino = $request->input('datavencimentotermino', null);
        $mesreferencia = $request->input('mesreferencia', null);
        $ativo = $request->input('ativo', null);

        if ($ativo === 'false') {
            $query = MensalidadeCartao::where('ativo', false)->orderBy('id');
        } else if ($ativo === 'todos') {
            $query = MensalidadeCartao::orderBy('id');
        } else {
            $query = MensalidadeCartao::where('ativo', true)->orderBy('id');
        }

        if($id != null) {
            $query = $query->where('id', $id);
        }

        if($descricao != null) {
            $query = $query->where('descricao', 'ilike', '%' . $descricao . '%');
        }

        if($id_cartao != null) {
            $query = $query->where('id_cartao', $id_cartao);
        }

        if($valor != null) {
            $query = $query->where('valor',  $valor);
        }

        if($dataFechamentoInicio != null && $dataFechamentoTermino != null) {
            $query = $query->whereBetween('datafechamento', [$dataFechamentoInicio, $dataFechamentoTermino]);
        }else if ($dataFechamentoInicio != null) {
            $query = $query->where('datafechamento', $dataFechamentoInicio);
        }else if ($dataFechamentoTermino != null) {
            $query = $query->where('datafechamento', $dataFechamentoTermino);
        }

        if($dataVencimentoInicio != null && $dataVencimentoTermino != null) {
            $query = $query->whereBetween('datavencimento', [$dataVencimentoInicio, $dataVencimentoTermino]);
        }else if ($dataVencimentoInicio != null) {
            $query = $query->where('datavencimento', $dataVencimentoInicio);
        }else if ($dataVencimentoTermino != null) {
            $query = $query->where('datavencimento', $dataVencimentoTermino);
        }

        if($mesreferencia != null) {
            $query = $query->where('mesreferencia', $mesreferencia . '-01');
        }

        $cartoes = Cartao::where('ativo', true)->orderBy('descricao')->get();
        $mensalidadecartoes = $query->get();

        return view('mensalidadecartao')->with([
            'cartoes' => $cartoes,
            'mensalidadecartoes' => $mensalidadecartoes
        ]);
    }

    public function salvar(MensalidadeCartaoRequest $request) {

        $mensalidadeCartoes = MensalidadeCartao::create([
            'descricao' => $request->input('descricao'),
            'valor' => $request->input('valor'),
            'datafechamento' => $request->input('datafechamento'),
            'datavencimento' => $request->input('datavencimento'),
            'mesreferencia' => $request->input('mesreferencia') . '-01',
            'id_cartao' => $request->input('id_cartao')
        ]);

        return redirect()->route('mensalidadecartao.index')->with('successoSalvar', 'Renda salva com sucesso!');
    }

    public function atualizar(MensalidadeCartaoRequest $request, $id) {
        $mensalidadeCartoes = MensalidadeCartao::findOrFail($id);
        $alterado = false;

        if($request->descricao !== $mensalidadeCartoes->descricao){
            $mensalidadeCartoes->descricao = $request->descricao;
            $mensalidadeCartoes->save();
            $alterado = true;
        }

        if((int) $request->id_cartao !== (int) $mensalidadeCartoes->id_cartao){
            $mensalidadeCartoes->id_cartao = $request->id_cartao;
            $mensalidadeCartoes->save();
            $alterado = true;
        }

        if((double) $request->valor !== (double) $mensalidadeCartoes->valor){
            $mensalidadeCartoes->valor = $request->valor;
            $mensalidadeCartoes->save();
            $alterado = true;
        }

        if( $request->datafechamento !== $mensalidadeCartoes->datafechamento){
            $mensalidadeCartoes->datafechamento = $request->datafechamento;
            $mensalidadeCartoes->save();
            $alterado = true;
        }

        if( $request->datavencimento !== $mensalidadeCartoes->datavencimento){
            $mensalidadeCartoes->datavencimento = $request->datavencimento;
            $mensalidadeCartoes->save();
            $alterado = true;
        }

        if( $request->mesreferencia !== $mensalidadeCartoes->mesreferencia){
            $mensalidadeCartoes->mesreferencia = substr($request->mesreferencia, 0, 7) . '-01';
            $mensalidadeCartoes->save();
            $alterado = true;
        }

        if((int) $request->ativo !== (int) $mensalidadeCartoes->ativo){
            $mensalidadeCartoes->ativo = $request->ativo;
            $mensalidadeCartoes->save();
            $alterado = true;
        }

        if($alterado === true) {
            return redirect()->route('mensalidadecartao.index')->with('success', 'Alteração(ões) realizada(s) com Sucesso!');
        }else {
           return redirect()->route('mensalidadecartao.index')->with('error', 'Nada para ser alterado');
        }
    }

}

?>