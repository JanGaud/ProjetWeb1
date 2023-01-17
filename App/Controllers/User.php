<?php

namespace App\Controllers;

use App\Models\Privilege;
use App\Models\User as Model;
use App\Models\UserModel;
use \Core\View;

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

    public function postAction(){
        $user = new UserModel();
        $user->setPrenom($_REQUEST['firstNameU']);
        $user->setNom($_REQUEST['lastNameU']);
        $user->setEmail($_REQUEST['emailU']);
        $user->setPassword(password_hash($_REQUEST['passwordU'], PASSWORD_DEFAULT));
        $user->setPhone($_REQUEST['phoneU']);
        Model::create($user, Privilege::Membre->value);

        View::renderTemplate('User/index.html');
    }
}
