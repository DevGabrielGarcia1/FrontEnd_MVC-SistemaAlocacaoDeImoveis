<?php

use controller\RouteController;
use generic\Utils;
use generic\ViewResponseCodes;

$proprietarios = $param['listProprietarios'];

$filtros = [
    'nome' => $_POST['nome'] ?? "",
    'CPF' => $_POST['CPF'] ?? "",
];
?>
<head>
    <link rel="stylesheet" href="<?= RouteController::RootRoute(); ?>/proprietarios/listPropriearios.css.php">
</head>
<body>
    <div class="container mt-5 pt-5">
        <div class="row mb-4">
            <div class="col-md-12 d-flex justify-content-between align-items-center">
                <h1 class="display-5">Proprietários</h1>
                <a href="<?= RouteController::RootRoute() ?>/proprietario/add"><button class="btn btn-success btn-add">Adicionar Proprietário</button></a>
            </div>
        </div>

        <!-- Formulário de Filtros de Pesquisa -->
        <form class="row g-3 mb-5" method="post">
            <div class="col-md-6">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?= htmlspecialchars($filtros['nome']); ?>">
            </div>
            <div class="col-md-6">
                <label for="CPF" class="form-label">CPF</label>
                <input type="text" class="form-control" id="CPF" name="CPF" value="<?= htmlspecialchars($filtros['CPF']); ?>">
            </div>
            <div class="col-md-12 mt-3 text-end">
                <button type="submit" class="btn btn-primary">Pesquisar</button>
            </div>
        </form>

        <?php if (!isset($proprietarios['code'])) : ?>
        <!-- Lista de Proprietários -->
        <div class="row">
            <?php foreach ($proprietarios as $proprietario): ?>
                <div class="col-md-12 mb-3">
                    <div class="card">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title"><?= htmlspecialchars($proprietario['nome']); ?></h5>
                                <p class="card-text"><strong>CPF:</strong> <?= htmlspecialchars($proprietario['CPF']); ?></p>
                                <p class="card-text"><strong>Data de Nascimento:</strong> <?= htmlspecialchars(Utils::convertDate($proprietario['data_nascimento'])->format("d/m/Y")); ?></p>
                                <p class="card-text"><strong>Telefone:</strong> <?= htmlspecialchars($proprietario['telefone']); ?></p>
                                <p class="card-text"><strong>Email:</strong> <?= htmlspecialchars($proprietario['email']); ?></p>
                            </div>
                            <div>
                                <a href="<?= RouteController::RootRoute() ?>/proprietario/edit/<?= $proprietario['id'] ?>" class="btn btn-outline-light"><img src="<?= RouteController::RootRoute(); ?>/public/imgs/editar.png" style="max-width: 25px; max-height: 25px;"></img></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php else : ?>
            <div class="row mb-4">
                <div class="col-md-12">
                    <h3 class="text-center"><?= $proprietarios['message'] ?></h3>
                </div>
            </div>
        <?php endif ?>
        
        <!-- Se não encontrar nada -->
        <?php if (count($proprietarios) == 0) : ?>
            <div class="row mb-4">
                <div class="col-md-12">
                    <h4 class="text-center">Nenhum resultado encontrado!</h4>
                </div>
            </div>
        <?php endif ?>
    </div>

    <!-- Menssagem de retorno -->
    <?php if (isset($param["responseCode"]) && $param["responseCode"] == ViewResponseCodes::SUCCESS_OPERATION) : ?>
        <div class="msgAlert alert alert-success" role="alert">
            Operação concluída com sucesso!
        </div>
    <?php endif ?>
    <?php if (isset($param["responseCode"]) && $param["responseCode"] == ViewResponseCodes::ERRO_RETORNO_VAZIO) : ?>
        <div class="msgAlert alert alert-danger" role="alert">
            Erro ao buscar dados!
        </div>
    <?php endif ?>
</body>