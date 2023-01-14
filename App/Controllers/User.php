<?php

namespace App\Controllers;
use App\Models\User as Model;
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
}
