@extends('layout')

@section('content')
<h1>Bem-vindo ao Painel Financeiro</h1>
<p>Selecione uma opção do menu lateral para gerenciar suas finanças.</p>

<table class="table table-bordered table-hover">
    <h1>Mês atual</h1>
    <thead class="table-dark">
        <tr>
            <th>Renda Total</th>
            <th>Despesa Total</th>
            <th>Valor Restante</th>
        </tr>
    </thead>
    <tbody>
        @forelse($totaisMesAtual as $total)
            <tr>
                <td>{{ number_format($total->rendatotal, 2, ',', '.') }}</td>
                <td>{{ number_format($total->despesatotal, 2, ',', '.') }}</td>
                <td>{{ number_format($total->valorrestante, 2, ',', '.') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center">Sem Totais.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<table class="table table-bordered table-hover">
    <h1>Próximo Mês</h1>
    <thead class="table-dark">
        <tr>
            <th>Renda Total</th>
            <th>Despesa Total</th>
            <th>Valor Restante</th>
        </tr>
    </thead>
    <tbody>
        @forelse($totaisProximoMes as $total)
            <tr>
                <td>{{ number_format($total->rendatotal, 2, ',', '.') }}</td>
                <td>{{ number_format($total->despesatotal, 2, ',', '.') }}</td>
                <td>{{ number_format($total->valorrestante, 2, ',', '.') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center">Sem Totais.</td>
            </tr>
        @endforelse
    </tbody>
</table>

@endsection