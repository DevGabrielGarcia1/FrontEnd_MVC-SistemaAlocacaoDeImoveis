<?php

namespace controller;

use generic\Api;
use generic\CUrlRequest;
use generic\ViewResponseCodes;
use service\SessionService;
use view\ImoveisView;

class ImoveisController
{

    public function listImoveis(/*$id = "", $tipo_imovel = "", $id_proprietario = "", $endereco = "", $cidade = "", $estado = "", $CEP = "", $valor_aluguel = "", $max_valor_aluguel = "", $area = "", $max_area = "", $quartos = "", $max_quartos = "", $banheiros = "", $max_banheiros = "", $vagas_garagem = "", $max_vagas_garagem = "", $active = ""*/)
    {

        //Se não estiver logado
        if (!SessionService::isLogued()) {
            //Versão publica

            //return;
        }

        //Verifica token
        SessionService::autoLogoutIFtokenExpired();


        $api =  null;
        $result = [];

        /*/Validar campos preenchidos
        $args = func_get_args();
        $valid = false;
        foreach ($args as $k => $v) {
            if ($k == 0) {
                $valid = ($v == "");
                continue;
            }
            $valid = $valid && ($v == "");
        }*/

        $filters = [
            "id" => "",
            "tipo_imovel" => $_POST['tipo_imovel'] ?? "",
            "id_proprietario" => "",
            "endereco" => $_POST['endereco'] ?? "",
            "cidade" => $_POST['cidade'] ?? "",
            "estado" => $_POST['estado'] ?? "",
            "CEP" => $_POST['CEP'] ?? "",
            "valor_aluguel" => $_POST['valor_aluguel'] ?? "",
            "max_valor_aluguel" => $_POST['max_valor_aluguel'] ?? "",
            "area" => $_POST['area'] ?? "",
            "max_area" => $_POST['max_area'] ?? "",
            "quartos" => $_POST['quartos'] ?? "",
            "max_quartos" => $_POST['max_quartos'] ?? "",
            "banheiros" => $_POST['banheiros'] ?? "",
            "max_banheiros" => $_POST['max_banheiros'] ?? "",
            "vagas_garagem" => $_POST['vagas_garagem'] ?? "",
            "max_vagas_garagem" => $_POST['max_vagas_garagem'] ?? "",
            "active" => ""
        ];

        $valid = false;
        foreach ($filters as $k => $v) {
            if ($k == "id") {
                $valid = ($v == "");
                continue;
            }
            $valid = $valid && ($v == "");
        }

        //Se todos os campos forem vazios
        if ($valid) {
            $api = new CUrlRequest(Api::URLBASE . "imovel/listar/all", SessionService::getToken());
            $result = $api([]);
        } 
        else {
            $api = new CUrlRequest(Api::URLBASE . "imovel/listar", SessionService::getToken());
            $result = $api($filters);
        }
        
        //Validar saida
        if($api->getHttpCode() == 401){
            //Problemas na sessão
            SessionService::sessionLogout();
            header("Location: " . RouteController::RootRoute() . "/login/" . ViewResponseCodes::SESSION_EXPIRED);
            exit();
        }

        $view = new ImoveisView();
        $view->listImoveis($result['retorno']);
    }
}
