<?php

namespace generic;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTAuth
{

    public function verificar()
    {
        try {
            if (!isset($_SERVER['HTTP_AUTHORIZATION'])) {
                http_response_code(406);
                return false;
            }
            $autorizacao = $_SERVER['HTTP_AUTHORIZATION'];
            $token = str_replace('Bearer ', '', $autorizacao);
            $decodificar = Jwt::decode($token,new Key("", "HS256")); //payload
            $hora = time();
            
            if ($hora > $decodificar->exp) {
                http_response_code(408);
                return false;
            }

            return $decodificar;
        } catch (Exception $e) {
            http_response_code(401);
            return false;
        }

        
    }
}
