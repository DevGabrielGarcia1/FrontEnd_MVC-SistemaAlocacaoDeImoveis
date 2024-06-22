<?php

use controller\RouteController;

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= RouteController::RootRoute(); ?>/public/bootstrap/css/bootstrap.css">
    <title>Pagina não encontrada</title>
</head>
<body class="bg-light d-flex flex-column justify-content-center align-items-center" style="height: 100vh;">
    <div class="text-center">
        <h1 class="display-1">404</h1>
        <h2 class="mb-4">Página não foi encontrada</h2>
        <p class="lead">Desculpe, a página que você está procurando não existe.</p>
        <a href="<?= RouteController::RootRoute(); ?>" class="btn btn-primary mt-3">Voltar para a página inicial</a>
    </div>
</body>
</html>
