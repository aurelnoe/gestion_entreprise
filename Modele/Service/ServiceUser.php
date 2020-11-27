<?php
include_once("Modele/DAO/UserMYSQLIDAO.php");
include_once("Modele/Exceptions/DAOException.php");

class ServiceUser 
{
    public static function addUser(User $user)
    {
        try {
            $hash = password_hash($user->getPassword(), PASSWORD_DEFAULT);
            $user->setPassword($hash);
            return UserMYSQLIDAO::addUser($user);
        } 
        catch (DAOException $de) {
            throw new ServiceException($de->getMessage(),$de->getCode());
        }
        
    }

    public static function searchUserbyUserName($userName)
    {
        try {
            $users = UserMYSQLIDAO::searchUserbyUserName($userName);
            return $users;
        } 
        catch (DAOException $de) {
            throw new ServiceException($de->getMessage(),$de->getCode());
        }     
    }
}

?>