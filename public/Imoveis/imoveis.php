<?php

use controller\RouteController;
use generic\ViewResponseCodes;
use service\SessionService;

$logued = SessionService::isLogued();

?>

<body>

    <div class="container mt-5 pt-5">
        <div class="row mb-4">
            <div class="col-md-12">
                <h1 class="display-5 text-center">Pesquisa de Imóveis</h1>
            </div>
        </div>

        <!-- Formulário de Filtros de Pesquisa -->
        <form class="row g-3 mb-5" method="post">
            <div class="col-md-3">
                <label for="tipo_imovel" class="form-label">Tipo de Imóvel</label>
                <input type="text" class="form-control" id="tipo_imovel" name="tipo_imovel" value="<?= htmlspecialchars($_POST['tipo_imovel'] ?? ""); ?>">
            </div>
            <div class="col-md-3">
                <label for="endereco" class="form-label">Endereço</label>
                <input type="text" class="form-control" id="endereco" name="endereco" value="<?= htmlspecialchars($_POST['endereco'] ?? ""); ?>">
            </div>
            <div class="col-md-2">
                <label for="cidade" class="form-label">Cidade</label>
                <input type="text" class="form-control" id="cidade" name="cidade" value="<?= htmlspecialchars($_POST['cidade'] ?? ""); ?>">
            </div>
            <div class="col-md-2">
                <label for="estado" class="form-label">Estado</label>
                <input type="text" class="form-control" id="estado" name="estado" value="<?= htmlspecialchars($_POST['estado'] ?? ""); ?>">
            </div>
            <div class="col-md-2">
                <label for="CEP" class="form-label">CEP</label>
                <input type="text" class="form-control" id="CEP" name="CEP" value="<?= htmlspecialchars($_POST['CEP'] ?? ""); ?>">
            </div>
            <div class="col-md-2">
                <label for="valor_aluguel" class="form-label">Valor Aluguel</label>
                <input type="text" class="form-control" id="valor_aluguel" name="valor_aluguel" value="<?= htmlspecialchars($_POST['valor_aluguel'] ?? ""); ?>">
            </div>
            <div class="col-md-2">
                <label for="max_valor_aluguel" class="form-label">Valor Máximo Aluguel</label>
                <input type="text" class="form-control" id="max_valor_aluguel" name="max_valor_aluguel" value="<?= htmlspecialchars($_POST['max_valor_aluguel'] ?? ""); ?>">
            </div>
            <div class="col-md-2">
                <label for="area" class="form-label">Área</label>
                <input type="text" class="form-control" id="area" name="area" value="<?= htmlspecialchars($_POST['area'] ?? ""); ?>">
            </div>
            <div class="col-md-2">
                <label for="max_area" class="form-label">Área Máxima</label>
                <input type="text" class="form-control" id="max_area" name="max_area" value="<?= htmlspecialchars($_POST['max_area'] ?? ""); ?>">
            </div>
            <div class="col-md-2">
                <label for="quartos" class="form-label">Quartos</label>
                <input type="text" class="form-control" id="quartos" name="quartos" value="<?= htmlspecialchars($_POST['quartos'] ?? ""); ?>">
            </div>
            <div class="col-md-2">
                <label for="max_quartos" class="form-label">Máximo de Quartos</label>
                <input type="text" class="form-control" id="max_quartos" name="max_quartos" value="<?= htmlspecialchars($_POST['max_quartos'] ?? ""); ?>">
            </div>
            <div class="col-md-2">
                <label for="banheiros" class="form-label">Banheiros</label>
                <input type="text" class="form-control" id="banheiros" name="banheiros" value="<?= htmlspecialchars($_POST['banheiros'] ?? ""); ?>">
            </div>
            <div class="col-md-2">
                <label for="max_banheiros" class="form-label">Máximo de Banheiros</label>
                <input type="text" class="form-control" id="max_banheiros" name="max_banheiros" value="<?= htmlspecialchars($_POST['max_banheiros'] ?? ""); ?>">
            </div>
            <div class="col-md-2">
                <label for="vagas_garagem" class="form-label">Vagas de Garagem</label>
                <input type="text" class="form-control" id="vagas_garagem" name="vagas_garagem" value="<?= htmlspecialchars($_POST['vagas_garagem'] ?? ""); ?>">
            </div>
            <div class="col-md-3">
                <label for="max_vagas_garagem" class="form-label">Máximo de Vagas de Garagem</label>
                <input type="text" class="form-control" id="max_vagas_garagem" name="max_vagas_garagem" value="<?= htmlspecialchars($_POST['max_vagas_garagem'] ?? ""); ?>">
            </div>
            <div class="col-md-3 mt-3 text-end">
                <button type="submit" class="btn btn-primary" style="margin-top: 30px;">Pesquisar</button>
            </div>
        </form>

        <!-- Resultados da Pesquisa -->
        <?php if (!isset($param["listImoveis"]['code'])) : ?>
            <div class="row">
                <?php foreach ($param["listImoveis"] as $imovel) : ?>
                    <div class="col-md-4 mb-4">
                        <div class="card card-custom">
                            <div class="card-body">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <h5 class="card-title"><?= htmlspecialchars($imovel['tipo_imovel']); ?></h5>
                                    <?php if ($logued) : ?>
                                        <a href="<?= RouteController::RootRoute() ?>/imovel/edit/<?= $imovel['id'] ?>" class="btn btn-outline-light edit-button">
                                            <img src="<?= RouteController::RootRoute(); ?>/public/imgs/editar.png" style="max-width: 20px; max-height: 20px;">
                                        </a>
                                    <?php endif ?>
                                </div>
                                <p class="card-text"><?= htmlspecialchars($imovel['endereco']); ?>, <?= htmlspecialchars($imovel['cidade']); ?> - <?= htmlspecialchars($imovel['estado']); ?></p>
                                <?php if ($logued) : ?>
                                    <p class="card-text"><strong>Proprietário:</strong> <?= htmlspecialchars($imovel['nomeProprietario']); ?></p>
                                <?php endif ?>
                                <p class="card-text"><strong>CEP:</strong> <?= htmlspecialchars($imovel['CEP']); ?></p>
                                <p class="card-text"><strong>Valor do Aluguel:</strong> R$ <?= htmlspecialchars($imovel['valor_aluguel']); ?></p>
                                <p class="card-text"><strong>Área:</strong> <?= htmlspecialchars($imovel['area']); ?> m²</p>
                                <p class="card-text"><strong>Quartos:</strong> <?= htmlspecialchars($imovel['quartos']); ?></p>
                                <p class="card-text"><strong>Banheiros:</strong> <?= htmlspecialchars($imovel['banheiros']); ?></p>
                                <p class="card-text"><strong>Vagas de Garagem:</strong> <?= htmlspecialchars($imovel['vagas_garagem']); ?></p>
                                <?php if ($logued) : ?>
                                    <p class="card-text"><strong>Ativo:</strong> <?= $imovel['active'] ? 'Sim' : 'Não'; ?></p>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <div class="row mb-4">
                <div class="col-md-12">
                    <h3 class="text-center"><?= $param['listImoveis']['message'] ?></h3>
                    <p class="text-center">Campos de valor máximo não devem ser preenchidos sem um valor inicial</p>
                </div>
            </div>
        <?php endif ?>


        <!-- Se não encontrar nada -->
        <?php if (count($param['listImoveis']) == 0) : ?>
            <div class="row mb-4">
                <div class="col-md-12">
                    <h4 class="text-center">Nenhum resultado encontrado!</h4>
                </div>
            </div>
        <?php endif ?>
    </div>

</body>