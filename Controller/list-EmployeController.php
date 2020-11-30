<?php
session_start();
include("../Modele/Service/ServiceEmploye.php");
include_once("../Presentation/PresentationUser.php"); 
include_once("../Presentation/PresentationEmploye.php");
require_once("../Modele/Exceptions/ServiceException.php");
//var_dump($_POST);
$serviceEmployes = new ServiceEmploye();
$date = new DateTime(date('Y-m-d'));

if (isset($_GET['action'])) {

    /****************************************AJOUTER UN EMPLOYE************************/
    if ($_GET['action'] == 'add' && $_GET['noEmploye'] == "") 
    {
        if (!empty($_POST) && isset($_POST))
        {    
            /*****************VERIFICATION CONNEXION ****/
            if (!isset($_SESSION['userName'])) {
                header("Location: index.php");
            }            
                $noEmploye = $_POST['noEmploye'];
                $nom = is_null($_POST['nom']) ? 'NULL' : $_POST['nom'];
                $prenom = is_null($_POST['prenom']) ? 'NULL' : $_POST['prenom'];
                $emploi = is_null($_POST['emploi']) ? 'NULL' : $_POST['emploi'];
                $embauche = is_null($_POST['embauche']) ? 'NULL' : $_POST['embauche'];
                $newEmbauche = new DateTime($embauche);       
                $salaire = is_null($_POST['salaire']) ? 'NULL' : $_POST['salaire'];
                $commission = is_null($_POST['commission']) ? 'NULL' : $_POST['commission'];
                $sup = is_null($_POST['sup']) ? 'NULL' : $_POST['sup'];
                $noservice = $_POST['no_service'];
                $NOPROJ = is_null($_POST['NOPROJ']) ? 'NULL' : $_POST['NOPROJ']; 
                
                $employe = new Employe();
                $employe->setNoEmploye($noEmploye)
                        ->setNom($nom) 
                        ->setPrenom($prenom)
                        ->setEmploi($emploi)
                        ->setEmbauche($newEmbauche)
                        ->setSalaire($salaire)
                        ->setCommission($commission)
                        ->setSup($sup)
                        ->setNoService($noservice)
                        ->setNoProj($NOPROJ);
            try {
                $serviceEmployes->add($employe);
                                    
                //throw new ServiceException("Problème technique, l'employé n'a pas pu être enregistré.", 9988);  
                $compteur = $serviceEmployes->compteur($date->format('Y-m-d'));             
                $employes = $serviceEmployes->searchAll();        
                $allChef = $serviceEmployes->allSuperieur();            
                $admin = isset($_SESSION['profil']) && $_SESSION['profil'] == 'admin';
                
                echo listEmploye($admin,$employes,$allChef,$compteur);
                die;                 
            } 
            catch (ServiceException $se) {        
                $compteur = $serviceEmployes->compteur($date->format('Y-m-d'));
                $employes = $serviceEmployes->searchAll();          
                $allChef = $serviceEmployes->allSuperieur();            
                $admin = isset($_SESSION['profil']) && $_SESSION['profil'] == 'admin';
                echo listEmploye($admin,$employes,$allChef,$compteur,$se->getCode());
            }          
        }       
    }

    /**************************************** MODIFIER UN EMPLOYE ************************/
    elseif ($_GET['action'] == 'update' 
        && isset($_GET['noEmploye'])) 
    {
        if (!empty($_POST) && isset($_POST))  
        {   
            /*****************VERIFICATION CONNEXION ****/
            if (!isset($_SESSION['userName'])) {
                header("Location: index.php");
            }
            
            $noEmploye = $_GET['noEmploye']; 
            $nom = is_null($_POST['nom']) ? 'NULL' : $_POST['nom'];
            $prenom = is_null($_POST['prenom']) ? 'NULL' : $_POST['prenom'];
            $emploi = is_null($_POST['emploi']) ? 'NULL' : $_POST['emploi'];
            $embauche = is_null($_POST['embauche']) ? 'NULL' : $_POST['embauche'];
            $newEmbauche = new DateTime($embauche);        
            $salaire = is_null($_POST['salaire']) ? 'NULL' : $_POST['salaire'];
            $commission = is_null($_POST['commission']) ? 'NULL' : $_POST['commission'];
            $sup = is_null($_POST['sup']) ? 'NULL' : $_POST['sup'];
            $noservice = $_POST['no_service'];
            $NOPROJ = is_null($_POST['NOPROJ']) ? 'NULL' : $_POST['NOPROJ']; 

            $employe = new Employe();
            $employe->setNoEmploye($noEmploye)
                    ->setNom($nom) 
                    ->setPrenom($prenom)    
                    ->setEmploi($emploi)
                    ->setEmbauche($newEmbauche)
                    ->setSalaire($salaire)
                    ->setCommission($commission)
                    ->setSup($sup)
                    ->setNoService($noservice)
                    ->setNoProj($NOPROJ);
            
            try {
                $compteur = $serviceEmployes->compteur($date->format('Y-m-d'));
                $serviceEmployes->update($employe);        
                $employes = $serviceEmployes->searchAll();        
                $allChef = $serviceEmployes->allSuperieur();
                $admin = isset($_SESSION['profil']) && $_SESSION['profil'] == 'admin';
    
                echo listEmploye($admin,$employes,$allChef,$compteur);
                die;
            } 
            catch (ServiceException $se) {
                $compteur = $serviceEmployes->compteur($date->format('Y-m-d'));
                $employes = $serviceEmployes->searchAll();          
                $allChef = $serviceEmployes->allSuperieur();
                $admin = isset($_SESSION['profil']) && $_SESSION['profil'] == 'admin';
    
                echo listEmploye($admin,$employes,$allChef,$compteur,$se->getMessage(),$se->getCode());
                die;
            }
        }
    }

    /****************************************SUPPRIMER UN EMPLOYE************************/
    elseif ($_GET['action'] == 'delete') 
    {
        if (!empty($_GET['noEmploye'])) 
        {    
            /*****************VERIFICATION CONNEXION ****/
            if (!isset($_SESSION['userName'])) {
                echo formulaireConnexion();
            }          
            
            $serviceEmployes->{$_GET['action']}($_GET['noEmploye']); 

            try {
                $compteur = $serviceEmployes->compteur($date->format('Y-m-d'));   
                $employes = $serviceEmployes->searchAll();             
                $allChef = $serviceEmployes->allSuperieur();
                $admin = isset($_SESSION['profil']) && $_SESSION['profil'] == 'admin';

                echo listEmploye($admin,$employes,$allChef,$compteur);
                die;
            } 
            catch (ServiceException $se) {
                $compteur = $serviceEmployes->compteur($date->format('Y-m-d'));
                $employes = $serviceEmployes->searchAll();             
                $allChef = $serviceEmployes->allSuperieur();
                $admin = isset($_SESSION['profil']) && $_SESSION['profil'] == 'admin';

                echo listEmploye($admin,$employes,$allChef,$compteur,$se->getMessage(),$se->getCode());
                die;
            }           
        }
    }
}


try {
    $compteur = $serviceEmployes->compteur($date->format('Y-m-d'));
    $employes = $serviceEmployes->searchAll(); 
    $allChef = $serviceEmployes->allSuperieur();
    $admin = isset($_SESSION['profil']) && $_SESSION['profil'] == 'admin';

    /*****************VERIFICATION CONNEXION ****/
    if (!isset($_SESSION['userName'])) {
        header("Location: index.php");
    }
    else {   
        echo listEmploye($admin,$employes,$allChef,$compteur);
    }
}
catch (ServiceException $se) {
    $compteur = $serviceEmployes->compteur($date->format('Y-m-d'));
    $employes = $serviceEmployes->searchAll(); 
    $allChef = $serviceEmployes->allSuperieur();
    $admin = isset($_SESSION['profil']) && $_SESSION['profil'] == 'admin';

    if (!isset($_SESSION['userName'])) {
        header("Location: index.php");
    }
    else {   
        echo listEmploye($admin,$employes,$allChef,$compteur,$se->getMessage(),$se->getCode());
    }
}



