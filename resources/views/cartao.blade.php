@extends('layout')

@section('content')

<h1>Cartão</h1>

<div class="card mb-4">
    <div class="card-header">
        Cadastrar Cartão
    </div>
    <div class="card-body">
        <form class="row g-2 align-items-end mb-3" action="{{route('cartao.salvar')}}" method="POST">
            @csrf
            <div class="col-md-9">
                <label for="descricao" class="form-label">Descrição</label>
                <input type="text" class="form-control" id="descricao" name="descricao" required>
            </div>
            <div class="col-md-2">
                <label for="id_banco" class="form-label">Banco</label>
                <select class="form-select" id="id_banco" name="id_banco" required>
                    <option value="">Selecione um banco</option>
                    @foreach ($bancos as $banco)
                        <option value="{{ $banco->id }}">{{ $banco->descricao }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-1">
                <button type="submit" class="btn btn-dark w-100">Salvar</button>
            </div>
        </form>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        Consultar Cartão
    </div>
    <div class="card-body">
        <form class="row g-2 align-items-end mb-3" action="{{route('cartao.index')}}" method="GET">
            @csrf
            <div class="col-md-1">
                <input class="form-control" type="number" id="id" name="id" placeholder="ID">
            </div>
            <div class="col-md-7">
                <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição">
            </div>
            <div class="col-md-2">
                <select class="form-select" id="id_banco" name="id_banco">
                    <option value="">Todos</option>
                    @foreach ($bancos as $banco)
                        <option value="{{ $banco->id }}">{{ $banco->descricao }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-1">
                <select name="ativo" id="ativo" class="form-select">
                    <option value="true" selected>Ativo</option>
                    <option value="false">Inativo</option>
                    <option value="todos">Todos</option>
                </select>
            </div>
            <div class="col-md-1">
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
            <th>Banco</th>
            <th>Ativo</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        @forelse($cartoes as $cartao)
        @php $formId = 'atualizar-' . $cartao->id @endphp
            <tr>
                <td>{{ $cartao->id }}</td>
                <td>
                    <input type="text" name="descricao" id="descricao" class="form-control" value="{{ $cartao->descricao }}" form="{{ $formId }}">
                </td>
                <td>
                    <select name="id_banco" id="id_banco" class="form-select" form="{{ $formId }}">
                        <option value="{{ $cartao->id_banco }}">{{ $cartao->banco->descricao }}</option>
                        @foreach ($bancos as $banco)
                            @if ($banco->id != $cartao->id_banco)
                                <option value="{{ $banco->id }}">{{ $banco->descricao }}</option>
                            @endif
                        @endforeach
                    </select>
                </td>
                <td>
                    <select name="ativo" id="ativo" class="form-select" form="{{ $formId }}">
                        <option value="1" {{ $cartao->ativo ? 'selected' : '' }}>Ativo</option>
                        <option value="0" {{ !$cartao->ativo ? 'selected' : '' }}>Inativo</option>
                    </select>
                </td>
                <td>
                    <form id="{{ $formId }}" action="{{ route('cartao.atualizar', ['id' => $cartao->id]) }}" class="form" class="d-flex align-items-center gap-2" method="POST">
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
                <td colspan="8" class="text-center">Nenhum Cartão cadastrado.</td>
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