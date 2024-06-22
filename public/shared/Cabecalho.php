<?php

use controller\RouteController;
use service\SessionService;

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= RouteController::RootRoute(); ?>/public/bootstrap/css/bootstrap.css">
    <title>
        <?php if(isset($param["titleTabPage"])){ 
                echo $param["titleTabPage"]; 
            } else { ?>
            Imobiliária
        <?php } ?>
    </title>
    <link rel="icon" type="image/x-icon" href="<?= RouteController::RootRoute(); ?>/imgs/icon.ico" sizes="96x96">
</head>
<body>
    <!-- Menu Superior Fixado -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <!-- Ícone de Logo -->
            <a class="navbar-brand" href="<?= RouteController::RootRoute(); ?>">
                <img src="<?= RouteController::RootRoute(); ?>/public/imgs/logo2.png" alt="Logo" width="30" height="30" class="d-inline-block align-top">
                Imobiliária
            </a>
            <!-- Botão para dispositivos móveis -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Links de navegação -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= RouteController::RootRoute(); ?>/imoveis">Imóveis</a>
                    </li>
                    <?php if(SessionService::isLogued()): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= RouteController::RootRoute(); ?>/proprietarios">Proprietários</a>
                        </li>
                    <?php endif ?>
                </ul>
                <!-- Menu de usuário -->
                <ul class="navbar-nav ms-auto">
                    <?php if(SessionService::isLogued()): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?= RouteController::RootRoute(); ?>/public/imgs/user1.png" alt="User Icon" width="30" height="30" class="d-inline-block align-top me-2">
                            <?= SessionService::getName() ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="<?= RouteController::RootRoute(); ?>/perfil">Perfil</a></li>
                            <li><a class="dropdown-item" href="<?= RouteController::RootRoute(); ?>/configuracoes">Configurações</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?= RouteController::RootRoute(); ?>/logout">Logout</a></li>
                        </ul>
                    </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link btn btn-light" href="<?= RouteController::RootRoute(); ?>/login">Login</a>
                        </li>
                    <?php endif ?>
                </ul>
            </div>
        </div>
    </nav>

    <script src="<?= RouteController::RootRoute(); ?>/public/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
