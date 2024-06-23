<?php
namespace generic;

class ViewResponseCodes {

    //Positivos
    const SUCCESS_OPERATION = 1;

    //Negativos
    const GENERIC_ERROR = 200;
    const SESSION_EXPIRED = 201;
    const ERROR_CONNECT_API = 202;
    const ERRO_RETORNO_VAZIO = 203;
    const ERROR_INVALIDLOGIN = 101;
    const ERROR_CAMPOS_OBRIGATORIOS = 103;

}

?>