<?php
session_start();
include("../Modele/Service/ServiceEmploye.php");
include_once("../Presentation/PresentationUser.php"); 
include_once("../Presentation/PresentationEmploye.php");
require_once("../Modele/Exceptions/ServiceException.php");
//var_dump($_POST);
$serviceEmployes = new ServiceEmploye();

if (isset($_GET['action'])) {

    /****************************************AJOUTER UN EMPLOYE************************/
    if ($_GET['action'] == 'add' && $_GET['no_employe'] == "") 
    {
        if (!empty($_POST) && isset($_POST))
        {    
            /*****************VERIFICATION CONNEXION ****/
            if (!isset($_SESSION['userName'])) {
                header("Location: index.php");
            }
            
                $noEmploye = $_POST['no_employe'];
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
                /************************************** Recupere toutes les valeurs */          
                $employes = $serviceEmployes->searchAll(); 
                    
                /********************************** CHERCHE LA LISTE DES SUPERIEURS */           
                $allChef = $serviceEmployes->allSuperieur();            

                /*********************************************VERIFICATION PROFIL*****/
                $admin = isset($_SESSION['profil']) && $_SESSION['profil'] == 'admin';
                
                echo listEmploye($admin,$employes,$allChef);
                die;                 
            } 
            catch (ServiceException $se) {
                /************************************** Recupere toutes les valeurs */          
                $employes = $serviceEmployes->searchAll(); 
                    
                /********************************** CHERCHE LA LISTE DES SUPERIEURS */           
                $allChef = $serviceEmployes->allSuperieur();            

                /*********************************************VERIFICATION PROFIL*****/
                $admin = isset($_SESSION['profil']) && $_SESSION['profil'] == 'admin';
                echo listEmploye($admin,$employes,$allChef,$se->getCode());
            }          
        }       
    }

    /**************************************** MODIFIER UN EMPLOYE ************************/
    elseif ($_GET['action'] == 'update' 
        && isset($_GET['no_employe'])) 
    {
        if (!empty($_POST) && isset($_POST))  
        {   
            /*****************VERIFICATION CONNEXION ****/
            if (!isset($_SESSION['userName'])) {
                header("Location: index.php");
            }
            
            $noEmploye = $_GET['no_employe']; 
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
                $serviceEmployes->update($employe); 

                /************************************** Recupere toutes les valeurs */         
                $employes = $serviceEmployes->searchAll(); 
            
                /********************************** CHERCHE LA LISTE DES SUPERIEURS */           
                $allChef = $serviceEmployes->allSuperieur();

                /*********************************************VERIFICATION PROFIL*****/
                $admin = isset($_SESSION['profil']) && $_SESSION['profil'] == 'admin';
    
                echo listEmploye($admin,$employes,$allChef);
                die;
            } 
            catch (ServiceException $se) {
                $employes = $serviceEmployes->searchAll(); 
            
                /********************************** CHERCHE LA LISTE DES SUPERIEURS */           
                $allChef = $serviceEmployes->allSuperieur();

                /*********************************************VERIFICATION PROFIL*****/
                $admin = isset($_SESSION['profil']) && $_SESSION['profil'] == 'admin';
    
                echo listEmploye($admin,$employes,$allChef,$se->getMessage(),$se->getCode());
                die;
            }
        }
    }

    /****************************************SUPPRIMER UN EMPLOYE************************/
    elseif ($_GET['action'] == 'delete') 
    {
        if (!empty($_GET['no_employe'])) 
        {    
            /*****************VERIFICATION CONNEXION ****/
            if (!isset($_SESSION['userName'])) {
                echo formulaireConnexion();
            }          
            
            $serviceEmployes->{$_GET['action']}($_GET['no_employe']); 

            try {
                /************************************** Recupere toutes les valeurs */    
                $employes = $serviceEmployes->searchAll();

                /********************************** CHERCHE LA LISTE DES SUPERIEURS */              
                $allChef = $serviceEmployes->allSuperieur();

                /***************************VERIFICATION PROFIL*****/
                $admin = isset($_SESSION['profil']) && $_SESSION['profil'] == 'admin';

                echo listEmploye($admin,$employes,$allChef);
                die;
            } 
            catch (ServiceException $se) {
                $employes = $serviceEmployes->searchAll();

                /********************************** CHERCHE LA LISTE DES SUPERIEURS */              
                $allChef = $serviceEmployes->allSuperieur();

                /***************************VERIFICATION PROFIL*****/
                $admin = isset($_SESSION['profil']) && $_SESSION['profil'] == 'admin';

                echo listEmploye($admin,$employes,$allChef,$se->getMessage(),$se->getCode());
                die;
            }           
        }
    }
}


try {
    /************************************** Recupere toutes les valeurs */
    $employes = $serviceEmployes->searchAll(); 

    /********************************** CHERCHE LA LISTE DES SUPERIEURS */
    $allChef = $serviceEmployes->allSuperieur();
    
    /***************************VERIFICATION PROFIL*****/
    $admin = isset($_SESSION['profil']) && $_SESSION['profil'] == 'admin';

    /*****************VERIFICATION CONNEXION ****/
    if (!isset($_SESSION['userName'])) {
        header("Location: index.php");
    }
    else {   
        echo listEmploye($admin,$employes,$allChef);
    }
}
catch (ServiceException $se) {
    $employes = $serviceEmployes->searchAll(); 

    $allChef = $serviceEmployes->allSuperieur();
    
    $admin = isset($_SESSION['profil']) && $_SESSION['profil'] == 'admin';

    /*****************VERIFICATION CONNEXION ****/
    if (!isset($_SESSION['userName'])) {
        header("Location: index.php");
    }
    else {   
        echo listEmploye($admin,$employes,$allChef,$se->getMessage(),$se->getCode());
    }
}



