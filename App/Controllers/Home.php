<?php

namespace App\Controllers;
use App\Models\User;
use App\Models\Timbre;
use \Core\View;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Home extends \Core\Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {      
        $user = User::getAll();
        View::renderTemplate('Home/index.html');
    }

    public function catalogueAction()
    {      
        $timbres = Timbre::getAll();
        $user = User::getAll();
        View::renderTemplate('catalogue.html', ['timbres'=>$timbres]);
    }
}
