<?php

final class Employe{

    private $noEmploye;
    private $nom;
    private $prenom;
    private $emploi;
    private $embauche;
    private $salaire;
    private $commission;
    private $dateAjout;
    private $sup;
    private $no_service;
    private $NOPROJ;
    
    // public function __construct( int $newNoEmploye,
    //                              string $newNom,
    //                              string $newPrenom, 
    //                              string $newEmploi, 
    //                              string $newEmbauche, 
    //                              int $newSalaire, 
    //                              int $newCommission,
    //                              int $newSup,
    //                              int $newNoService,
    //                              int $newNoProj)
    // {
    //     $this->noEmploye = $newNoEmploye;
    //     $this->nom = $newNom;
    //     $this->prenom = $newPrenom;
    //     $this->emploi = $newEmploi;
    //     $this->embauche = $newEmbauche;
    //     $this->salaire = $newSalaire;
    //     $this->commission = $newCommission;
    //     $this->sup = $newSup;
    //     $this->noService = $newNoService;
    //     $this->noProj = $newNoProj;
    // }

    /************************************************/
    public function __toString()
    {
        return " [Num employé] : " . $this->noEmploye
             . " \n[Nom] : " . $this->nom
             . " \n[Prenom] : " . $this->prenom 
             . " \n[Emploi] : " . $this->emploi 
             . " \n[Embauche] : " . $this->embauche 
             . " \n[Salaire] : " . $this->salaire 
             . " \n[Commission] : " . $this->commission
             . " \n[Date Ajout] : " . $this->dateAjout 
             . " \n[Supérieur] : " . $this->sup 
             . " \n[Num Service] : " . $this->no_service 
             . " \n[Num projet] : " . $this->NOPROJ;
    }

    public function jsonSerialize() {
        return [
            'Id'         => $this->getNoEmploye(),
            'Nom'        => $this->getNom(),
            'Prenom'     => $this->getPrenom(),
            'Emploi'     => $this->getEmploi(),
            'Slaire'     => $this->getSalaire(),
            'Commission' => $this->getCommission(),
            'Date Ajout' => $this->getdateAjout(),
            'Supérieur'  => $this->getSup(),
            'noService'  => $this->getNoService(),
            'noProjet'   => $this->getNoProj()
        ];
}

    /**** Converti datetime en string */
    public function dateTimeToString($datetime):?string
    {
        return $dateToString = $datetime->format('d-m-Y');
    }

    public function getNoEmploye():?int
    {
        return $this->noEmploye;
    }

    public function setNoEmploye(?int $noEmploye):self
    {
        $this->noEmploye = $noEmploye;

        return $this;
    }
    
    
    public function getNom():string 
    {
        return $this->nom;
    }
    
    public function setNom(string $nom) :self 
    {
        $this->nom = $nom;
        return $this;
    }
    
    public function getPrenom():string 
    {
        return $this->prenom;
    }
    
    public function setPrenom(string $prenom) :self 
    {
        $this->prenom = $prenom;
        return $this;
    }

    public function getEmploi():string 
    {
        return $this->emploi;
    }
    
    public function setEmploi(string $emploi) :self 
    {
        $this->emploi = $emploi;
        return $this;
    }

    public function getEmbauche():?DateTime 
    {
        return $this->embauche;
    }
    
    public function setEmbauche($newEmbauche) :self 
    {
        //$emb = new DateTime($newEmbauche);

        $this->embauche = $newEmbauche;
        return $this;
    }

    public function getSalaire():?float 
    {
        return $this->salaire;
    }
    
    public function setSalaire(?float $salaire) :self 
    {
        $this->salaire = $salaire;
        return $this;
    }

    public function getCommission():?float 
    {
        return $this->commission;
    }
    
    public function setCommission(?float $commission):self 
    {
        $this->commission = $commission;
        return $this;
    }

    /**
     * Get the value of dateAjout
     */ 
    public function getDateAjout():DateTime
    {
        $newDate = new DateTime($this->dateAjout);
        return $newDate ;
    }

    /**
     * Set the value of dateAjout
     *
     * @return  self
     */ 
    public function setDateAjout($dateAjout):self
    {
        $this->dateAjout = $dateAjout;
        return $this;
    }

    public function getSup():?int 
    {
        return $this->sup;
    }
    
    public function setSup(?int $sup) :self 
    {
        $this->sup = $sup;
        return $this;
    }

    /**
     *
     */
    public function getNoService():?int 
    {
        return $this->no_service;
    }
    /**
     * @param mixed $noService 
     */
    public function setNoService(int $noService) :self 
    {
        $this->no_service = $noService;
        return $this;
    }

    public function getNoProj():?int {
        return $this->NOPROJ;
    }
    
    public function setNoProj(?int $noProj) :self {
        $this->NOPROJ = $noProj;
        return $this;
    }
}