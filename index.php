<?php
session_start();
include_once("Modele/Service/ServiceUser.php");
include_once("Presentation/PresentationUser.php"); 
require_once("Modele/Exceptions/ServiceException.php");

if (isset($_GET['action']) && !empty($_GET['action'])) 
{       
    /*************CONNEXION **************/
    if ($_GET['action']=='connexion') 
    {        
        $userName = $_POST['userName'];
        $password = $_POST['password'];
        try {
            $objectUser = ServiceUser::searchUserbyUserName($userName);
            if (!empty($objectUser) && password_verify($password,$objectUser->getPassword()))
            {
                $_SESSION['userName']=$userName;
                $_SESSION['profil']=$objectUser->getProfil();
                $admin = isset($_SESSION['profil']) && $_SESSION['profil'] == 'admin';  
                echo index();
                die;
            }
            else {
                //header("Location: index.php");
                throw new DAOException(" Veuillez saisir un indentifiant ou un mot de passe correct ",9995);
                die;           
            }       
        } 
        catch (ServiceException $se) {
            echo formulaireConnexion($se->getMessage(),$se->getCode()); 
            die;
        }       
    }

    /*************ACCES FORMULAIRE INSCRIPTION**************/  
    elseif ($_GET['action']=='inscription') 
    {
        try {
            echo formulaireInscription();
            die;
        } 
        catch (ServiceException $se) {
            echo formulaireInscription($se->getCode());    //Erreur affichage
            die;
        }      
    }

    /*************AJOUT **************/
    elseif ($_GET['action']=='add') 
    {
        $userName = $_POST['userName'];
        $password = $_POST['password'];
        $profil = User::$profil;   

        $user = new User();
        $user->setUserName($userName);
        try {
            ServiceUser::addUser($user,$password);
            $admin = isset($_SESSION['profil']) && $_SESSION['profil'] == 'admin';  
            echo index();
        } 
        catch (ServiceException $se) {
            echo formulaireInscription($se->getCode());  //Erreur d'ajout utilisateur
            die;
        }
        
    }

    /*************DECONNEXION **************/
    elseif ($_GET['action']=='deconnexion') 
    {
        try {
            session_destroy();
            echo formulaireConnexion();
            die;
        } 
        catch (ServiceException $se) {
            echo index($se->getMessage(),$se->getCode());           //Erreur lors de la déconnexion
            die;
        }        
    }
}

try {
    $admin = isset($_SESSION['profil']) && $_SESSION['profil'] == 'admin';
    if (!isset($_SESSION['userName']) && !isset($_GET['action']))  
    {
        echo formulaireConnexion();
    } 
    else{
        echo index();
    }
} 
catch (ServiceException $se) {
    $admin = isset($_SESSION['profil']) && $_SESSION['profil'] == 'admin';
    if (!isset($_SESSION['userName']) && !isset($_GET['action']))  
    {
        echo formulaireConnexion();
    } 
    else{
        echo index($se->getMessage(),$se->getCode());
    }
}

