<?php

use generic\Controller;

include_once "generic/AutoLoad.php";

if(!isset($_GET['param'])){
    $_GET['param'] = "";
}
//if(isset($_GET['param'])){
    $controller = Controller::getInstance();
    $controller->executarRotas($_GET['param']);
//}