<?php
namespace view;

use generic\View;

class ProprietariosView extends View {

    public function listarProprietarios($listProprietarios, $responseCode){

        $this->conteudo("public/proprietarios/listProprietarios.php", [
            "titleTabPage" => "Proprietários",
            "listProprietarios" => $listProprietarios,
            "responseCode" => $responseCode
        ]);

    }

    public function addProprietario($proprietario, $resonseCode){
        $this->conteudo("public/proprietarios/addEditProprietario.php",[
            "titleTabPage" => "Adicionar Proprietario",
            "editMode" => false,
            "proprietario" => $proprietario,
            "responseCode" => $resonseCode
        ]);
    }

    public function editProprietario($proprietario, $resonseCode){
        $this->conteudo("public/proprietarios/addEditProprietario.php",[
            "titleTabPage" => "Editar Proprietario",
            "editMode" => true,
            "proprietario" => $proprietario,
            "responseCode" => $resonseCode
        ]);
    }

}

?>