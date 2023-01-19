<?php

namespace App\Controllers;

use App\Models\Privilege;
use App\Models\User as Model;
use App\Models\UserModel;
use App\Services\Login;
use \Core\View;
use Exception;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class User extends \Core\Controller
{
    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {      
        $user = Model::getAll();
        View::renderTemplate('User/index.html', ["user"=>$user]);
    }

    public function inscriptionAction()
    {      
        $user = Model::getAll();
        View::renderTemplate('User/inscription.html', ["user"=>$user]);
    }

    public function connexionAction()
    {      
        $user = Model::getAll();
        View::renderTemplate('User/connexion.html', ["user"=>$user]);
    }

    public function creationAction()
    {      
        $user = Model::getAll();
        View::renderTemplate('User/creationEnchere.html', ["user"=>$user]);
    }

    public function inscriptionPostAction(){
        
        $user = new UserModel();
        $user->setPrenom($_REQUEST['firstNameU']);
        $user->setNom($_REQUEST['lastNameU']);
        $user->setEmail($_REQUEST['emailU']);
        $user->setPassword(password_hash($_REQUEST['passwordU'], PASSWORD_DEFAULT));
        $user->setPhone($_REQUEST['phoneU']);
        
            try {
                Model::create($user, Privilege::Membre->value);
                Login::loginUser($user, Privilege::Membre);
                View::renderTemplate('User/index.html', ["firstName"=>Login::getUser()->getPrenom()]);
            } 
            catch (Exception $e) {
                $error = "L'adresse courriel existe déjà!";
                View::renderTemplate("User/inscription.html", ['erreur' => $error]);
            }   
    }

    public function logoutAction(){               
        try {
            Login::logoutUser();  
        } 
        catch (Exception $e) {

        }
        header("Location:/ProjetWeb1/public/Home/index");

    }
}
