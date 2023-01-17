<?php

namespace App\Models;

use PDO;

/**
 * Example user model
 *
 * PHP version 7.0
 */
class User extends \Core\Model
{

    /**
     * Get all the users as an associative array
     *
     * @return array
     */
    public static function getAll()
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT * FROM User');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create(UserModel $user, $privilege)
    {
        $db = static::getDB();
        $sql = "INSERT INTO User (firstNameU, lastNameU, phoneU, emailU, passwordU, Privileges_idPrivileges) VALUES (:firstNameU, :lastNameU, :phoneU, :emailU, :passwordU, :Privileges_idPrivileges)";

        $stmt = $db->prepare($sql);
        $stmt->bindValue(":firstNameU", $user->getPrenom());
        $stmt->bindValue(":lastNameU", $user->getNom());
        $stmt->bindValue(":phoneU", $user->getPhone());
        $stmt->bindValue(":emailU", $user->getEmail());
        $stmt->bindValue(":passwordU", $user->getPassword());
        $stmt->bindValue(":phoneU", $user->getPhone());
        $stmt->bindValue(":Privileges_idPrivileges", $privilege);
        if (!$stmt->execute()) {
            print_r($stmt->errorInfo());
        }
    }
}
