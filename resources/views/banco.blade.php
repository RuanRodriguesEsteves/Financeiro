@extends('layout')

@section('content')
<h1>Banco</h1>

<div class="card mb-4">
    <div class="card-header bg-dark text-white">
        Cadastro de Banco
    </div>
    <div class="card-body">
        <form action="{{ route('banco.salvar') }}" method="POST" class="row g-2 align-items-end mb-3">
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
    @if(session('successoSalvar'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-msg">
            {{ session('successoSalvar') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>

<div class="card">
    <div class="card-header bg-dark text-white">
        Consultar Banco
    </div>
    <div class="card-body">
        <form action="{{ route('banco.index') }}" method="GET" class="row g-2 align-items-end mb-3">
            @csrf
            <div class="col-md-1">
                <label for="id" class="form-label">ID</label>
                <input type="number" placeholder="ID" id="id" name="id" class="form-control">
            </div>
            <div class="col-md-7">
                <label for="descricao" class="form-label">Descrição</label>
                <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição">
            </div>
            <div class="col-md-2">
                <label for="ativo" class="form-label">Situação</label>
                <select name="ativo" id="ativo" class="form-select">
                    <option value="true" selected>Ativo</option>
                    <option value="false">Inativo</option>
                    <option value="todos">Todos</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-dark w-100">Consultar</button>
            </div>
        </form>
    </div>
</div>

<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Descrição</th>
            <th>Ativo</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        @forelse($bancos as $banco)
            @php $formId = 'atualizar-' . $banco->id @endphp
            <tr>
                <td>{{ $banco->id }}</td>
                <td>
                    <input type="text" id="descricao" name="descricao" value="{{ $banco->descricao }}" class="form-control" form="{{ $formId }}">
                </td>
                <td>
                    <select name="ativo" id="ativo" class="form-select" form="{{ $formId }}">
                        <option value="1" {{ $banco->ativo ? 'selected' : '' }}>Ativo</option>
                        <option value="0" {{ !$banco->ativo ? 'selected' : '' }}>Inativo</option>
                    </select>
                </td>
                <td>
                    <form id="{{ $formId }}" action="{{ route('banco.atualizar', ['id' => $banco->id]) }}" class="form" class="d-flex align-items-center gap-2" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <button class="btn btn-dark btn-sm" type="submit">Atualizar</button>
                        </div>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center">Nenhum tipo de Despesa cadastrado.</td>
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