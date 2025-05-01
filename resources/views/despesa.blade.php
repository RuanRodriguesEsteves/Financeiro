@extends('layout')

@section('content')

<h1>Despesas</h1>

<div class="card mb-4">
    <div class="card-header bg-dark text-white">
        Cadastro de Despesas
    </div>

    <div class="card-body">
        <form action="{{route('despesa.salvar')}}" method="POST" class="row g-2 align-items-end mb-3">
            @csrf
            <div class="col-md-3">
                <label for="descricao" class="form-label">Descrição</label>
                <input type="text" class="form-control" id="descricao" name="descricao" required>
            </div>

            <div class="col-md-2">
                <label for="id_tipodespesa" class="form-label">Tipo Despesa</label>
                <select class="form-select" id="id_tipodespesa" name="id_tipodespesa" required>
                    <option value="">Selecione</option>
                    @foreach ($tipoDespesas as $tipodespesa)
                        <option value="{{ $tipodespesa->id }}">{{$tipodespesa->descricao}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label for="id_mensalidadecartao" class="form-label">Mensalidade Cartão</label>
                <select class="form-select" id="id_mensalidadecartao" name="id_mensalidadecartao">
                    <option value="">Selecione uma mensalidade</option>
                    @foreach ($mensalidadeCartoes as $mensalidadecartao)
                        <option value="{{ $mensalidadecartao->id }}">{{$mensalidadecartao->descricao}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <label for="valor" class="form-label">Valor</label>
                <input type="number" step="0.01" class="form-control" id="valor" name="valor" required>
            </div>

            <div class="col-md-2">
                <label for="data" class="form-label">Data</label>
                <input type="date" class="form-control" id="data" name="data" required>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-dark">Salvar</button>
            </div>
        </form>
    </div>
    @if(session('successoSalvar'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-msg">
            {{ session('successoSalvar') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>

<div class="card mb-4">
    <div class="card-header bg-dark text-white">
        Consulta de Despesa
    </div>
    <div class="card-body">
        <form action=" {{ route('despesa.index') }} " method="GET" class="row g-2 align-items-end mb-3">
            <div class="col-md-1">
                <input placeholder="ID" type="number" class="form-control" id="id" name="id">
            </div>
            <div class="col-md-3">
                <input placeholder="Descrição" type="text" class="form-control" id="descricao" name="descricao">
            </div>
            <div class="col-md-2">
                <select class="form-select" id="id_tipodespesa" name="id_tipodespesa">
                    <option value="">Todos Tipo Despesas</option>
                    @foreach ($tipoDespesas as $tipodespesa)
                        <option value="{{ $tipodespesa->id }}">{{$tipodespesa->descricao}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select class="form-select" id="id_mensalidadecartao" name="id_mensalidadecartao">
                    <option value="">Todas Mensalidades</option>
                    @foreach ($mensalidadeCartoes as $mensalidadecartao)
                        <option value="{{ $mensalidadecartao->id }}">{{$mensalidadecartao->descricao}}</option>
                    @endforeach
                    <option value="null">Sem Mensalidade</option>
                </select>
            </div>
            <div class="col-md-1">
                <input placeholder="Valor" type="number" class="form-control" id="valor" name="valor">
            </div>
            <div class="col-md-2">
                <input placeholder="Data" type="date" class="form-control" id="data" name="data">
            </div>
            <div class="col-md-1">
                <select class="form-select" name="ativo" id="ativo">
                    <option value="true" selected>Ativo</option>
                    <option value="false">Cancelado</option>
                    <option value="Todos">Todos</option>
                </select>
            </div>
            <div class="text-end">
                <button class="btn btn-dark">Consultar</button>
            </div>
        </form>
    </div>
</div>

<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Descrição</th>
            <th>Tipo Despesa</th>
            <th>Data</th>
            <th>Mensalidade Cartão</th>
            <th>Valor</th>
            <th>Cancelado</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        @forelse($despesas as $despesa)
        @php $formId = 'atualizar-' . $despesa->id @endphp
            <tr>
                <td>{{ $despesa->id }}</td>
                <td>
                    <input type="text" value="{{ $despesa->descricao }}" id="descricao" name="descricao" class="form-control" form="{{ $formId }}">
                </td>
                <td>
                    <select name="id_tipodespesa" id="id_tipodespesa" class="form-select" form="{{ $formId }}">
                        <option value="{{ $despesa->id_tipodespesa }}">{{ $despesa->tipoDespesa->descricao }}</option>
                        @foreach ($tipoDespesas as $tipoDespesa)
                            @if ($tipoDespesa->id != $despesa->id_tipodespesa)
                                <option value="{{ $tipoDespesa->id }}">{{ $tipoDespesa->descricao }}</option>
                            @endif
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="date" class="form-control" id="data" name="data" value="{{ $despesa->data }}" form="{{ $formId }}">
                </td>
                <td>
                    <select name="id_mensalidadecartao" id="id_mensalidadecartao" class="form-select" form="{{ $formId }}">
                        <option value="">Sem Mensalidade</option>
                        @foreach($mensalidadeCartoes as $mensalidadeCartao)
                            <option value="{{ $mensalidadeCartao->id }}" 
                                @if($mensalidadeCartao->id == $despesa->id_mensalidadecartao) selected @endif>
                                {{ $mensalidadeCartao->descricao }}
                            </option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="number" step="0.01" value="{{ $despesa->valor }}" class="form-control" id="valor" name="valor" form="{{ $formId }}">
                </td>
                <td>
                    <select name="ativo" id="ativo" class="form-select" form="{{ $formId }}">
                        <option value="1" {{ $despesa->ativo ? 'selected' : '' }} >Não</option>
                        <option value="0" {{ !$despesa->ativo ? 'selected' : '' }} >Sim</option>
                    </select>
                </td>
                <td>
                    <form id="{{ $formId }}" action="{{ route('despesa.atualizar', ['id' => $despesa->id]) }}" class="d-flex align-items-center gap-2" method="POST" >
                        @csrf
                        @method('PUT')
                        <button class="btn btn-dark">Atualizar</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center">Nemhuma despesa cadastrada.</td>
            </tr>
        @endforelse
    </tbody>
</table>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-msg">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert-msg">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@endsection