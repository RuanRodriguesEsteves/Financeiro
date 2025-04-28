@extends('layout')

@section('content')

<h1>Mensalidade Cartão</h1>

<div class="card mb-4">
    <div class="card-header bg-dark text-white">
        Cadastrar Mensalidade
    </div>
    <div class="card-body">
        <form action="{{route('mensalidadecartao.salvar')}}" method="POST" class="row g-2 align-items-end mb-3">
            @csrf
            <div class="col-md-8">
                <label for="descricao" class="form-label">Descrição</label>
                <input type="text" class="form-control" id="descricao" name="descricao" required>
            </div>

            <div class="col-md-2">
                <label for="id_cartao" class="form-label">Cartão</label>
                <select class="form-select" id="id_cartao" name="id_cartao" required>
                    <option value="">Selecione um cartão</option>
                    @foreach ($cartoes as $cartao)
                        <option value="{{ $cartao->id }}">{{ $cartao->descricao }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <label for="valor" class="form-label">Valor</label>
                <input type="number" step="0.01" class="form-control" id="valor" name="valor" required>
            </div>

            <div class="col-md-2">
                <label for="datafechamento" class="form-label">Data de Fechamento</label>
                <input type="date" class="form-control" id="datafechamento" name="datafechamento" required>
            </div>

            <div class="col-md-2">
                <label for="datavencimento" class="form-label">Data de Vencimento</label>
                <input type="date" class="form-control @error('datavencimento') is-invalid @enderror" id="datavencimento" name="datavencimento" required>
                @error('datavencimento')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="col-md-2">
                <label for="mesreferencia" class="form-label">Mês de Referência</label>
                <input type="month" class="form-control" id="mesreferencia" name="mesreferencia" required>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-dark ms-auto">Salvar</button>
            </div>
            
        </form>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header bg-dark text-white">
        Cadastrar Mensalidade
    </div>
    <div class="card-body">
        <form action="{{route('mensalidadecartao.index')}}" method="GET" class="row g-2 align-items-end mb-3">
            @csrf
            <div class="col-md-1">
                <input type="number" name="id" id="id" class="form-control" placeholder="ID">
            </div>

            <div class="col-md-7">
                <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição">
            </div>

            <div class="col-md-2">
                <select class="form-select" id="id_cartao" name="id_cartao">
                    <option value="">Todos</option>
                    @foreach ($cartoes as $cartao)
                        <option value="{{ $cartao->id }}">{{ $cartao->descricao }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <input type="number" step="0.01" class="form-control" id="valor" name="valor" placeholder="Valor">
            </div>

            <div class="col-md-2">
                <label for="datafechamento">Data Fechamento</label>
                <input type="date" class="form-control" id="datafechamento" name="datafechamento" placeholder="Data Fechamento">
            </div>

            <div class="col-md-2">
                <label for="datafechamento">Data Vencimento</label>
                <input type="date" class="form-control" id="datavencimento" name="datavencimento" placeholder="Data Vencimento">
            </div>
            
            <div class="col-md-2">
                <label for="mesreferencia">Mês Referência</label>
                <input type="date" class="form-control" id="mesreferencia" name="mesreferencia" placeholder="Mês Referência">
            </div>

            <div class="col-md-2">
                <select class="form-select" name="ativo" id="ativo">
                    <option value="true" selected>Ativo</option>
                    <option value="false">Cancelado</option>
                    <option value="todos">Todos</option>
                </select>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-dark ms-auto">Consultar</button>
            </div>
            
        </form>
    </div>
</div>

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
            <th>Cancelado</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        @forelse($mensalidadecartoes as $mensalidadecartao)
        @php $formId = 'atualizar-' . $mensalidadecartao->id @endphp
            <tr>
                <td>{{ $mensalidadecartao->id }}</td>
                <td>
                    <input class="form-control" type="text" id="descricao" name="descricao" value="{{ $mensalidadecartao->descricao }}" form="{{ $formId }}">
                </td>
                <td>
                    <select name="id_cartao" id="id_cartao" class="form-select" form="{{ $formId }}">
                        <option value="{{ $mensalidadecartao->cartao->id }}">{{ $mensalidadecartao->cartao->descricao }}</option>
                        @foreach ($cartoes as $cartao)
                            @if ($cartao->id != $mensalidadecartao->id_cartao)
                                <option value="{{ $cartao->id }}">{{ $cartao->descricao }}</option>
                            @endif
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="number" step="0.01" class="form-control" id="valor" name="valor" value="{{ $mensalidadecartao->valor }}" form="{{ $formId }}">
                </td>
                <td>
                    <input type="date" class="form-control" id="datafechamento" name="datafechamento" value="{{ $mensalidadecartao->datafechamento }}" form="{{ $formId }}">
                </td>
                <td>
                    <input type="date" class="form-control @error('datavencimento') is-invalid @enderror" id="datavencimento" name="datavencimento" value="{{ $mensalidadecartao->datavencimento }}" form="{{ $formId }}">
                </td>
                <td>
                    <input type="date" class="form-control" id="mesreferencia" name="mesreferencia" placeholder="Mês Referência" value="{{ $mensalidadecartao->mesreferencia }}" form="{{ $formId }}">
                </td>
                <td>
                    <select class="form-select" name="ativo" id="ativo" form="{{ $formId }}">
                        <option value="1" {{ $mensalidadecartao->ativo ? 'selected' : '' }}>Não</option>
                        <option value="0" {{ !$mensalidadecartao->ativo ? 'selected' : '' }}>Sim</option>
                    </select>
                </td>
                <td>
                    <form id="{{ $formId }}" action=" {{ route('mensalidadecartao.atualizar', ['id' => $mensalidadecartao->id]) }} " class="d-flex align-items-center gap-2" method="POST">
                        @csrf
                        @method('PUT')
                        <button class="btn btn-dark btn-sm" type="submit">Atualizar</button>
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