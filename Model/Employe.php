<?php

include_once("Service.php");
include_once("Projet.php");

class Employe
{
    protected $noEmp;
    protected $nom;
    protected $prenom;
    protected $emploi;
    protected $embauche;
    protected ?Employe $sup;
    protected $sal;
    protected $com;
    protected Service $service;
    protected Projet $projet;
    protected $saisie;

    /**
     * Get the value of noEmp
     */
    public function getNoEmp(): int
    {
        return $this->noEmp;
    }

    /**
     * Set the value of noEmp
     *
     * @return  self
     */
    public function setNoEmp(int $noEmp)
    {
        $this->noEmp = $noEmp;

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
     * Get the value of prenom
     */
    public function getPrenom(): string
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @return  self
     */
    public function setPrenom(string $prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get the value of emploi
     */
    public function getEmploi(): string
    {
        return $this->emploi;
    }

    /**
     * Set the value of emploi
     *
     * @return  self
     */
    public function setEmploi(string $emploi)
    {
        $this->emploi = $emploi;

        return $this;
    }

    /**
     * Get the value of embauche
     */
    public function getEmbauche(): string
    {
        return $this->embauche;
    }

    /**
     * Set the value of embauche
     *
     * @return  self
     */
    public function setEmbauche(string $embauche)
    {
        $this->embauche = $embauche;

        return $this;
    }

    /**
     * Get the value of sup
     */
    public function getSup(): ?Employe
    {
        return $this->sup;
    }

    /**
     * Set the value of sup
     *
     * @return  self
     */
    public function setSup(?Employe $sup)
    {
        $this->sup = $sup;

        return $this;
    }

    /**
     * Get the value of sal
     */
    public function getSal(): float
    {
        return $this->sal;
    }

    /**
     * Set the value of sal
     *
     * @return  self
     */
    public function setSal(float $sal)
    {
        $this->sal = $sal;

        return $this;
    }

    /**
     * Get the value of com
     */
    public function getCom(): ?float
    {
        return $this->com;
    }

    /**
     * Set the value of com
     *
     * @return  self
     */
    public function setCom(?float $com)
    {
        $this->com = $com;

        return $this;
    }




    /**
     * Get the value of saisie
     */
    public function getSaisie(): string
    {
        return $this->saisie;
    }

    /**
     * Set the value of saisie
     *
     * @return  self
     */
    public function setSaisie(string $saisie)
    {
        $this->saisie = $saisie;

        return $this;
    }

    /**
     * Get the value of service
     */
    public function getService(): Service
    {
        return $this->service;
    }

    /**
     * Set the value of service
     *
     * @return  self
     */
    public function setService(Service $service)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get the value of projet
     */
    public function getProjet(): Projet
    {
        return $this->projet;
    }

    /**
     * Set the value of projet
     *
     * @return  self
     */
    public function setProjet(Projet $projet)
    {
        $this->projet = $projet;

        return $this;
    }
}
