<?php

namespace generic;

use Exception;
use ReflectionMethod;

class Acao
{
    private $classe;
    private $metodo;

    public function __construct($classe, $metodo)
    {
        $this->classe = $classe;
        $this->metodo = $metodo;
    }

    public function executar($param = [])
    {
        try {
            
            $return = null;
            $obj = new $this->classe();

            $reflectM = new ReflectionMethod($obj::class, $this->metodo);
            $param = $this->verificaParametros($reflectM, $param);

            if ($param) {
                $return = $this->invocarMetodos($reflectM, $obj, $param);
            }
        } catch (Exception $e) {
            http_response_code(500);
            $r = new Retorno();
            $r->retorno = "Error ".$e->getMessage();
            echo json_encode($r);
            return "error";
        }
    }

    private function invocarMetodos($reflect, $obj, $param)
    {
        if ($param === true) {
            return  $reflect->invoke($obj);
        }
        
        return  $reflect->invokeArgs($obj, $param);
    }

    private function verificaParametros(ReflectionMethod $reflectM, $parametros)
    {

        $param = [];
        $reflecP = $reflectM->getParameters();
        if (sizeof($reflecP)) {
            foreach ($reflecP as $v) {
                $name = $v->getName();

                if (!isset($parametros[$name])) {
                    http_response_code(406);

                    $retorno = new MsgRetorno;
                    $retorno->result = MsgRetorno::ERROR;
                    $retorno->code = MsgRetorno::CODE_ERROR_PARAMETROS_INCORRETOS;
                    $retorno->message = "Um ou mais parametros estao incorretos.";

                    $r = new Retorno();
                    $r->retorno = $retorno;
                    echo json_encode($r);

                    return false;
                }
                $param[$name] = $parametros[$name];
            }


            return $param;
        }

        return true;
    }
}
