<?php

namespace view;

use generic\View;

class loginView extends View {

    //Override
    public function conteudo($caminho, $param = array())
    {
        include $caminho;
    }

    public function login($responseCode){
        $this->conteudo("public/login.php", [
            "titleTabPage" => "Login - Imobiliária",
            "responseCode" => $responseCode
        ]);
    }
}