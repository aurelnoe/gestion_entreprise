<?php
session_start();
include("../Modele/Service/ServiceService.php");
include_once("../Presentation/PresentationUser.php"); 
include_once("../Presentation/PresentationService.php"); 
require_once("../Modele/Exceptions/ServiceException.php");

if (isset($_GET['action'])) {

    /***************** AJOUTER SERVICE **********************************/
    if ($_GET['action'] == 'add' && $_GET['no_service'] == "") 
    {
        if (!empty($_POST))
        {     
            /*****************VERIFICATION CONNEXION ****/
            if (!isset($_SESSION['userName'])) {
                header("Location :index.php");
            }

            $noservice = $_POST['no_service'];
            $libelle = is_null($_POST['libelle']) ? 'NULL' : $_POST['libelle'];
            $ville = is_null($_POST['ville']) ? 'NULL' : $_POST['ville'];

            $service = new Service();

            $service->setNoService($noservice)
                    ->setLibelle($libelle)
                    ->setVille($ville);
            try {
                ServiceService::add($service);
                     
                /************************************** Recupere toutes les valeurs */
                $services = ServiceService::searchAll();            
                
                /************************************* SEARCH 1 SERVICE DANS SERVICE*/
                $serviceAffect = ServiceService::serviceAffect(); 
                 
                $admin = isset($_SESSION['profil']) && $_SESSION['profil'] == 'admin';
    
                echo listServices($admin,$services,$serviceAffect);
                die;
            }    
            catch (ServiceException $se) {
                $services = ServiceService::searchAll();            
                $serviceAffect = ServiceService::serviceAffect(); 
                $admin = isset($_SESSION['profil']) && $_SESSION['profil'] == 'admin';
    
                echo listServices($admin,$services,$serviceAffect,$se->getCode());
                die;
            }
        }       
    }

    /***************** MODIFIER SERVICE **********************************/
    elseif ($_GET['action'] == 'update') 
    {
        if (!empty($_POST)) 
        {   
            /*****************VERIFICATION CONNEXION ****/
            if (!isset($_SESSION['userName'])) {
                echo formulaireConnexion();
            }
            $noService = $_GET['no_service'];
            $libelle = is_null($_POST['libelle']) ? 'NULL' : $_POST['libelle'];
            $ville = is_null($_POST['ville']) ? 'NULL' : $_POST['ville']; 

            $service = new Service();
            $service->setNoService($noService)
                    ->setLibelle($libelle)
                    ->setVille($ville);                    
            try {
                ServiceService::update($service);   
                 
                /************************************** Recupere toutes les valeurs */           
                $services = ServiceService::searchAll();           
                /************************************* SEARCH 1 SERVICE DANS SERVICE*/          
                $serviceAffect = ServiceService::serviceAffect(); 
                $admin = isset($_SESSION['profil']) && $_SESSION['profil'] == 'admin';
    
                echo listServices($admin,$services,$serviceAffect);
                die;
            } 
            catch (ServiceException $se) {
                $services = ServiceService::searchAll();           
                $serviceAffect = ServiceService::serviceAffect(); 
                $admin = isset($_SESSION['profil']) && $_SESSION['profil'] == 'admin';
    
                echo listServices($admin,$services,$serviceAffect,$se->getCode());
                die;
            }
            
        }
    }
    /***************** SUPPRIMER SERVICE **********************************/
    elseif ($_GET['action'] == 'delete') 
    {
        if (!empty($_GET['no_service'])) 
        {
            /*****************VERIFICATION CONNEXION ****/
            if (!isset($_SESSION['userName'])) {
                echo formulaireConnexion();
            }
            try {
                ServiceService::delete($_GET['no_service']);          

                /************************************** Recupere toutes les valeurs */
                $services = ServiceService::searchAll(); 
           
                /************************************* SEARCH 1 SERVICE DANS SERVICE*/
                $serviceAffect = ServiceService::serviceAffect(); 
                $admin = isset($_SESSION['profil']) && $_SESSION['profil'] == 'admin';
    
                echo listServices($admin,$services,$serviceAffect);
                die;
            } 
            catch (ServiceException $se) {
                $services = ServiceService::searchAll(); 
                $serviceAffect = ServiceService::serviceAffect(); 
                $admin = isset($_SESSION['profil']) && $_SESSION['profil'] == 'admin';
    
                echo listServices($admin,$services,$serviceAffect,$se->getCode());
                die;
            }
            
        }
    }
}

/************************************** Recupere toutes les valeurs */
try {
    $services = ServiceService::searchAll(); 

    $serviceAffect = ServiceService::serviceAffect(); 
    $admin = isset($_SESSION['profil']) && $_SESSION['profil'] == 'admin';
    if (!isset($_SESSION['userName'])) {
        echo formulaireConnexion();
    }
    else {
        echo listServices($admin,$services,$serviceAffect);
    }
} 
catch (ServiceException $se) {
    $serviceAffect = ServiceService::serviceAffect(); 
    $admin = isset($_SESSION['profil']) && $_SESSION['profil'] == 'admin';
    if (!isset($_SESSION['userName'])) {
        echo formulaireConnexion();
    }
    else {
        echo listServices($admin,$services,$serviceAffect,$se->getCode());
    }
}

