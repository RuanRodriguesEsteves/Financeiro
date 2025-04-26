@extends('layout')

@section('content')

<h1>Mensalidade Cartão</h1>

<form action="{{route('mensalidadecartao.salvar')}}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="descricao" class="form-label">Descrição</label>
        <input type="text" class="form-control" id="descricao" name="descricao" required>
    </div>

    <div class="mb-3">
        <label for="id_cartao" class="form-label">Cartão</label>
        <select class="form-select" id="id_cartao" name="id_cartao" required>
            <option value="">Selecione um cartão</option>
            @foreach ($cartoes as $cartao)
                <option value="{{ $cartao->id }}">{{ $cartao->descricao }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="valor" class="form-label">Valor</label>
        <input type="number" step="0.01" class="form-control" id="valor" name="valor" required>
    </div>

    <div class="mb-3">
        <label for="datafechamento" class="form-label">Data de Fechamento</label>
        <input type="date" class="form-control" id="datafechamento" name="datafechamento" required>
    </div>

    <div class="mb-3">
        <label for="datavencimento" class="form-label">Data de Vencimento</label>
        <input type="date" class="form-control @error('datavencimento') is-invalid @enderror" id="datavencimento" name="datavencimento" required>
        @error('datavencimento')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    

    <div class="mb-3">
        <label for="mesreferencia" class="form-label">Mês de Referência</label>
        <input type="month" class="form-control" id="mesreferencia" name="mesreferencia" required>
    </div>

    <button type="submit" class="btn btn-light mb-3">Salvar</button>
</form>

<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Descrição</th>
            <th>Cartão</th>
            <th>Valor</th>
            <th>Data Fechamento</th>
            <th>Data Vencimento</th>
            <th>Mês Referência</th>
        </tr>
    </thead>
    <tbody>
        @forelse($mensalidadecartoes as $mensalidadecartoes)
            <tr>
                <td>{{ $mensalidadecartoes->id }}</td>
                <td>{{ $mensalidadecartoes->descricao }}</td>
                <td>{{ $mensalidadecartoes->cartao->descricao }}</td>
                <td>{{ $mensalidadecartoes->valor }}</td>
                <td>{{ $mensalidadecartoes->datafechamento }}</td>
                <td>{{ $mensalidadecartoes->datavencimento }}</td>
                <td>{{ $mensalidadecartoes->mesreferencia }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center">Nenhum Cartão cadastrado.</td>
            </tr>
        @endforelse
    </tbody>
</table>

@endsection