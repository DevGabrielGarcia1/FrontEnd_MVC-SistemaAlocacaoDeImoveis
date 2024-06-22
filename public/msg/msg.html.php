<?php 
$raiz = strtok($_SERVER["REQUEST_URI"],"?");
$raiz = substr($raiz, 0, (strlen($raiz) - strlen("public/msg/msg.html.php"))-1 );
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="<?= $raiz ?>/public/msg/msg.css">
</head>
<body>
    <!-- Apenas para teste, deve comentar a linha de export do javascript pra funcionar na pagina original-->
    <!-- <div onclick="abrir()" class="btnMsg">OK</div> -->
    <div class="janela-modal" id="janela-modal">
        <div class="modal">
            <button class="fechar" id="fechar">X</button>
            <h1 class="msgTitle">Texto</h1>
            <p class="msgMenssage">Lorem ipsum dolor sit amet consectetur adipisicing elit. At, eaque sed deleniti voluptas porro aut quam eveniet animi nihil recusandae mollitia sit, ea pariatur blanditiis et. Autem quia quidem maiores.</p>
            <div class="msgInput"><P>Digite aqui:</P><input type="text"></div>
            <div class="btnsDiv">
                <button class="msgOkButton" id="btnOk"> ok</button>
                <button class="msgCancelButton"id="btnCancel"> cancel</button>
            </div>  
        </div>
    </div>
    <script src="<?= $raiz ?>/public/msg/msg.js"></script>
</body>
</html>