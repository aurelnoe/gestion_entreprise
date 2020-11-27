<?php

include_once("InterfaceDAO.php");

interface InterfaceEmploye extends DAOInterface
{
    public function allSuperieur(); 
}
