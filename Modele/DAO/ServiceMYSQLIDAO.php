<?php
include_once("../Modele/Class/Service.php"); 
include_once("../Modele/Class/Connexion.php");
include_once("../Modele/Interfaces/InterfaceDAO.php");
require_once("../Modele/Exceptions/DAOException.php");

class ServiceMYSQLIDAO extends Connexion implements DAOInterface,InterfaceService
{    
   /******************* ADD SERVICE****************************/

    public function add(object $service)
    {
        try {
            $connexion = new Connexion();
            $db = $connexion->connexion();

            $getnoService = $service->getNoService();
            $getLibelle = $service->getLibelle();
            $getVille = $service->getVille();
                    
            $query = "INSERT INTO service VALUES (?,?,?)";           
            $stmt = $db->prepare($query); 
            $stmt->bind_param("iss",$getnoService,$getLibelle,$getVille);
            $stmt->execute();            
        } 
        catch (mysqli_sql_exception $e) {
            throw new DAOException($e->getMessage(),$e->getCode());
        }
        finally{
            $db->close(); 
        }
    }

    /******************* UPDATE SERVICE****************************/

    public function update(object $service)
    {   
        try {
            $connexion = new Connexion();
            $db = $connexion->connexion();

            $getNoService = $service->getNoService();
            $getLibelle = $service->getLibelle();
            $getVille = $service->getVille();

            $query = "UPDATE service SET libelle = ?, ville = ? WHERE no_service = ?";
            $stmt = $db->prepare($query); 
            $stmt->bind_param("ssi",$getLibelle,$getVille,$getNoService);
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

    /******************* DELETE SERVICE****************************/

    public function delete($getNoService)
    {
        try {
            $connexion = new Connexion();
            $db = $connexion->connexion();

            $query = "DELETE FROM service WHERE no_service = ?";
            $stmt = $db->prepare($query);
            $stmt->bind_param("i", $getNoService);
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

    /************ SEARCH ALL SERVICES ******************/

    public function searchAll()
    {
        try {
            $connexion = new Connexion();
            $db = $connexion->connexion();
            $query='SELECT * FROM service';
            $stmt = $db->prepare($query);
            $stmt->execute();
            $rs = $stmt->get_result();
            $services = $rs->fetch_all(MYSQLI_ASSOC);   

            $allServices = array(); 

            foreach ($services as $value) {
                $service = new Service();
                $service->setNoService($value['no_service'])->setLibelle($value['libelle'])->setVille($value['ville']);
                array_push($allServices,$service);
            }          
            if (empty($allServices)) {
                throw new DAOException("Aucun service n'a été trouvé",9997);
            }
            // return json_encode($allServices);
            return $allServices;
        }
        catch (mysqli_sql_exception $e) {
            throw new DAOException($e->getMessage(),$e->getCode());           
        }
        finally{
            $rs->free(); 
            $db->close();  
        }        
    }

    /************ SEARCH SERVICE ******************/

    public function searchById($getNoService)
    {
        try {
            $connexion = new Connexion();
            $db = $connexion->connexion();

            $query = "SELECT * FROM service WHERE no_service = ?";
            $stmt = $db->prepare($query);
            $stmt->bind_param("i", $getNoService);
            $stmt->execute();       
            $rs = $stmt->get_result();
            $service = $rs->fetch_object("Service"); 
          
            if (empty($service)) {
                throw new DAOException("Le service n'existe pas",9996);
            }
            return $service;
        }
        catch (mysqli_sql_exception $e) {
            throw new DAOException($e->getMessage(),$e->getCode());           
        }
        finally{
            $rs->free(); 
            $db->close();  
        }        
    }

    /*********** SEARCH EMPLOYE DANS SERVICE ****************/

    public function serviceAffect()
    {
        try {
            $connexion = new Connexion();
            $db = $connexion->connexion();
            
            $query = "SELECT DISTINCT no_service FROM employes";  

            $stmt = $db->prepare($query);
            $stmt->execute();       
            $rs = $stmt->get_result();
            $data = $rs->fetch_all(MYSQLI_ASSOC);

            $allServices = array();
            $i = 1; 
            foreach ($data as $value) {
                $service = new Service();
                $service->setNoService($value['no_service']);
                $allServices[$i] = $service->getNoService();
                $i++;
            }           
            if (empty($allServices)) {
                throw new DAOException("Aucun service affecté n'a été trouvé",9995);
            }
            return $allServices;

        }catch (mysqli_sql_exception $e) {
            throw new DAOException($e->getMessage(),$e->getCode());           
        }
        finally{
            $rs->free(); 
            $db->close();  
        }             
    }
}