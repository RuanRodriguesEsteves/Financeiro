@extends('layout')

@section('content')

<h1>Despesas</h1>

<form action="{{route('despesa.salvar')}}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="descricao" class="form-label">Descrição</label>
        <input type="text" class="form-control" id="descricao" name="descricao" required>
    </div>

    <div class="mb-3">
        <label for="id_tipodespesa" class="form-label">Tipo Despesa</label>
        <select class="form-select" id="id_tipodespesa" name="id_tipodespesa" required>
            <option value="">Selecione um tipo despesa</option>
            @foreach ($tipoDespesas as $tipodespesa)
                <option value="{{ $tipodespesa->id }}">{{$tipodespesa->descricao}}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="id_mensalidadecartao" class="form-label">Mensalidade Cartão</label>
        <select class="form-select" id="id_mensalidadecartao" name="id_mensalidadecartao">
            <option value="">Selecione uma mensalidade</option>
            @foreach ($mensalidadeCartoes as $mensalidadecartao)
                <option value="{{ $mensalidadecartao->id }}">{{$mensalidadecartao->descricao}}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="valor" class="form-label">Valor</label>
        <input type="number" step="0.01" class="form-control" id="valor" name="valor" required>
    </div>

    <div class="mb-3">
        <label for="data" class="form-label">Data</label>
        <input type="date" class="form-control" id="data" name="data" required>
    </div>

    <button type="submit" class="btn btn-light mb-3">Salvar</button>
</form>

<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Descrição</th>
            <th>Tipo Despesa</th>
            <th>Data</th>
            <th>Mensalidade Cartão</th>
            <th>Valor</th>
        </tr>
    </thead>
    <tbody>
        @forelse($despesas as $despesa)
            <tr>
                <td>{{ $despesa->id }}</td>
                <td>{{ $despesa->descricao }}</td>
                <td>{{ $despesa->tipoDespesa->descricao }}</td>
                <td>{{ $despesa->data }}</td>
                <td>{{ optional($despesa->mensalidadeCartao)->descricao }}</td>
                <td>{{ $despesa->valor }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center">Nemhuma despesa cadastrada.</td>
            </tr>
        @endforelse
    </tbody>
</table>

@endsection