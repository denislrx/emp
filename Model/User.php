<?php

class User
{
    private $idUser;
    private $nom;
    private $mdp;
    private $profil;



    /**
     * Get the value of idUser
     */
    public function getIdUser(): int
    {
        return $this->idUser;
    }

    /**
     * Set the value of idUser
     *
     * @return  self
     */
    public function setIdUser(int $idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get the value of nom
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */
    public function setNom(string $nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of mdp
     */
    public function getMdp(): string
    {
        return $this->mdp;
    }

    /**
     * Set the value of mdp
     *
     * @return  self
     */
    public function setMdp(string $mdp)
    {
        $this->mdp = $mdp;

        return $this;
    }

    /**
     * Get the value of profil
     */
    public function getProfil(): string
    {
        return $this->profil;
    }

    /**
     * Set the value of profil
     *
     * @return  self
     */
    public function setProfil(string $profil)
    {
        $this->profil = $profil;

        return $this;
    }
}
