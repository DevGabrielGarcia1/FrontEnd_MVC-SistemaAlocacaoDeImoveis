<?php

use controller\RouteController;
use generic\ViewResponseCodes;

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Imobiliária</title>
    <link rel="icon" type="image/x-icon" href="<?= RouteController::RootRoute(); ?>/imgs/icon.ico" sizes="96x96">
    <link rel="stylesheet" href="<?= RouteController::RootRoute(); ?>/public/bootstrap/css/bootstrap.css">
    <script src="<?= RouteController::RootRoute(); ?>/public/msgBox.js"></script>
    <link rel="stylesheet" href="<?= RouteController::RootRoute(); ?>/public/style.css">
    <link rel="stylesheet" href="<?= RouteController::RootRoute(); ?>/public/login.css">
    <script src="<?= RouteController::RootRoute(); ?>/public/msgBox.js"></script>
</head>

<body class="bg-light">

    <!-- Menu Superior Fixado -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <!-- Ícone de Logo -->
            <a class="navbar-brand" href="<?= RouteController::RootRoute(); ?>">
                <img src="<?= RouteController::RootRoute(); ?>/public/imgs/logo2.png" alt="Logo" width="30" height="30" class="d-inline-block align-top">
                Imobiliária
            </a>
        </div>
    </nav>

    <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="card p-4 shadow-sm" style="width: 100%; max-width: 400px;">
            <h2 class="text-center mb-4">LOGIN</h2>
            <form action="<?= RouteController::RootRoute() ?>/login/process" method="post">
                <div class="mb-3">
                    <label for="user" class="form-label">Usuário</label>
                    <input type="text" id="user" name="user" class="form-control" placeholder="Usuário" required>
                </div>
                <div class="mb-3">
                    <label for="pass" class="form-label">Senha</label>
                    <input type="password" id="pass" name="pass" class="form-control" placeholder="Senha" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>

    <?php if (isset($param["responseCode"]) && $param["responseCode"] == ViewResponseCodes::SESSION_EXPIRED) : ?>
        <div class="msgAlertLogin alert alert-danger" role="alert">
            Sessão expirou!
        </div>
    <?php endif ?>

    <?php if (isset($param["responseCode"]) && $param["responseCode"] == ViewResponseCodes::ERROR_INVALIDLOGIN) : ?>
        <div class="msgAlertLogin alert alert-danger" role="alert">
             Nome de usuário ou senha incorretos!
        </div>
    <?php endif ?>

    <?php
    // Mensagens
    if (isset($_GET['error']) && $_GET['error'] == "") {
        echo "<script>
        window.onload = function(){ 
            var msgErro = new MsgBox();
            msgErro.showInLine({_idName: 'msgError', _type: msgErro.SET_TYPE_TEXT('" . substr(RouteController::RootRoute(), 1) . "'), _menssagem: 'Ocorreu um erro não indentificdo.<br>Se o problema persistir, contacte um adminstrador do sistema.', _title: 'Erro', _btnOkName: 'Ok', _btnFecharView: false});
        }
        </script>";
    }

    if (isset($param["responseCode"]) && $param["responseCode"] == ViewResponseCodes::ERROR_CONNECT_API) {
        echo "<script>
        window.onload = function(){ 
            var msgLoginIncorrect = new MsgBox();
            msgLoginIncorrect.showInLine({_idName: 'msgLI', _type: msgLoginIncorrect.SET_TYPE_TEXT('" . substr(RouteController::RootRoute(), 1) . "'), _menssagem: 'Nome de usuário ou senha incorretos!', _title: 'Login inválido!', _btnOkName: 'Ok', _onCloseAction: 'window.location.href = \"" . RouteController::RootRoute() . "/login\";', _btnFecharView: false});
        }
        </script>";
    }
    ?>

</body>

</html>