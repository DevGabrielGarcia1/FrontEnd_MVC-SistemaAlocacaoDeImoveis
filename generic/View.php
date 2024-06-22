<?php
namespace generic;
class View {
    private function cabecalho() {
        return "public/shared/Cabecalho.php";
    }
    private function rodape(){
        return "public/shared/Rodape.php";
    }

    public function conteudo($caminho,$param = array()){
        include $this->cabecalho();
        include $caminho;
        include $this->rodape();
    }
}
?>