<?php

use controller\RouteController;
use generic\ViewResponseCodes;

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?= RouteController::RootRoute(); ?>/public/bootstrap/css/bootstrap.css">
    <script src="<?= RouteController::RootRoute(); ?>/public/msgBox.js"></script>
    <link rel="stylesheet" href="<?= RouteController::RootRoute(); ?>/public/style.css">
    <link rel="stylesheet" href="<?= RouteController::RootRoute(); ?>/public/login.css">
    <script src="<?= RouteController::RootRoute(); ?>/public/msgBox.js"></script>
</head>

<body class="bg-light">

<div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="card p-4 shadow-sm" style="width: 100%; max-width: 400px;">
        <h2 class="text-center mb-4">LOGIN</h2>
        <form action="./login/process" method="post">
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

if (isset($param["responseCode"]) && $param["responseCode"] == ViewResponseCodes::ERROR_INVALIDLOGIN) {
    echo "<script>
        window.onload = function(){ 
            var msgLoginIncorrect = new MsgBox();
            msgLoginIncorrect.showInLine({_idName: 'msgLI', _type: msgLoginIncorrect.SET_TYPE_TEXT('" . substr(RouteController::RootRoute(), 1) . "'), _menssagem: 'Nome de usuário ou senha incorretos!', _title: 'Login inválido!', _btnOkName: 'Ok', _onCloseAction: 'window.location.href = \"".RouteController::RootRoute()."/login\";', _btnFecharView: false});
        }
        </script>";
}
?>

</body>
</html>
