<?php

namespace App\Controllers;
use App\Services\Upload;
use App\Services\Login;
use App\Models\TimbreModel;
use App\Models\Timbre as Model;
use \Core\View;
use Exception;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Timbre extends \Core\Controller{

    public function creationAction()
    {   
        if(Login::isLogged()){   
        $user = Model::getAll();
        View::renderTemplate('User/creationEnchere.html', ["user"=>$user]);
        }else{
            View::renderTemplate("User/connexion.html"); 
        };
    }

    public function encherePostAction(){
        $user = Model::getAll();

        if (isset($_POST['submit']) && isset($_FILES['my_image'])) {
            try{
               $imgPath = Upload::imgUpload($_FILES['my_image']);
               $timbre = new TimbreModel();      
               $timbre->setUserId(Login::getUser()->getIdU());
               $timbre->setTitre($_POST["titreTimbre"]);
               $timbre->setDescription($_POST["descriptionTimbre"]);
               $timbre->setQuality($_POST["quality"]);
               $timbre->setDebut($_POST["dateStart"]);
               $timbre->setFin($_POST["dateEnd"]);
               $timbre->setPrixInit($_POST["startPrice"]);
               Model::create($timbre, $imgPath);
               View::renderTemplate('Timbre/timbre.html', ['timbre'=>$timbre, 'imgPath'=>$imgPath,
                                                            'titre'=>$timbre->getTitre(),
                                                            'description'=>$timbre->getDescription(),
                                                            'prixInit'=>$timbre->getPrixInit(),
                                                            'qualite'=>$timbre->getQuality()]);
            }
            catch(Exception $e){
                View::renderTemplate('User/creationEnchere.html', ["user"=>$user, 'erreur' => $e->getMessage()]);
            }
        }

    }

}
