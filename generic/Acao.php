<?php

namespace generic;

use controller\Page404Controller;
use Exception;
use ReflectionMethod;

class Acao
{
    private $classe;
    private $metodo;
    private $param;

    public function __construct($classe, $metodo, $param = [])
    {
        $this->classe = $classe;
        $this->metodo = $metodo;
        $this->param = $param;
    }

    public function setParam($param = []){
        $this->param = $param;
    }

    public function executar()
    {
        try {
            
            $return = null;
            $obj = new $this->classe();

            $reflectM = new ReflectionMethod($obj::class, $this->metodo);
            $param = $this->verificaParametros($reflectM, $this->param);

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

                if (!isset($parametros[$name]) && !$v->isOptional()) {
                    
                    (new Page404Controller())->page404();
                    exit();
                    
                }
                if(isset($parametros[$name]))
                    $param[$name] = $parametros[$name];
            }

            if(count($param) > 0)
                return $param;
        }

        return true;
    }
}
