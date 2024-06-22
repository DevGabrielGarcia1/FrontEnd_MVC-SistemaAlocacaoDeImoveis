<?php

namespace service;

use Exception;

class SessionService {

    const TOKEN = "token";

    public static function sessionStart(){
        try {
            if(!isset($_SESSION)){
                session_start();
                return true;
            }
            return false;
            } catch (\Throwable $th) {
            }
    }

    public static function setSession($token){
        self::sessionStart();
        try{
            if(!isset($_SESSION[self::TOKEN])){
                $_SESSION[self::TOKEN] = $token;
                return true;
            }
            return false;
        } catch (Exception $e){
            return false;
        }
    }

    public static function isLogued(){
        self::sessionStart();
        try {
            if(isset($_SESSION[self::TOKEN])){
                return true;
            }
            return false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public static function sessionLogout(){
        self::sessionStart();
        try {
            session_unset();
            session_destroy();
        } catch (\Throwable $th) {
        }
    }

    public static function getName(){
        if(!self::sessionStart() || !isset($_SESSION[self::TOKEN])){
            return false;
        }
        
        $token = $_SESSION[self::TOKEN];
        list($header, $payload, $signature) = explode('.', $token);
        $jsonToken = base64_decode($payload);
        $arrayToken = json_decode($jsonToken, true);
        $uid = json_decode($arrayToken['uid'], true);
        return $uid["username"];
    }

}