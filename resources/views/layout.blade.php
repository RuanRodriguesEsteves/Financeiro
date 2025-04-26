<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Financeiro</title>
  <!-- Incluindo o CSS do Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<nav>
    <!-- Botão de Menu (Ícone de Hambúrguer) -->
    <button class="btn btn-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu">
      <span class="navbar-toggler-icon"></span> Menu
    </button>

    <!-- Menu Lateral (Offcanvas) -->
    <div class="offcanvas offcanvas-start bg-dark text-light" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title text-light" id="offcanvasMenuLabel">Menu Lateral</h5>
        <button type="button" class="btn-close text-light" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="nav flex-column">
          <!-- Botão para abrir o submenu -->
          <li class="nav-item">
            <a class="nav-link text-light" data-bs-toggle="collapse" href="#submenu" role="button" aria-expanded="false" aria-controls="submenu">
              Cadastro ->
            </a>
            <div class="collapse" id="submenu">
              <ul class="nav flex-column ms-3">
                <li class="nav-item">

                  <a class="nav-link text-light" data-bs-toggle="collapse" href="#submenurenda" role="button" aria-expanded="false" aria-controls="submenurenda">
                    Cadastro Renda ->
                  </a>

                  <div class="collapse" id="submenurenda">
                    <ul class="nav flex-column ms-3">
                      <li class="nav-item">
                        <a class="nav-link text-light" href="{{route('tiporenda.index')}}">Tipo de Renda</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link text-light" href="{{route('renda.index')}}">Renda</a>
                      </li>
                    </ul>
                  </div>

                </li>
                <li class="nav-item">

                  <a class="nav-link text-light" data-bs-toggle="collapse" href="#submenudespesa" role="button" aria-expanded="false" aria-controls="submenudespesa">
                    Cadastro Despesa ->
                  </a>
                  
                  <div class="collapse" id="submenudespesa">
                    <ul class="nav flex-column ms-3">
                      <li class="nav-item">
                        <a class="nav-link text-light" href="{{route('tipodespesa.index')}}">Tipo de Despesa</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link text-light" href="{{route('despesa.index')}}">Despesa</a>
                      </li>
                    </ul>
                  </div>

                </li>
                <li class="nav-item">
                  <a class="nav-link text-light" data-bs-toggle="collapse" href="#submenubancosecartoes" role="button" aria-expanded="false" aria-controls="submenubancosecartoes">
                    Cadastro Bancos e Cartões ->
                  </a>
                  <div class="collapse" id="submenubancosecartoes">
                    <ul class="nav flex-column ms-3">
                      <li class="nav-item">
                        <a class="nav-link text-light" href="{{route('banco.index')}}">Banco</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link text-light" href="{{route('cartao.index')}}">Cartão</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link text-light" href="{{route('mensalidadecartao.index')}}">Mensalidade Cartão</a>
                      </li>
                    </ul>
                  </div>
                </li>
              </ul>
            </div>
          </li>
          <!-- Adicione o botão de voltar aqui -->
            <li class="nav-item mt-2">
                <a class="nav-link text-light" href="{{route('home')}}">
                    <- Voltar
                </a>
            </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Conteúdo Principal -->
  <div class="container mt-4">
    @yield('content')
  </div>

  <!-- Inclusão do JS do Bootstrap para ativar o comportamento do Offcanvas -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>