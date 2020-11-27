<?php 

class User
{
    private $id;
    private $userName;
    private $password;
    private $profil;//='utilisateur'

    public function __toString()
    {
        return
        $this->id;
        $this->userName;
        $this->password;
        $this->profil;
    }

    /**
     * Get the value of userName
     */ 
    public function getUserName():string
    {
        return $this->userName;
    }

    /**
     * Set the value of userName
     *
     * @return  self
     */ 
    public function setUserName(string $userName):self
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword():string
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword(string $password):self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of profil
     */ 
    public function getProfil():string
    {
        return $this->profil;
    }

    /**
     * Set the value of profil
     *
     * @return  self
     */ 
    public function setProfil(string $profil):self
    {
        self::$profil = $profil;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }   
}
