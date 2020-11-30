<?php
include_once("../Modele/Class/Employe.php");
include_once("../Modele/Class/Connexion.php");
include_once("../Modele/Interfaces/InterfaceDAO.php");
require_once("../Modele/Exceptions/DAOException.php");

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

class EmployeMYSQLIDAO extends Connexion implements DAOInterface,InterfaceEmploye
{
    /******************* ADD EMPLOYES*****************************/
    public function add(object $employe)
    {   
        try {
            $connexion = new Connexion();
            $db = $connexion->connexion(); 

            $getNoemploye = $employe->getNoEmploye();
            $getNom = $employe->getNom();
            $getPrenom = $employe->getPrenom();
            $getEmploi = $employe->getEmploi();
            $getEmbauche = $employe->getEmbauche()->format('Y-m-d');
            $getSalaire = $employe->getSalaire();
            $getCommission = $employe->getCommission();
            $getSup = $employe->getSup();
            $getNoService = $employe->getNoService();
            $getNoProj = $employe->getNoProj();

            $query = "INSERT INTO employes VALUES (?,?,?,?,?,?,?,NULL,?,?,?)";            
            $stmt = $db->prepare($query); 
            $stmt->bind_param("issssddiii",$getNoemploye,$getNom,$getPrenom,$getEmploi,$getEmbauche,$getSalaire,$getCommission,$getSup,$getNoService,$getNoProj);
            $stmt->execute();
        }
        catch (mysqli_sql_exception $e) {
            throw new DAOException($e->getMessage(),$e->getCode());
        }
        finally{
            $db->close();
        }
    }

    /******************* UPDATE EMPLOYES*****************************/

    public function update(object $employe)
    { 
        try {
            $connexion = new Connexion();
            $db = $connexion->connexion(); 

            $getNoEmploye = $employe->getNoEmploye();
            $getNom = $employe->getNom();
            $getPrenom = $employe->getPrenom();
            $getEmploi = $employe->getEmploi();
            $getEmbauche = $employe->getEmbauche()->format('Y-m-d');
            $getSalaire = $employe->getSalaire();
            $getCommission = $employe->getCommission();
            $getSup = $employe->getSup();
            $getNoService = $employe->getNoService();
            $getNoProj = $employe->getNoProj();
            // var_dump($getNoEmploye);
            $query = "UPDATE employes 
                        SET nom = ?,
                            prenom = ?,
                            emploi = ?,
                            embauche = ?,
                            salaire = ?,
                            commission = ?,
                            sup = ?,
                            no_service = ?,
                            NOPROJ = ?
                        WHERE noEmploye = ?";  

            $stmt = $db->prepare($query);
            $stmt->bind_param("ssssddiiii",$getNom,$getPrenom,$getEmploi,$getEmbauche,$getSalaire,$getCommission,$getSup,$getNoService,$getNoProj,$getNoEmploye);
            $stmt->execute();
        } 
        catch (mysqli_sql_exception $e) {
            throw new DAOException($e->getMessage(),$e->getCode());
            die;
        }
        finally{
            $db->close();
        }
    }

    /******************* DELETE EMPLOYES*****************************/

    public function delete($getNoEmploye)
    {
        try {
            $connexion = new Connexion();
            $db = $connexion->connexion();

            $query = "DELETE FROM employes WHERE noEmploye = ?";
            $stmt = $db->prepare($query);
            $stmt->bind_param("i", $getNoEmploye);
            $stmt->execute();
        } 
        catch (mysqli_sql_exception $e) {
            throw new DAOException($e->getMessage(),$e->getCode());           
        }
        finally{
            $db->close();
        }         
    }

    /************ SEARCH ALL EMPLOYES ******************/
            
    public function searchAll():?array
    {
        try {
            $connexion = new Connexion();
            $db = $connexion->connexion();

            $query = 'SELECT * FROM employes';
            $stmt = $db->prepare($query);
            $stmt->execute();
            $rs = $stmt->get_result();
            $employes = $rs->fetch_all(MYSQLI_ASSOC);

            $allEmployes = array();

            foreach ($employes as $value) 
            {
                $newEmbauche = new DateTime($value['embauche']);

                $employe = new Employe();
                $employe->setNoEmploye($value['noEmploye'])
                        ->setNom($value['nom'])
                        ->setPrenom($value['prenom'])
                        ->setEmploi($value['emploi'])       
                        ->setEmbauche($newEmbauche)  
                        ->setSalaire($value['salaire'])
                        ->setCommission($value['commission'])
                        ->setSup($value['sup'])
                        ->setNoService($value['no_service'])
                        ->setNoProj($value['NOPROJ']);

                array_push($allEmployes,$employe);
            }           
            if (empty($allEmployes)) {
                throw new DAOException("Aucun supérieur n'a été trouvé", 9998);
            }
            return $allEmployes; 
            
        }catch (mysqli_sql_exception $e) {
            throw new DAOException($e->getMessage(),$e->getCode());           
        } 
        finally{
            $rs->free(); 
            $db->close();  
        }
    }

    /************ SEARCH EMPLOYE ******************/

    public function searchById($getNoEmploye)
    {
        try {
            $connexion = new Connexion();
            $db = $connexion->connexion();
            
            $query = "SELECT * FROM employes WHERE noEmploye = ?";   
            $stmt = $db->prepare($query);
            $stmt->bind_param("i", $getNoEmploye);
            $stmt->execute();       
            $rs = $stmt->get_result();
            $employe = $rs->fetch_array(MYSQLI_ASSOC);

            $newEmbauche = new DateTime($employe['embauche']);
            $newDateAjout = new DateTime($employe['dateAjout']);

            $newEmploye = new Employe();
            $newEmploye ->setNoEmploye($employe['noEmploye'])
                        ->setNom($employe['nom'])
                        ->setPrenom($employe['prenom'])
                        ->setEmploi($employe['emploi'])       
                        ->setEmbauche($newEmbauche)   
                        ->setSalaire($employe['salaire'])
                        ->setCommission($employe['commission'])
                        ->setDateAjout($employe['dateAjout'])
                        ->setSup($employe['sup'])
                        ->setNoService($employe['no_service'])
                        ->setNoProj($employe['NOPROJ']);
                        
            if (empty($newEmploye)) {
                throw new DAOException("L'employé n'a pas été trouvé dans la base de données",9999);
            }
            //var_dump($newEmploye);
            return $newEmploye;  

        }catch (mysqli_sql_exception $e) {
            throw new DAOException($e->getMessage(),$e->getCode());           
        } 
        finally{
            $db->close();
            $rs->free();
        }
    }

    /********** RETOURNE LA LISTE DES SUPERIEURS ******************/

    public function allSuperieur()
    {
        try {
            $connexion = new Connexion();
            $db = $connexion->connexion();
            
            $query = "SELECT DISTINCT sup FROM employes"; 

            $stmt = $db->prepare($query);
            $stmt->execute();       
            $rs = $stmt->get_result();
            $chef = $rs->fetch_all(MYSQLI_ASSOC);

            $allChef = array();
            $i = 1;
            foreach ($chef as $numchef) 
            {
                $newchef = new Employe();
                $newchef->setSup($numchef['sup']);
                $allChef[$i] = $newchef->getSup();
                $i++;
            }               
            return $allChef;
            
        } 
        catch (mysqli_sql_exception $e) {
            throw new DAOException($e->getMessage(),$e->getCode());           
        } 
        finally{
            $db->close();
            $rs->free();
        }     
    }

    public function compteur(string $date)
    {
        try {
            $connexion = new Connexion();
            $db = $connexion->connexion();
            //echo $date;
            $query = "SELECT COUNT(dateAjout) AS dateAjout FROM employes WHERE DATE_FORMAT(dateAjout,'%Y-%m-%d') = ?";
            $stmt = $db->prepare($query);
            $stmt->bind_param("s", $date);
            $stmt->execute();       
            $rs = $stmt->get_result();
            $compteur = $rs->fetch_array(MYSQLI_ASSOC);
            //echo ($compteur["dateAjout"]);
            return $compteur;
        }
        catch (mysqli_sql_exception $e) {
            throw new DAOException($e->getMessage(),$e->getCode());           
        } 
        finally{
            $db->close();
        }
    }

    public function filter()
    {
        try {
            $connexion = new Connexion();
            $db = $connexion->connexion();

            $query = 'SELECT nom,prenom,emploi FROM employes';
            $stmt = $db->prepare($query);
            $stmt->execute();
            $rs = $stmt->get_result();
            $employes = $rs->fetch_all(MYSQLI_ASSOC);

            $allEmployes = array();

            foreach ($employes as $value) 
            {
                $newEmbauche = new DateTime($value['embauche']);

                $employe = new Employe();
                $employe->setNom($value['nom'])
                        ->setPrenom($value['prenom'])
                        ->setEmploi($value['emploi'])       
                        ->setEmbauche($newEmbauche)  
                        ->setSalaire($value['salaire'])
                        ->setCommission($value['commission'])
                        ->setSup($value['sup'])
                        ->setNoService($value['no_service'])
                        ->setNoProj($value['NOPROJ']);

                array_push($allEmployes,$employe);
            }           
            if (empty($allEmployes)) {
                throw new DAOException("Aucun supérieur n'a été trouvé", 9998);
            }
            return $allEmployes; 
            
        }catch (mysqli_sql_exception $e) {
            throw new DAOException($e->getMessage(),$e->getCode());           
        } 
        finally{
            $rs->free(); 
            $db->close();  
        }
    
    }
}


// $allMissions = array();
        // $i = 1;
        // foreach ($missions as $mission) 
        // {
        //     $newDateDebut = new DateTime($mission['date_debut']);
        //     $newDateAjout = new DateTime($mission['date_ajout']);
        //     $newMission = new Mission();
        //     $newMission->setIdMission($mission['id_mission'])
        //                ->setTitreMission($mission['titre_mission'])
        //                ->setDescriptionMission($mission['description_mission'])
        //                ->setTypeFormation($mission['type_formation'])
        //                ->setImageMission($mission['image_mission'])
        //                ->setDateDebut($newDateDebut)
        //                ->setDuree($mission['duree'])
        //                ->setDateAjout($newDateAjout)
        //                ->setIdPays($mission['id_pays'])
        //                ->setIdEtablissement($mission['id_etablissement'])
        //                ->setIdTypeActivite($mission['id_type_activite']);
        //     $allMissions[$i] = $newMission;
        //     $i++;
        // } 