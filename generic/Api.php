<?php
namespace generic;

use stdClass;

class Api {

    public const URLBASE = "http://localhost/github/API_MVC-SistemaAlocacaoDeImoveis/";


    public static function readToken($token){
        list($header, $payload, $signature) = explode('.', $token);
        $jsonToken = base64_decode($payload);
        $arrayToken = json_decode($jsonToken, true);
        
        $return = new stdClass();
        $return->create = json_decode($arrayToken['iat'], true);
        $return->expire = json_decode($arrayToken['exp'], true);
        $return->user = json_decode($arrayToken['uid'], true);

        return $return;
    }

}

?>