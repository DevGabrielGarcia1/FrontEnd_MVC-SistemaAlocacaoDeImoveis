<?php

use controller\RouteController;
?>
.btn-edit {
    background: url('<?= RouteController::RootRoute(); ?>/public/icons/edit-icon.png') no-repeat center;
    background-size: contain;
    width: 24px;
    height: 24px;
    border: none;
    cursor: pointer;
}
.btn-add {
    margin-bottom: 20px;
}