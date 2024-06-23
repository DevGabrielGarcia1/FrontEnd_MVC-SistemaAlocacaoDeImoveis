<?php

namespace generic;

class Chamadas
{
    private $arrChamadas = [];
    public function __construct()
    {
        $this->arrChamadas = [
            //Raiz
            "" => new Acao("controller\ImoveisController", "listImoveis"),

            //Login
            "login" => new Acao("controller\LoginController", "login"),
            "login/:responseCode" => new Acao("controller\LoginController", "login"),
            "login/process" => new Acao("controller\LoginController", "validarLogin"),
            "logout" => new Acao("controller\LoginController", "logout"),

            //Home
            "home" => new Acao("controller\\RouteController", "redirectTo", ["url" => "./imoveis"]),

            //Imovel
            "imoveis" => new Acao("controller\ImoveisController", "listImoveis"),
            "imoveis/listar" => new Acao("controller\ImoveisController", "listImoveis"),
            
            //Proprietario
            "proprietarios" => new Acao("controller\\RouteController", "redirectTo", ["url" => "./proprietarios/listar"]),
            "proprietarios/listar" => new Acao("controller\ProprietariosController", "listProprietarios"),
            "proprietarios/listar/:responseCode" => new Acao("controller\ProprietariosController", "listProprietarios"),

            "proprietario/add" => new Acao("controller\ProprietariosController", "addProprietario"),
            "proprietario/add/:responseCode" => new Acao("controller\ProprietariosController", "addProprietario"),
            "proprietario/add/process" => new Acao("controller\ProprietariosController", "addProprietarioProcess"),

            "proprietario/edit/:id" => new Acao("controller\ProprietariosController", "editProprietario"),
            "proprietario/edit/:id/:responseCode" => new Acao("controller\ProprietariosController", "editProprietario"),
            "proprietario/edit/process" => new Acao("controller\ProprietariosController", "editProprietarioProcess"),
            
            

            
        ];
    }

    public function buscarRotas($endpoint)
    {
        //Remove a ultima barra caso tenha
        if($endpoint[-1] == '/'){
            $endpoint = substr($endpoint,0,-1);
        }

        //Verifica se a rota existe
        if (isset($this->arrChamadas[$endpoint])) {
            return   $this->arrChamadas[$endpoint];
        }

        //Verificar paramentros na url
        $splitEndPoint = explode('/', trim($endpoint, '/'));
        foreach ($this->arrChamadas as $k => $v) {
            $split = explode("/", trim($k, "/"));
            if(count($splitEndPoint) <= count($split)){
                $find = false;
                $param = [];
                for ($i=0; $i < count($splitEndPoint); $i++) { 
                    if($splitEndPoint[$i] != $split[$i] && !str_contains($split[$i], ":")){
                        $find = false;
                        break;
                    }
                    if(str_contains($split[$i], ":")){
                        $param[trim($split[$i], ":")] = $splitEndPoint[$i];
                    }
                    $find = true;
                }
                if($find){
                    $this->arrChamadas[$k]->setParam($param);
                    return $this->arrChamadas[$k];
                }
            }
        }


        return new Acao("controller\Page404Controller", "page404");
    }
}
