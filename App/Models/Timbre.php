<?php

namespace App\Models;

use PDO;
use Exception;
use App\Models\Bid;
use App\Models\TimbreModel;


class Timbre extends \Core\Model
{
    public static function getAll()
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT * FROM timbre');
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $timbres = [];
        foreach($result as $value){
            $timbre = new TimbreModel();
            $timbre->setPrixInit($value['startPrice']);
            $timbre->setTitre($value['titreTimbre']);
            $timbre->setDescription($value['descriptionTimbre']);
            $timbre->setDebut($value['dateStart']);
            $timbre->setFin($value['dateEnd']);
            $timbre->setImage(static::getTimbreImages($value['idTimbre']));
            $timbre->setQuality($value['quality']);
            $timbre->setUserId($value['User_idUser']);
            $timbre->setDataEncherisseur(Bid::count($value['idTimbre']));
            $timbre->setDataMiseAct(Bid::lastBid($value['idTimbre']));
            $timbre->setDataId($value['idTimbre']);
            array_push($timbres, $timbre);
        }
        return $timbres;
    }

    public static function create(TimbreModel $timbre, $img)
    {
        $idTimbre = null;

        $db = static::getDB();
        $sql = "INSERT INTO timbre(titreTimbre, descriptionTimbre, quality, startPrice, 
             User_idUser, certified, dateStart, dateEnd) VALUES (:titreTimbre, :descriptionTimbre,       
              :quality, :startPrice, :User_idUser, :certified, :dateStart, :dateEnd)";

        $stmt = $db->prepare($sql);
        $stmt->bindValue(":titreTimbre", $timbre->getTitre());
        $stmt->bindValue(":descriptionTimbre", $timbre->getDescription());
        $stmt->bindValue(":quality", $timbre->getQuality());
        $stmt->bindValue(":startPrice", $timbre->getPrixInit());
        $stmt->bindValue(":User_idUser", $timbre->getUserId());
        $stmt->bindValue(":certified", false);
        $stmt->bindValue(":dateStart", $timbre->getDebut());
        $stmt->bindValue(":dateEnd", $timbre->getFin());
        if ($stmt->execute()) {
            $idTimbre = $db->lastInsertId();
        } else {
            throw new Exception($stmt->errorInfo());
        }

        $sql = "INSERT INTO image(imageUrl, Timbre_idTimbre) VALUES (:imageUrl, :Timbre_idTimbre)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":imageUrl", $img);
        $stmt->bindValue(":Timbre_idTimbre", $idTimbre);

        if(!$stmt->execute()){
            throw new Exception($stmt->errorInfo());
        }
        return $idTimbre;
    }

    public static function getUserTimbres($userId){
        $db = static::getDB();
        $stmt = $db->query("SELECT * FROM timbre WHERE User_idUser = $userId");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getTimbre($timbreId){
        $db = static::getDB();
        $sql = "SELECT * FROM timbre  WHERE idTimbre = :timbreId";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":timbreId", $timbreId);
        
        $stmt->execute();
        $result = $stmt->fetch();

        if($result){
            $timbre = new TimbreModel();
            $timbre->setTitre($result['titreTimbre']);
            $timbre->setDescription($result['descriptionTimbre']);
            $timbre->setQuality($result['quality']);
            $timbre->setDebut($result['dateStart']);
            $timbre->setFin($result['dateEnd']);
            $timbre->setPrixInit($result['startPrice']);
            $timbre->setImage(static::getTimbreImages($timbreId));
            return $timbre;
        }
        return null;
    }
    
    private static function getTimbreImages($timbreId){
        $db = static::getDB();
        $stmt = $db->query("SELECT imageUrl FROM timbre JOIN image ON timbre.idTimbre = image.Timbre_idTimbre  WHERE idTimbre = $timbreId");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
