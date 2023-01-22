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
/**
 * prends une adresse courriel et retourne une instance de la classe userModel
 * Si l'adresse n'est pas trouvee, la fonction retourne nulle, si l'adresse est trouvee dans la base de donnee,
 * la fonction retourne une objet d'un utilisateur.
 */
    public static function getUser($email){
        //Recuperer la connexion a la base de donnee
        $db = static::getDB();
        //Ecrire la requete sql
        $sql = "SELECT * FROM user WHERE emailU = :email";
        //Insere le courriel dans la requete sql
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":email", $email);
        //Execute la requete sql        
        $stmt->execute();
        //result contient un tableau, les cles correspondent aux champs de donnees dans la table user
        $result = $stmt->fetch();

        
        if($result){
            $user = new UserModel();
            $user->setEmail($result['emailU']);
            $user->setPrenom($result['firstNameU']);
            $user->setNom($result['lastNameU']);
            $user->setPhone($result['phoneU']);
            $user->setPassword($result['passwordU']);
            return $user;
        }
        //Retourne null si le courriel n'est pas trouve
        return null;
    }

    public static function create(UserModel $user, $privilege)
    {
        $db = static::getDB();
        $sql = "INSERT INTO User (firstNameU, lastNameU, phoneU, emailU, passwordU, Privileges_idPrivileges)    
                VALUES (:firstNameU, :lastNameU, :phoneU, :emailU, :passwordU, :Privileges_idPrivileges)";

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
