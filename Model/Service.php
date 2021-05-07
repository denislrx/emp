<?php

class Service
{
    protected $noServ;
    protected $serv;
    protected $ville;



    /**
     * Get the value of noServ
     */
    public function getNoServ(): int
    {
        return $this->noServ;
    }

    /**
     * Set the value of noServ
     *
     * @return  self
     */
    public function setNoServ(int $noServ)
    {
        $this->noServ = $noServ;

        return $this;
    }

    /**
     * Get the value of serv
     */
    public function getServ(): string
    {
        return $this->serv;
    }

    /**
     * Set the value of serv
     *
     * @return  self
     */
    public function setServ(string $serv)
    {
        $this->serv = $serv;

        return $this;
    }

    /**
     * Get the value of ville
     */
    public function getVille(): string
    {
        return $this->ville;
    }

    /**
     * Set the value of ville
     *
     * @return  self
     */
    public function setVille(string $ville)
    {
        $this->ville = $ville;

        return $this;
    }
}
