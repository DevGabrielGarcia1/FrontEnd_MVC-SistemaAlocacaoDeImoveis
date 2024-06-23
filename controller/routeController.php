<?php

namespace controller;

class RouteController {

    public function pageUp(){
        echo "<script>history.back();</script>";
    }

    public function redirectUp(){
        header("Location: ../");
    }

    //Legado
    public function normalizeRoute(){
        $rote = substr($_GET["param"], 0, strlen($_GET["param"]) - 1);
        header("Location: ../".$rote);
    }

    public static function RootRoute(){
        $raiz = strtok($_SERVER["REQUEST_URI"],"?");
        $raiz= substr($raiz, 0, (strlen($raiz) - strlen($_GET["param"]))-1 );
        return $raiz;
    }

    public function getRootRoute(){
        return self::RootRoute();
    }

    public function redirectTo($url){
        header("Location: ".$url);
    }

    public static function redirectPost($url, array $data) {
        echo "<form id='postForm' action='$url' method='POST'>";
    
        foreach ($data as $key => $value) {
            echo "<input type='hidden' name='".htmlspecialchars($key)."' value='".htmlspecialchars($value)."'>";
        }
    
        echo "</form>";
        echo "<script type='text/javascript'>document.getElementById('postForm').submit();</script>";
        exit();
    }
}