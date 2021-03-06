<?php
include_once("../Modele/DAO/EmployeMYSQLIDAO.php");
require_once("../Modele/Exceptions/DAOException.php");

class ServiceEmploye
{
    private $employeDAO;

    public function __construct()
    {
        return $this->employeDAO = new EmployeMYSQLIDAO();
    }

    public function add(Employe $employe)
    {   
        try {
            return $this->employeDAO->add($employe);
        } 
        catch (DAOException $de) {
            throw new ServiceException($de->getMessage(),$de->getCode());
        }       
    }

    public function update(Employe $employe)
    {
        try {
            return $this->employeDAO->update($employe, $_GET['noEmploye']); 
        }
        catch (DAOException $de) {
            throw new ServiceException($de->getMessage(),$de->getCode());
        }
    }

    public function delete($get)
    {
        try {
            $this->employeDAO->delete($get);
        }
        catch (DAOException $de) {
            throw new ServiceException($de->getMessage(),$de->getCode());
        }        
    }

    public function searchAll()
    {
        try {
            $employes = $this->employeDAO->searchAll();
            return $employes;
        } 
        catch (DAOException $de) {
            throw new ServiceException($de->getMessage(),$de->getCode());
        }        
    }

    public function allSuperieur()
    {
        try {
            $allChef = $this->employeDAO->allSuperieur();      
            return $allChef;
        }
        catch (DAOException $de) {
            throw new ServiceException($de->getMessage(),$de->getCode());
        }       
    }
   
    /******* PAGE DETAILS EMPLOYE ET FORMULAIRES**********/
    public function searchById($getNoEmploye)
    {
        try {
            $employe = $this->employeDAO->searchById($getNoEmploye);      
            return $employe;
        }
        catch (DAOException $de) {
            throw new ServiceException($de->getMessage(),$de->getCode());
        }   
    }

    public function compteur($date)
    {
        try {
            $compteur = $this->employeDAO->compteur($date);   
              
            return $compteur;
        }
        catch (DAOException $de) {
            throw new ServiceException($de->getMessage(),$de->getCode());
        }   
    }

    public function filter($requete)
    {
        try {
            $employesFiltre = $this->employeDAO->filter($requete);   
              
            return $employesFiltre;
        }
        catch (DAOException $de) {
            throw new ServiceException($de->getMessage(),$de->getCode());
        }   
    }

    /**
     * Get the value of employeDAO
     */ 
    public function getEmployeDAO()
    {
        return $this->employeDAO;
    }

    /**
     * Set the value of employeDAO
     *
     * @return  self
     */ 
    public function setEmployeDAO($employeDAO)
    {
        $this->employeDAO = $employeDAO;

        return $this;
    }
}

?>  