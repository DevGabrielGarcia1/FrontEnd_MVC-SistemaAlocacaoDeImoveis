<?php 
namespace controller;

use generic\Api;
use generic\CUrlRequest;
use generic\ViewResponseCodes;
use service\SessionService;
use view\MessageView;
use view\ProprietariosView;

class proprietariosController {

    public function listProprietarios($responseCode = 0){

        //Virifica se está logado
        SessionService::autoRedirectLoginIFNotLogued();

        //Verifica token
        SessionService::autoLogoutIFtokenExpired();


        $api = null;

        //Recuperar filtros
        $filtros = [
            "id" => "",
            "nome" => $_POST['nome'] ?? "",
            "CPF" => $_POST['CPF'] ?? ""
        ];

        //Verificar filtros
        $empty = false;
        foreach ($filtros as $k => $v)   {
            if($k == "nome"){
                $empty = ($v == "");
            }
            $empty &= ($v == "");
        }

        //Se todos os campos vazios, buscar todos
        if($empty){
            $api = new CUrlRequest(Api::URLBASE."proprietario/listar/all", SessionService::getToken());
        }else{
            $api = new CUrlRequest(Api::URLBASE."proprietario/listar", SessionService::getToken());
        }

        //Busca os dados
        $result = $api($filtros);

        //valida http code
        if($api->getHttpCode() == 401){
            //Problemas na sessão
            SessionService::sessionLogout();
            header("Location: " . RouteController::RootRoute() . "/login/" . ViewResponseCodes::SESSION_EXPIRED);
            exit();
        }

        $view = new ProprietariosView();
        $view->listarProprietarios($result["retorno"], $responseCode);

    }

    public function addProprietario($responseCode = 0){

        //Virifica se está logado
        SessionService::autoRedirectLoginIFNotLogued();

        //Verifica token
        SessionService::autoLogoutIFtokenExpired();

        //Recupera dados via post para auto preenchimento
        $proprietario = [
            "nome" => $_POST['nome'] ?? "", 
            "CPF" => $_POST['CPF'] ?? "", 
            "data_nascimento" => $_POST['data_nascimento'] ?? "", 
            "telefone" => $_POST['telefone'] ?? "", 
            "email" => $_POST['email'] ?? ""
        ];

        $view = new ProprietariosView();
        $view->addProprietario($proprietario, $responseCode);
        

    }

    public function addProprietarioProcess(){
        
        //Virifica se está logado
        SessionService::autoRedirectLoginIFNotLogued();

        //Verifica token
        SessionService::autoLogoutIFtokenExpired();

        $params = [
            "nome" => $_POST['nome'] ?? "", 
            "CPF" => $_POST['CPF'] ?? "", 
            "data_nascimento" => $_POST['data_nascimento'] ?? "", 
            "telefone" => $_POST['telefone'] ?? "", 
            "email" => $_POST['email'] ?? ""
        ];

        $api = new CUrlRequest(Api::URLBASE."proprietario/cadastrar", SessionService::getToken());

        $result = $api($params);

        if($api->getHttpCode() == 401){
            //Problemas na sessão
            SessionService::sessionLogout();
            header("Location: " . RouteController::RootRoute() . "/login/" . ViewResponseCodes::SESSION_EXPIRED);
            exit();
        }
        
        if (isset($result["retorno"]['code']) && $result["retorno"]['code'] > 100) {
            /*$view = new MessageView();
            $view->showMessage([
                "title" => "Erro ao salvar dados!",
                "message" => $result['retorno']['message'],
                "urlRedirect" => "proprietario/add"
            ]);*/
            //Voltar para tela de adicionar
            RouteController::redirectPost(RouteController::RootRoute()."/proprietario/add/".$result["retorno"]['code'], $params);
        }

        header("Location: " . RouteController::RootRoute() . "/proprietarios/listar/" . ViewResponseCodes::SUCCESS_OPERATION);
    }

    public function editProprietario($id, $responseCode = 0){

        //Virifica se está logado
        SessionService::autoRedirectLoginIFNotLogued();

        //Verifica token
        SessionService::autoLogoutIFtokenExpired();

        //Busca os dados na api
        $api = new CUrlRequest(Api::URLBASE."proprietario/listar", SessionService::getToken());
        $result = $api([
            "id" => $id, 
            "nome" => "", 
            "CPF" => ""
        ]);

        //Valida busca
        if($api->getHttpCode() == 401){
            //Problemas na sessão
            SessionService::sessionLogout();
            header("Location: " . RouteController::RootRoute() . "/login/" . ViewResponseCodes::SESSION_EXPIRED);
            exit();
        }
        
        if (isset($result["retorno"]['code']) && $result["retorno"]['code'] > 100) {
            header("Location: ".RouteController::RootRoute()."/proprietarios/listar/".$result["retorno"]['code']);
        }

        //Valida se não é vazio
        if(count($result['retorno']) == 0){
            header("Location: ".RouteController::RootRoute()."/proprietarios/listar/".$result["retorno"]['code']);
        }

        $proprietario = $result['retorno'][0];

        $view = new ProprietariosView();
        $view->editProprietario($proprietario, $responseCode);
        

    }

    public function editProprietarioProcess(){
        
        //Virifica se está logado
        SessionService::autoRedirectLoginIFNotLogued();

        //Verifica token
        SessionService::autoLogoutIFtokenExpired();

        $params = [
            "id" => $_POST['id'] ?? "",
            "nome" => $_POST['nome'] ?? "", 
            "CPF" => $_POST['CPF'] ?? "", 
            "data_nascimento" => $_POST['data_nascimento'] ?? "", 
            "telefone" => $_POST['telefone'] ?? "", 
            "email" => $_POST['email'] ?? ""
        ];

        $api = new CUrlRequest(Api::URLBASE."proprietario/editar", SessionService::getToken());

        $result = $api($params);

        if($api->getHttpCode() == 401){
            //Problemas na sessão
            SessionService::sessionLogout();
            header("Location: " . RouteController::RootRoute() . "/login/" . ViewResponseCodes::SESSION_EXPIRED);
            exit();
        }
        
         if (isset($result["retorno"]['code']) && $result["retorno"]['code'] > 100) {
            header("Location: ".RouteController::RootRoute()."/proprietario/edit/".$params['id']."/".$result["retorno"]['code']);
        }

        header("Location: " . RouteController::RootRoute() . "/proprietarios/listar/" . ViewResponseCodes::SUCCESS_OPERATION);
    }

}

?>