<?php
session_start();
include("../Modele/Service/ServiceEmploye.php");
include_once("../Presentation/PresentationUser.php"); 
include_once("../Presentation/PresentationEmploye.php");
require_once("../Modele/Exceptions/ServiceException.php");

try {
    $newEmploye = new ServiceEmploye();
    $employe = $newEmploye->searchById($_GET['noEmploye']);
    $admin = isset($_SESSION['profil']) && $_SESSION['profil'] == 'admin';
    
    if (!isset($_SESSION['userName'])) {
        echo connexionUser();
    }
    else {
        echo detailsEmploye($admin,$employe);
    }
} 
catch (ServiceException $se) {
    $employe = $newEmploye->searchById($_GET['noEmploye']);
    $admin = isset($_SESSION['profil']) && $_SESSION['profil'] == 'admin';
    
    if (!isset($_SESSION['userName'])) {
        echo connexionUser();
    }
    else {
        echo detailsEmploye($admin,$employe,$se->getMessage(),$se->getCode());
    }
}
