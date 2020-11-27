<?php

include_once('Class/Employe.php');
include_once('Class/Service.php');

$service1 = new Service();
$service1->setNoService(9)
         ->setLibelle("ELECTRICITE")
         ->setVille("LYON");

$service2 = new Service();
$service2->setNoService(10)
         ->setLibelle("COUVREUR")
         ->setVille("MONTPELLIER");

echo $service1;

echo $service2;


$employe1 = new Employe();
$employe1->setNoEmploye(1026)
         ->setNom("Dupond")
         ->setPrenom("Maurice")
         ->setEmploi("SECRETAIRE")
         ->setEmbauche("2020-10-27")
         ->setSalaire(2500)
         ->setCommission(1050)
         ->setSup(1100)
         ->setNoService($service1->getNoService())
         ->setNoProj(102);

$employe2 = new Employe();
$employe2->setNoEmploye(1026)
         ->setNom("Dupondelle")
         ->setPrenom("Mauricette")
         ->setEmploi("INFIRMIERE")
         ->setEmbauche("2020-10-26")
         ->setSalaire(2500)
         ->setCommission(1050)
         ->setSup(1200)
         ->setNoService(($service2->getNoService()))
         ->setNoProj(102);

$employe3 = new Employe();
$employe3->setNoEmploye(1026)
         ->setNom("DOUDOU")
         ->setPrenom("DADA")
         ->setEmploi("COMPTABLE")
         ->setEmbauche("2020-10-25")
         ->setSalaire(2500)
         ->setCommission(1050)
         ->setSup(1000)
         ->setNoService($service1->getNoService())
         ->setNoProj(102);

// $employe4 = new Employe();
// $employe4->setNoEmploye(1026)
//          ->setNom("JAJA")
//          ->setPrenom("LOULOU")
//          ->setEmploi("RECRUTEUSE")
//          ->setEmbauche("2020-10-24")
//          ->setSalaire(2500)
//          ->setCommission(1050)
//          ->setSup(1100)
//          ->setNoService(2)
//          ->setNoProj(102);

         
echo $employe1;

echo $employe2;

echo $employe3;
