<?php
include_once("../Modele/DAO/ServiceMYSQLIDAO.php");
require_once("../Modele/Exceptions/DAOException.php");

class ServiceService 
{
    public function add(Service $service)
    {   
        try {
            return ServiceMYSQLIDAO::add($service);
        } 
        catch (DAOException $de) {
            throw new ServiceException($de->getMessage(),$de->getCode());
        }  
    }

    public function update(Service $service)
    {
        try {
            return ServiceMYSQLIDAO::update($service); 
        } 
        catch (DAOException $de) {
            throw new ServiceException($de->getMessage(),$de->getCode());
        }  
    }

    public function delete($get)
    {
        try {
            ServiceMYSQLIDAO::delete($get);
        } 
        catch (DAOException $de) {
            throw new ServiceException($de->getMessage(),$de->getCode());
        }  
        
    }

    public function searchAll()
    {
        try {
            $services = ServiceMYSQLIDAO::searchAll();
            return $services;
        } 
        catch (DAOException $de) {
            throw new ServiceException($de->getMessage(),$de->getCode());
        } 
        
    }

    public function serviceAffect()
    {
        try {
            $serviceAffect = ServiceMYSQLIDAO::serviceAffect();
            return $serviceAffect;
        } 
        catch (DAOException $de) {
            throw new ServiceException($de->getMessage(),$de->getCode());
        } 
    }

    /******* PAGE DETAILS SERVICE **********/
    public function searchById($getNoService)
    {
        try {
            $service = ServiceMYSQLIDAO::searchById($getNoService);        
            return $service;            
        } 
        catch (DAOException $de) {
            throw new ServiceException($de->getMessage(),$de->getCode());
        } 
    }
}

