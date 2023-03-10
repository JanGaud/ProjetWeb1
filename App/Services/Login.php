<?php

namespace App\Services;

use App\Models\Privilege;
use App\Models\UserModel;

class Login{

    public static function loginUser(UserModel $user, Privilege $privilege){
        $_SESSION['compteActif'] = true;
        $_SESSION['utilisateur'] = $user;
        $_SESSION['privilege'] = $privilege;
    }


    public static function logoutUser(){
            session_destroy(); 
    }


    public static function isLogged(){
        if (isset($_SESSION['compteActif'])) {
            return $_SESSION['compteActif'];
        }
            return false;
    }

    public static function getPrivilege(){
        if(Login::isLogged()){
            return $_SESSION['privilege'];
        }
            return null;
    }

    public static function getUser():?UserModel{
        if(Login::isLogged()){
            return $_SESSION['utilisateur'];
        }
            return null;
    }
}
