<?php

namespace App\Controllers;
use Exception;
use App\Models\User;
use App\Models\BidModel;
use App\Models\Bid;
use App\Models\Timbre;
use App\Services\Login;
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

    public function bidPostAction()
    {      
        $user = User::getAll();
            try{
               $bid = new BidModel();      
               $bid->setAuteur(Login::getUser());
               $bid->setEnchereId($_POST["idTimbre"]);
               $bid->setTime(date("Y-m-d H:i:s"));
               $bid->setBid($_POST["bid"]);
              
               Bid::create($bid);
               View::renderTemplate('catalogue.html');
            }
            catch (Exception $e){
                // echo($e->getMessage());
                View::renderTemplate('catalogue.html', ["user"=>$user, 'erreur' => $e->getMessage()]);
            }
    }
}
