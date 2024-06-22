<?php

namespace controller;

use service\SessionService;
use view\loginView;

class LoginController {

    public function login(){
        if(SessionService::isLogued()){
            header("location: produtos/lista");
            return;
        }

        $view = new loginView();
        $view->login();
    }

    public function validarLogin(){
        $user = $_POST['user'];
        $pass = $_POST['pass'];

        try {
            $service = new SessionService();
            $return = $service->buscarUser($user);
        } catch (\Throwable $th) {
            header("location: ".RouteController::RootRoute()."/login?error=".ERROR_CONNECT_DB);
        }

        if(sizeof($return) > 0 && $return[0]["nome"] === $user && $return[0]["senha"] === $pass){
            //Logado com sucesso
            if(!SessionService::session_start()){
                SessionService::sessionLogout();
                session_start();
            }

            $_SESSION[SESSION_USERID] = $return[0]["id"];
            $_SESSION[SESSION_USERNAME] = $return[0]["nome"];
            header("location: produtos/lista");
            return;
        }

        //Falha no login
        SessionService::sessionLogout();
        header("location: login?error=".ERROR_INVALIDLOGIN);
    }

    public function logout(){
        SessionService::sessionLogout();
        header("location: login");
    }

}