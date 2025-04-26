@extends('layout')

@section('content')

<h1>Cartão</h1>

<form action="{{route('cartao.salvar')}}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="descricao" class="form-label">Descrição</label>
        <input type="text" class="form-control" id="descricao" name="descricao" required>
    </div>

    <div class="mb-3">
        <label for="id_banco" class="form-label">Banco</label>
        <select class="form-select" id="id_banco" name="id_banco" required>
            <option value="">Selecione um banco</option>
            @foreach ($bancos as $banco)
                <option value="{{ $banco->id }}">{{ $banco->descricao }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-light mb-3">Salvar</button>
</form>

<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Descrição</th>
            <th>Banco</th>
        </tr>
    </thead>
    <tbody>
        @forelse($cartoes as $cartao)
            <tr>
                <td>{{ $cartao->id }}</td>
                <td>{{ $cartao->descricao }}</td>
                <td>{{ $cartao->banco->descricao }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center">Nenhum Cartão cadastrado.</td>
            </tr>
        @endforelse
    </tbody>
</table>

@endsection