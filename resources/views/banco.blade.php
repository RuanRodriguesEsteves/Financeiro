@extends('layout')

@section('content')
<h1>Banco</h1>

<form action="{{ route('banco.salvar') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="descricao" class="form-label">Descrição</label>
        <input type="text" class="form-control" id="descricao" name="descricao" required>
    </div>
    <button type="submit" class="btn btn-light mb-3">Salvar</button>
</form>

<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Descrição</th>
        </tr>
    </thead>
    <tbody>
        @forelse($bancos as $banco)
            <tr>
                <td>{{ $banco->id }}</td>
                <td>{{ $banco->descricao }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center">Nenhum tipo de Despesa cadastrado.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection