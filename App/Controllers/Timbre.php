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
               $idTimbre = Model::create($timbre, $imgPath);
               $timbre = Model::getTimbre($idTimbre);
               View::renderTemplate("Timbre/timbre.html", ['timbre'=>$timbre]);
            }
            catch (Exception $e){
                View::renderTemplate('Timbre/timbre.html', ["user"=>$user, 'erreur' => $e->getMessage()]);
            }
        }
    }

    public function monTimbreAction($idTimbre){
        $timbre = Model::getTimbre($idTimbre);
        View::renderTemplate('Timbre/timbre.html', ['timbres'=>$timbre]);
    }

    public function mesTimbresAction(){
        if(Login::isLogged()){   
            $userId = Login::getUser()->getIdU();
            $timbres = Model::getUserTimbres($userId);
            View::renderTemplate('Timbre/mesTimbres.html', ['timbres'=>$timbres]);        
        }else{
            View::renderTemplate("User/connexion.html"); 
        };
    }

    public function viewTimbreAction($timbreId){
        $timbre = Model::getTimbre($timbreId);
        View::renderTemplate('Timbre/viewTimbre.html', ['timbres'=>$timbre]);
    }
}
