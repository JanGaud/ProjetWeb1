<?php

namespace App\Models;
use App\Models\TimbreModel;
use App\Services\Login;

use PDO;

/**
 * Example user model
 *
 * PHP version 7.0
 */
class Bid extends \Core\Model
{
    public static function getAll()
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT * FROM bid');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public static function count($idTimbre){
        $db = static::getDB();
        $stmt = $db->query("SELECT COUNT(*) FROM bid WHERE Timbre_idTimbre = $idTimbre");
        return $stmt->fetchColumn();
    }

    public static function lastBid($idTimbre){
        $db = static::getDB();
        $stmt = $db->query("SELECT MAX(bidPrice) FROM bid WHERE Timbre_idTimbre = $idTimbre");
        $lastBid = $stmt->fetchColumn();
        
        if ($lastBid) {
            return $lastBid;
        } else {
            $stmt = $db->query("SELECT startPrice FROM timbre WHERE idTimbre = $idTimbre");
            $prixInit = $stmt->fetchColumn();
            return $prixInit;
        }

    }

    public static function create(BidModel $bid)
    {
        $db = static::getDB();
        $sql = "INSERT INTO bid (bidPrice, User_idUser, bidTime, Timbre_idTimbre) VALUES (:bidPrice, :User_idUser, :bidTime, :Timbre_idTimbre)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":bidPrice", $bid->getBid());
        $stmt->bindValue(":User_idUser", Login::getUser()->getIdU());
        $stmt->bindValue(":bidTime", $bid->getTime());
        $stmt->bindValue(":Timbre_idTimbre", $bid->getEnchereId());
        if ($stmt->execute()) {
            return $db->lastInsertId();
        } else {
            print_r($stmt->errorInfo());
        }
    }
}