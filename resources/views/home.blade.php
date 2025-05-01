@extends('layout')

@section('content')

<!-- Dentro do seu HTML Blade -->
<div id="graficoMesAtual" 
     data-despesa="{{ $totaisMesAtual[0]->despesatotal }}" 
     data-restante="{{ $totaisMesAtual[0]->valorrestante }}">
</div>

<div id="graficoProximoMes" 
     data-despesa="{{ $totaisProximoMes[0]->despesatotal }}" 
     data-restante="{{ $totaisProximoMes[0]->valorrestante }}">
</div>

<h1>Bem-vindo ao Painel Financeiro</h1>
<p>Selecione uma opção do menu lateral para gerenciar suas finanças.</p> 

<div class="row">
    <div class="col-md-6">
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
    </div>

    <div class="col-md-6">
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
    </div>
</div>

<div class="row">
    <div class="col-md-6 mt-5 mb-5">
        <h3 class="text-center">Mês Atual</h3>
        <div class="d-flex align-items-center justify-content-center bg-white border rounded" style="height: 300px;">
            <canvas id="mesAtual"></canvas>
        </div>
    </div>

    <div class="col-md-6 mt-5 mb-5">
        <h3 class="text-center">Próximo Mês</h3>
        <div class="d-flex align-items-center justify-content-center bg-white border rounded" style="height: 300px;">    
            <canvas id="proximoMes"></canvas>
        </div>
    </div>
</div>

@endsection