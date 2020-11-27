<?php
require_once("C:/xampp/htdocs/AFPARoubaix/PHP/gestion_entreprise/Modele/Exceptions/ConnexionException.php");

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

class Connexion
{
    public function connexion(){
        try {          
            $db = new mysqli('localhost','root','','entreprise');  

            return $db;
        }
        catch (ConnexionException $e) {
            throw new ConnexionException("Erreur lors de la connexion à la base de données",6666);
        }
    }
}
