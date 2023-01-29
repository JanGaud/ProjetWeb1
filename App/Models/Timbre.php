<?php

namespace App\Models;

use PDO;
use Exception;

/**
 * Example user model
 *
 * PHP version 7.0
 */
class Timbre extends \Core\Model
{
    public static function getAll()
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT * FROM timbre');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
}
