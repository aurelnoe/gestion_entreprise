<?php
include_once("Modele/Class/User.php"); 
include_once("Modele/Class/Connexion.php");
include_once("Modele/Interfaces/InterfaceUser.php");
require_once("Modele/Exceptions/DAOException.php");

class UserMYSQLIDAO extends Connexion
{
    public function addUser(object $user)
    {  
        try {
            $connexion = new Connexion();
            $db = $connexion->connexion();        
                        
            $id = $user->getId();
            $getuserName = $user->getUserName();
            $getpassword = $user->getPassword();
            $profil = 'utilisateur';  

            $query = "INSERT INTO user(userName,password,profil) VALUES (?,?,?)"; 

            $stmt = $db->prepare($query);
            $stmt->bind_param("sss", $getuserName, $getpassword,$profil);
            $stmt->execute();    
        }
        catch (mysqli_sql_exception $e) {
            throw new DAOException($e->getMessage(),$e->getCode());
        } 
        finally{
            $db->close();
            $rs->free();
        } 
        
    }

    public function searchUserbyUserName(string $userName)
    {
        try {
            if (isset($userName)) 
            {   
                $connexion = new Connexion();
                $db = $connexion->connexion();
                    
                if($db->connect_error){
                    die('Erreur : ' .$db->connect_error);
                }

                $query = "SELECT * FROM user WHERE userName = ?";   
                $stmt = $db->prepare($query);
                $stmt->bind_param("s",$userName);
                $stmt->execute();
                $rs = $stmt->get_result();
                $data=$rs->fetch_object("User");

                return $data;
                if (!($data)) {
                    throw new DAOException("L'utilisateur n'a pas été trouvé dans la base de données",1081);
                }
            } 
        }
        catch (mysqli_sql_exception $e) {
            throw new DAOException($e->getMessage(),$e->getCode());
        } 
        finally{
            $db->close();
            $rs->free();
        }              
    }
}