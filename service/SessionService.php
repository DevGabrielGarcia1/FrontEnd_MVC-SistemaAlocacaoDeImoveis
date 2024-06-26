<?php

namespace service;

use controller\RouteController;
use Exception;
use generic\Api;
use generic\ViewResponseCodes;

class SessionService
{

    const TOKEN = "token";

    public static function sessionStart()
    {
        try {
            if (!isset($_SESSION)) {
                session_start();
                return true;
            }
            return false;
        } catch (\Throwable $th) {
        }
    }

    public static function setSession($token)
    {
        self::sessionStart();
        try {
            if (!isset($_SESSION[self::TOKEN])) {
                $_SESSION[self::TOKEN] = $token;
                return true;
            }
            return false;
        } catch (Exception $e) {
            return false;
        }
    }

    public static function isLogued()
    {
        self::sessionStart();
        try {
            if (isset($_SESSION[self::TOKEN])) {
                return true;
            }
            return false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public static function sessionLogout()
    {
        self::sessionStart();
        try {
            unset($_SESSION[self::TOKEN]);
            session_unset();
            session_destroy();
        } catch (\Throwable $th) {
        }
    }

    public static function tokenExpired()
    {
        self::sessionStart();
        if (self::isLogued() && time() > Api::readToken($_SESSION[self::TOKEN])->expire) {
            return true;
        }
        return false;
    }

    public static function autoLogoutIFtokenExpired()
    {
        if (self::tokenExpired()) {
            //Sessão expirou
            self::sessionLogout();
            header("Location: " . RouteController::RootRoute() . "/login/" . ViewResponseCodes::SESSION_EXPIRED);
            exit();
        }
    }

    public static function autoRedirectLoginIFNotLogued(){
        if(!self::isLogued()){
            self::sessionLogout();
            header("Location: " . RouteController::RootRoute() . "/login");
            exit();
        }
    }

    public static function getToken()
    {
        self::sessionStart();
        if(self::isLogued())
            return $_SESSION[self::TOKEN];
        return null;
    }

    public static function getName()
    {
        self::sessionStart();
        if (!self::isLogued() || !isset($_SESSION[self::TOKEN])) {
            return false;
        }
        return Api::readToken($_SESSION[self::TOKEN])->user["username"];
    }
}
