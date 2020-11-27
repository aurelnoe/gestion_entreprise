<?php
session_start();
include_once("../Modele/Service/ServiceService.php");
include_once("../Presentation/PresentationUser.php"); 
include_once("../Presentation/PresentationService.php"); 
require_once("../Modele/Exceptions/ServiceException.php");

if (isset($_GET['action'])) {

    if (isset($_SESSION['profil']) && $_SESSION['profil']=='utilisateur') {  //Si pas admin = pas accès
        header('Location: ../index.php');
    }
    if ($_GET['action'] == 'update') 
    {  
        try {
            $service = ServiceService::searchById($_GET['no_service']);
            $title = 'Modification service';
            $titleBtn = 'Modifier';
            $action = 'update';
    
            echo formulaireService($title,$service,$titleBtn,$action);
            die;
        } 
        catch (ServiceException $se) {
            $service = ServiceService::searchById($_GET['no_service']);
            $title = 'Modification service';
            $titleBtn = 'Modifier';
            $action = 'update';
    
            echo formulaireService($title,$service,$titleBtn,$action,$se->getMessage(),$se->getCode());
            die;
        }
        
    }
    elseif ($_GET['action'] == 'add') {
        try {
            $title = 'Ajouter un service';
            $titleBtn = 'ajout';
            $action = 'add';
            $affiche = "";
            echo formulaireService($title,$affiche,$titleBtn,$action);
            die;          
        } 
        catch (ServiceException $se) {
            $title = 'Ajouter un service';
            $titleBtn = 'ajout';
            $action = 'add';
            $affiche = "";
            echo formulaireService($title,$affiche,$titleBtn,$action,$se->getMessage(),$se->getCode());
            die; 
        }
    }
}
