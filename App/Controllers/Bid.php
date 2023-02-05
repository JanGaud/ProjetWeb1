<?php

namespace App\Controllers;
use App\Models\User;
use Exception;
use App\Models\Timbre;
use App\Services\Login;
use App\Models\Bid as Model;
use App\Models\BidModel;
use App\Models\TimbreModel;
use \Core\View;

/**
 * Bid controller
 *
 * PHP version 7.0
 */
class Bid extends \Core\Controller{

    public function bidPostAction()
    {      
        $user = Model::getAll();

        if (isset($_POST['submit'])) {
            try{
               $bid = new BidModel();      
               $bid->setAuteur(Login::getUser());
               $bid->setTime(date("Y-m-d H:i:s"));
               $bid->setBid();
               $bid->setEnchereId($_POST["idTimbre"]);
            //    $idTimbre = Model::create($bid);

               View::renderTemplate('catalogue.html');
            }
            catch (Exception $e){
                View::renderTemplate('catalogue.html', ["user"=>$user, 'erreur' => $e->getMessage(), 'timbres'=>Timbre::getAll()]);
            }
        }
    }
}

