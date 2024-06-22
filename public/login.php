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

<body>

<div id="formulario1" class="forms">
    <form class="inputforms" action="./loginProcess" method="post">
        <h2> LOGIN</h2>
        <div class="input1">
            <input type="text" name="user" placeholder="Usuario">
        </div>
        <div  class="input2">
            <input type="password" name="pass" placeholder="Senha">
        </div>
        <div class="inputbutton">
            <input id="buttonColor" type="submit" value="Login">
        </div>
    </form>
</div>
</body>

<?php
//Menssagens
if (isset($_GET['error']) && $_GET['error'] == "") {
    echo "<script>
        window.onload = function(){ 
            var msgErro = new MsgBox();
            msgErro.showInLine({_idName: 'msgError', _type: msgErro.SET_TYPE_TEXT('" . substr(RouteController::RootRoute(), 1) . "'), _menssagem: 'Ocorreu um erro não indentificdo.<br>Se o problema persistir, contacte um adminstrador do sistema.', _title: 'Erro', _btnOkName: 'Ok', _btnFecharView: false});
        }
        </script>";
}

if (isset($_GET['error']) && $_GET['error'] == ViewResponseCodes::ERROR_INVALIDLOGIN) {
    echo "<script>
        window.onload = function(){ 
            var msgLoginIncorrect = new MsgBox();
            msgLoginIncorrect.showInLine({_idName: 'msgLI', _type: msgLoginIncorrect.SET_TYPE_TEXT('" . substr(RouteController::RootRoute(), 1) . "'), _menssagem: 'Nome de usuário ou senha incorretos!', _title: 'Login inválido!', _btnOkName: 'Ok', _onCloseAction: 'window.location.href = \"".RouteController::RootRoute()."/\";', _btnFecharView: false});
        }
        </script>";
}
?>

</html>