<?php

use controller\RouteController;
use generic\ViewResponseCodes;
use service\SessionService;

$proprietario = $param["proprietario"] ?? null;

$modoEdicao = $param["editMode"] ?? false;

// Mensagen de confirmação
if ($modoEdicao) {
    echo "<script>
    window.onload = function(){ 
    }
    function msgConfirm(){
        var msgConfirm = new MsgBox();
        msgConfirm.showInLine({_idName: 'msgConfir', _type: msgConfirm.SET_TYPE_TEXT('" . substr(RouteController::RootRoute(), 1) . "'), _menssagem: 'Confirmar alteração de dados?', _title: 'Editar', _btnOkName: 'Sim', _btnCancelName: 'Não', _btnOkAction: 'document.getElementById(\"ed1\").submit();', _btnFecharView: false, _autoDestroy: true});
    }   
    </script>";
}

?>
<body>
    <div class="container mt-5 pt-5">
        <div class="row mb-4">
            <div class="col-md-12">
                <h1 class="display-5"><?= $modoEdicao ? 'Editar Proprietário' : 'Adicionar Proprietário' ?></h1>
            </div>
        </div>

        <!-- Formulário de Adicionar/Editar Proprietário -->
        <?php if (!$modoEdicao): ?>
        <form action="<?= RouteController::RootRoute() ?>/proprietario/add/process" method="post">
        <?php endif; ?>
            <?php if ($modoEdicao): ?>
                <form id="ed1" action="<?= RouteController::RootRoute() ?>/proprietario/edit/process" method="post">
                <div class="mb-3">
                    <label for="id" class="form-label">ID</label>
                    <input type="text" class="form-control" id="id" name="id" value="<?= htmlspecialchars($proprietario['id'] ?? ""); ?>" readonly>
                </div>
            <?php endif; ?>
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?= htmlspecialchars($proprietario['nome'] ?? ""); ?>" required>
            </div>
            <div class="mb-3">
                <label for="CPF" class="form-label">CPF</label>
                <input type="text" class="form-control" id="CPF" name="CPF" value="<?= htmlspecialchars($proprietario['CPF'] ?? ""); ?>" required>
            </div>
            <div class="mb-3">
                <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" value="<?= htmlspecialchars($proprietario['data_nascimento'] ?? ""); ?>" required>
            </div>
            <div class="mb-3">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="text" class="form-control" id="telefone" name="telefone" value="<?= htmlspecialchars($proprietario['telefone'] ?? ""); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($proprietario['email'] ?? ""); ?>" required>
            </div>
            <?php if(!$modoEdicao): ?>
            <div class="mb-3 text-end">
                <a href="<?= RouteController::RootRoute() ?>/proprietarios/listar"><span class="btn btn-danger">Cancelar</span></a>
                <button type="submit" class="btn btn-primary">Adicionar Proprietário</button>
            </div>
        <?php endif ?>
        </form>
        <?php if($modoEdicao): ?>
            <div class="mb-3 text-end">
                <a href="<?= RouteController::RootRoute() ?>/proprietarios/listar"><span class="btn btn-danger">Cancelar</span></a>
                <button onclick="msgConfirm()" class="btn btn-primary">Salvar Alterações</button>
            </div>
        <?php endif ?>
        
    </div>

    <?php
        //Menssagens
        if (isset($param["responseCode"]) && $param["responseCode"] == ViewResponseCodes::ERROR_CAMPOS_OBRIGATORIOS) {
            echo "<script>
            window.onload = function(){ 
                var msgObr = new MsgBox();
                msgObr.showInLine({_idName: 'msgObri', _type: msgObr.SET_TYPE_TEXT('" . substr(RouteController::RootRoute(), 1) . "'), _menssagem: 'Campos obrigatórios não preenchidos!', _title: 'Erro', _btnOkName: 'Ok', _btnFecharView: false});
            }
            </script>";
        }

    ?>

</body>