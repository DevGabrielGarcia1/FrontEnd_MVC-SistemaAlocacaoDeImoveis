<?php

namespace controller;

use generic\Api;
use generic\CUrlRequest;
use service\SessionService;
use view\loginView;

class LoginController {

    public function login($responseCode = 0){
        if(SessionService::isLogued()){
            header("location: ".RouteController::RootRoute()."/home");
            return;
        }

        $view = new loginView();
        $view->login($responseCode);
    }


    public function validarLogin(){
        $user = $_POST['user'];
        $pass = $_POST['pass'];

        $api = new CUrlRequest(Api::URLBASE."usuario/autenticar");
        $return = $api([
            "username" => $user,
            "senha" => $pass
        ]);

        //Se login falhar
        if(isset($return['retorno']['code'])){
            header("Location: ".RouteController::RootRoute()."/login/".$return['retorno']['code']);
            return;
        }
        
        //Se já existir uma sessão
        if(SessionService::isLogued()){
            SessionService::sessionLogout();
        }
        
        SessionService::sessionStart();

        if(!isset($return['retorno'])){
            header("Location: ".RouteController::RootRoute()."/login/0");
            return;
        }
        SessionService::setSession($return['retorno']);

        //Redirecionar
        header("location: ".RouteController::RootRoute()."/home");
    }

    public function logout(){
        SessionService::sessionLogout();
        header("location: ".RouteController::RootRoute());
    }

}