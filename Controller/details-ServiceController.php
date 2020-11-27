<?php
session_start();
include("../Modele/Service/ServiceService.php");
include_once("../Presentation/PresentationUser.php"); 
include_once("../Presentation/PresentationService.php");
require_once("../Modele/Exceptions/ServiceException.php");

/******* PAGE DETAILS SERVICE **********/

try {
    $service = ServiceService::searchById($_GET['no_service']);

    if (!isset($_SESSION['userName'])) {
        header("Location: index.php");
    }
    else {
        echo detailsService($service);
    }
} 
catch (ServiceException $ee) {
    if (!isset($_SESSION['userName'])) {
        header("Location: index.php");
    }
    else {
        echo detailsService($service,$se->getMessage(),$se->getCode());
    }
}
