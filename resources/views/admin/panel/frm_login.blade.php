<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('panel/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('panel/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('panel/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <strong>Login</strong>
        </div>
        <div class="card">
            @if(Session::get('lg_tentativas') <4 )
            <div class="card-body login-card-body">
                <p class="login-box-msg">Entre com seus dados para iniciar a sessão</p>
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="usuario" class="form-control" placeholder="E-mail/usuário">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="senha" class="form-control" placeholder="Senha">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                        </div>
                    </div>
                </form>
            </div>
            @else
                <div class="card-body login-card-body" style="text-align: center">
                    <p class="login-box-msg" style="font-size: 28px; color:red">Acesso Bloqueado!</p>
                    <p class="login-box-msg">Seu acesso foi bloqueado por repetidas</p>
                    <p class="login-box-msg">tentativas de acesso sem permissão.</p>
                    <p class="login-box-msg">Tente Novamente em 60 minutos.</p>
                </div>
            @endif
        </div>
    </div>

    <script src="{{ asset('panel/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('panel/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('panel/dist/js/adminlte.min.js') }}"></script>
</body>

</html>
