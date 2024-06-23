<?php

namespace generic;

class Chamadas
{
    private $arrChamadas = [];
    public function __construct()
    {
        $this->arrChamadas = [
            "" => new Acao("controller\ImoveisController", "listImoveis"),
            "login" => new Acao("controller\LoginController", "login"),
            "login/:responseCode" => new Acao("controller\LoginController", "login"),
            "login/process" => new Acao("controller\LoginController", "validarLogin"),
            "logout" => new Acao("controller\LoginController", "logout"),
            "home" => new Acao("controller\\RouteController", "redirectTo", ["url" => "./imoveis"]),
            "imoveis" => new Acao("controller\ImoveisController", "listImoveis"),
            "imoveis/listar" => new Acao("controller\ImoveisController", "listImoveis"),
            //"imoveis/:tipo_imovel/:endereco/:cidade/:estado/:CEP/:valor_aluguel/:max_valor_aluguel/:area/:max_area/:quartos/:max_quartos/:banheiros/:max_banheiros/:vagas_garagem/:max_vagas_garagem" => new Acao("controller\ImoveisController", "listImoveis"),
            "proprietarios" => new Acao("controller\ImoveisController", "listImoveis"),
            

            
        ];
    }

    public function buscarRotas($endpoint)
    {
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


        return null;
    }
}
