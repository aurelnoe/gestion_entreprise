<?php

final class Service implements JsonSerializable
{    
    private $no_service;
    private $libelle;
    private $ville;
    
    // public function __construct(int $newNoService, 
    //                             string $newLibelle, 
    //                             string $newVille)
    // {
    //     $this->noService = $newNoService;
    //     $this->libelle = $newLibelle;
    //     $this->ville = $newVille;
    // }
        
    
    public function __toString() :string
    {
        return 
        "[Num service] : " . $this->noService 
        . " \n[Nom du service] : " . $this->libelle 
        . " \n[Ville] : " . $this->ville;
    }

    public function jsonSerialize() 
    {    
        $vars = get_object_vars($this);
        return $vars;
    }

    public function getNoService(): int 
    {
        return $this->no_service;
    }
    
    public function setNoService(int $noService) :self 
    {
        $this->no_service = $noService;
        return $this;
    }
    
    public function getLibelle():string
    {
        //var_dump($this->libelle);
        return $this->libelle;
    }
    
    public function setLibelle(string $libelle) :self 
    {
        $this->libelle = $libelle;
        return $this;
    }
    
    public function getVille():string
    {
        return $this->ville;
    }
    
    public function setVille(string $ville) :self 
    {
        $this->ville = $ville;
        return $this;
    }
}