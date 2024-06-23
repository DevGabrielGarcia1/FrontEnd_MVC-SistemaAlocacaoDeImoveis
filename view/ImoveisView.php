<?php
namespace view;

use generic\View;

class ImoveisView extends View {

    public function listImoveis($listImoveis){
        $this->conteudo("public/imoveis/imoveis.php", [
            "titleTabPage" => "Imoveis",
            "listImoveis" => $listImoveis
        ]);
    }

    public function listPublicImoveis(){

    }

}

?>