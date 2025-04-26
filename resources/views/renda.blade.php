@extends('layout')

@section('content')

<h1>Renda</h1>

<div class="card mb-4">
    <div class="card-header bg-dark text-white">
        Cadastro de Renda
    </div>
    <div class="card-body">
        <form action="{{route('renda.salvar')}}" method="POST" class="row g-2 align-items-end mb-3">
            @csrf
            <div class="col-md-4">
                <label for="descricao" class="form-label">Descrição</label>
                <input type="text" class="form-control" id="descricao" name="descricao" required>
            </div>
            <div class="col-md-3">
                <label for="id_tiporenda" class="form-label">Tipo Renda</label>
                <select class="form-select" id="id_tiporenda" name="id_tiporenda" required>
                    <option value="">Selecione um tipo renda</option>
                    @foreach ($tipoRendas as $tipoRenda)
                        <option value="{{ $tipoRenda->id }}">{{$tipoRenda->descricao}}</option>
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

            <div class="col-md-1">
                <button type="submit" class="btn btn-dark w-100">Salvar</button>
            </div>
        </form>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header bg-dark text-white">
        Consultar Renda
    </div>
    <div class="card-body">
        <form action="{{route('renda.index')}}" method="GET" class="row g-2 align-items-end mb-3">
            @csrf
            <div class="col-md-1">
                <input placeholder="ID" type="number" class="form-control" id="id" name="id">
            </div>
            <div class="col-md-3">
                <input placeholder="Descrição" type="text" class="form-control" id="descricao" name="descricao">
            </div>
            <div class="col-md-2">
                <select class="form-select" id="id_tiporenda" name="id_tiporenda">
                    <option value="">Todos</option>
                    @foreach ($tipoRendas as $tipoRenda)
                        <option value="{{ $tipoRenda->id }}">{{$tipoRenda->descricao}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <input placeholder="Valor" type="number" step="0.01" class="form-control" id="valor" name="valor">
            </div>

            <div class="col-md-2">
                <input placeholder="Data" type="date" class="form-control" id="data" name="data">
            </div>

            <div class="col-md-2">
                <select class="form-select" name="ativo" id="ativo">
                    <option value="true" selected>Ativo</option>
                    <option value="false">Cancelado</option>
                    <option value="todos">Todos</option>
                </select>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-dark">Consultar</button>
            </div>
        </form>
    </div>
</div>

<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Descrição</th>
            <th>Tipo Renda</th>
            <th>Valor</th>
            <th>Data</th>
            <th>Cancelado</th>
        </tr>
    </thead>
    <tbody>
        @forelse($rendas as $renda)
        @php $formId = 'atualizar-' . $renda->id @endphp
            <tr>
                <td>{{ $renda->id }}</td>
                <td>
                    <input type="text" class="form-control" id="descricao" name="descricao" value="{{ $renda->descricao }}" form="{{ $formId }}">
                </td>

                <td>
                    <select class="form-select" name="id_tiporenda" id="id_tiporenda" form="{{ $formId }}">
                        <option value="{{ $renda->id_tiporenda }}">{{ $renda->tipoRenda->descricao }}</option>
                        @foreach ($tipoRendas as $tipoRenda)
                            @if ($tipoRenda->id != $renda->id_tiporenda)
                                <option value="{{ $tipoRenda->id }}">{{ $tipoRenda->descricao }}</option>
                            @endif
                        @endforeach
                    </select>
                </td>
                
                <td>
                    <input step="0.01" type="number" class="form-control" id="valor" name="valor" value="{{ $renda->valor }}" form="{{ $formId }}">
                </td>

                <td>
                <input type="date" class="form-control" id="data" name="data" value="{{ $renda->data }}" form="{{ $formId }}">
                </td>

                <td>
                    <select class="form-select" name="ativo" id="ativo" form="{{ $formId }}">
                        <option value="1" {{ $renda->ativo ? 'selected' : '' }}>Não</option>
                        <option value="0" {{ !$renda->ativo ? 'selected' : '' }}>Sim</option>
                    </select>
                </td>
                <td>
                    <form id="{{ $formId }}" action=" {{ route('renda.atualizar', ['id' => $renda->id]) }} " class="d-flex align-items-center gap-2" method="POST">
                        @csrf
                        @method('PUT')
                        <button class="btn btn-dark btn-sm" type="submit">Atualizar</button>
                    </form>
                </td>   
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center">Nenhuma renda cadastrada.</td>
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