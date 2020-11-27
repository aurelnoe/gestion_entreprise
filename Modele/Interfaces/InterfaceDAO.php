<?php
include_once("InterfaceEmploye.php");
include_once("InterfaceService.php");

interface DAOInterface
{
    public function add(object $objet);

    public function update(object $objet);

    public function delete(int $id);

    public function searchById(int $id);

    public function searchAll();
}
