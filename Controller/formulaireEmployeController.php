<?php
session_start();
include_once("../Modele/Service/ServiceEmploye.php");
include_once("../Presentation/PresentationUser.php"); 
include_once("../Presentation/PresentationEmploye.php");
require_once("../Modele/Exceptions/ServiceException.php"); 

if (isset($_GET['action'])) 
{
    if (isset($_SESSION['profil']) && $_SESSION['profil']=='utilisateur') {
        header('Location: ../index.php');
    }
    if ($_GET['action'] == 'update') 
    {  
        try {
            $newEmploye = new ServiceEmploye();
            $employe = $newEmploye->searchById($_GET['noEmploye']);
            
            $title = 'Modification service';
            $titleBtn = 'Modifier';
            $action = 'update';     
        
            echo formulaireEmploye($title,$employe,$titleBtn,$action);
            die;
        } 
        catch (ServiceException $se) {
            $newEmploye = new ServiceEmploye();
            $employe = $newEmploye->searchById($_GET['noEmploye']);
            
            $title = 'Modification service';
            $titleBtn = 'Modifier';
            $action = 'update';     
        
            echo formulaireEmploye($title,$employe,$titleBtn,$action,$se->getCode());
            die;
        }
    } 
    elseif ($_GET['action'] == 'add') {
        try {
            $title = 'Ajouter un employé';
            $titleBtn = 'ajouter';
            $action = 'add';
            $affiche = "";
            echo formulaireEmploye($title,$affiche,$titleBtn,$action);
            die;     
        } catch (ServiceException $se) {
            $title = 'Ajouter un employé';
            $titleBtn = 'ajouter';
            $action = 'add';
            $affiche = "";
            echo formulaireEmploye($title,$affiche,$titleBtn,$action,$se->getCode());
            die;
        }
    }
}

