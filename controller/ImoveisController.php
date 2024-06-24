<?php

namespace controller;

use generic\Api;
use generic\CUrlRequest;
use generic\ViewResponseCodes;
use service\SessionService;
use view\ImoveisView;
use view\Page404View;
use view\Page500View;

class ImoveisController
{

    public function listImoveis()
    {

        //Se não estiver logado
        if (!SessionService::isLogued()) {
            //Versão publica
            $this->publicListImoveis();
            return;
        }

        //Verifica token
        SessionService::autoLogoutIFtokenExpired();


        $api =  null;
        $result = [];

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

        $empty = false;
        foreach ($filters as $k => $v) {
            if ($k == "id") {
                $empty = ($v == "");
                continue;
            }
            $empty = $empty && ($v == "");
        }

        //Se todos os campos forem vazios
        if ($empty) {
            $api = new CUrlRequest(Api::URLBASE . "imovel/listar/all", SessionService::getToken());
            $result = $api();
        } else {
            $api = new CUrlRequest(Api::URLBASE . "imovel/listar", SessionService::getToken());
            $result = $api($filters);
        }

        //Validar saida
        if ($api->getHttpCode() == 401) {
            //Problemas na sessão
            SessionService::sessionLogout();
            header("Location: " . RouteController::RootRoute() . "/login/" . ViewResponseCodes::SESSION_EXPIRED);
            exit();
        }

        //Buscar dados do proprietario e mesclar
        $api = new CUrlRequest(Api::URLBASE . "proprietario/listar", SessionService::getToken());
        foreach ($result['retorno'] as $k => $v) {
            $resultP = $api([
                "id" => $v['id_proprietario'],
                "nome" => "",
                "CPF" => ""
            ]);

            //Validar saida
            if ($api->getHttpCode() == 401) {
                //Problemas na sessão
                SessionService::sessionLogout();
                header("Location: " . RouteController::RootRoute() . "/login/" . ViewResponseCodes::SESSION_EXPIRED);
                exit();
            }
            
            $result['retorno'][$k]['nomeProprietario'] = $resultP['retorno'][0]['nome'];
        }


        $view = new ImoveisView();
        $view->listImoveis($result['retorno']);
    }

    private function publicListImoveis()
    {

        $api =  null;
        $result = [];

        $filters = [
            "tipo_imovel" => $_POST['tipo_imovel'] ?? "",
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
            "max_vagas_garagem" => $_POST['max_vagas_garagem'] ?? ""
        ];

        $empty = false;
        foreach ($filters as $k => $v) {
            if ($k == "tipo_imovel") {
                $empty = ($v == "");
                continue;
            }
            $empty = $empty && ($v == "");
        }

        //Se todos os campos forem vazios
        if ($empty) {
            $api = new CUrlRequest(Api::URLBASE . "public/imovel/listar/all");
            $result = $api([], CUrlRequest::GET);
        } else {
            $api = new CUrlRequest(Api::URLBASE . "public/imovel/listar");
            $result = $api($filters, CUrlRequest::GET);
        }

        //Validar saida
        if ($api->getHttpCode() == 401) {
            $view = new Page500View();
            $view->page500();
            exit();
        }

        $view = new ImoveisView();
        $view->listImoveis($result['retorno']);
    }
}
