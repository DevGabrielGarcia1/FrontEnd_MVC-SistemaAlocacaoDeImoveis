<?php

namespace service;

use Exception;
use generic\Api;

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
        self::sessionStart();
        if(!self::isLogued() || !isset($_SESSION[self::TOKEN])){
            return false;
        }
        return Api::readToken($_SESSION[self::TOKEN])->user["username"];
    }

}