<?php

use controller\RouteController;
?>
<body>
    <br><br><br><br>
<?= substr(RouteController::RootRoute(), 1) ?> 
    <script>
        window.onload = function() {
            var msg = new MsgBox();
            msg.showInLine({
                _idName: 'msg1', 
                _type: msg.SET_TYPE_TEXT('<?= substr(RouteController::RootRoute(), 1) ?>'), 
                <?php if(isset($param['message'])): ?>
                    _menssagem: 'Messagem: <?= $param['message'] ?>', 
                <?php endif ?>
                <?php if(isset($param['title'])): ?>
                    _title: '<?= $param['title'] ?>', 
                <?php endif ?>
                _btnOkName: 'Ok', //Não possui erro
                _onCloseAction: 'window.location.href = "<?= RouteController::RootRoute()."/".$param['urlRedirect'] ?>";', 
                _btnFecharView: false});
        }
    </script>
</body>