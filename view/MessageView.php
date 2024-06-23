<?php
namespace view;

use generic\View;

class MessageView extends View{
    
    public function showMessage($params){
        $this->conteudo("public/messageView.php",$params);
    }

}
?>