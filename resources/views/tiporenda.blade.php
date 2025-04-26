@extends('layout')

@section('content')
<h1>Tipo de Renda</h1>

<div class="card mb-4">
    <div class="card-header bg-dark text-white">
        Cadastro de Tipo de Renda
    </div>
    <div class="card-body">
        <form action="{{ route('tiporenda.salvar') }}" method="POST" class="row g-2 align-items-end mb-3">
            @csrf
            <div class="col-md-10">
                <label for="descricao" class="form-label">Descrição</label>
                <input type="text" class="form-control" id="descricao" name="descricao" required>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-dark w-100">Salvar</button>
            </div>
        </form>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header bg-dark text-white">
        Consultar Tipo de Renda
    </div>
    <div class="card-body">
        <form action="{{ route('tiporenda.index') }}" method="GET" class="row g-2 align-items-end">
            <div class="col-md-1">
                <input type="number" name="id" class="form-control" placeholder="ID">
            </div>
            <div class="col-md-7">
                <input type="text" name="descricao" class="form-control" placeholder="Descrição">
            </div>
            <div class="col-md-2">
                <select class="form-select w-100" name="ativo" id="ativo">
                    <option value="true" selected>Ativo</option>
                    <option value="false">Inativo</option>
                    <option value="todos">Todos</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-dark w-100">Buscar</button>
            </div>
        </form>
    </div>
</div>


<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Descrição</th>
            <th>Situação</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        @forelse($tiporendas as $tiporenda)
        @php $formId = 'atualizar-' . $tiporenda->id @endphp
            <tr>
                <td>{{ $tiporenda->id }}</td>
                <td>
                    <input type="text" class="form-control" id="descricao" name="descricao" value="{{ $tiporenda->descricao }}" form="{{ $formId }}">
                </td>
                <td>
                    <select class="form-select" name="ativo" id="ativo" form="{{ $formId }}">
                        <option value="1" {{ $tiporenda->ativo ? 'selected' : '' }}>Ativo</option>
                        <option value="0" {{ !$tiporenda->ativo ? 'selected' : '' }}>Inativo</option>
                    </select>
                </td>
                <td>
                    <form id="{{ $formId }}" action=" {{ route('tiporenda.atualizar', ['id' => $tiporenda->id]) }} " class="d-flex align-items-center gap-2" method="POST">
                        @csrf
                        @method('PUT')
                        <button class="btn btn-dark btn-sm" type="submit">Atualizar</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center">Nenhum tipo de renda cadastrado.</td>
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