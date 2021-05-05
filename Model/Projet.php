<?php

class Projet
{
    private $noProj;
    private $nomProj;
    private $budget;


    /**
     * Get the value of noProj
     */
    public function getNoProj(): int
    {
        return $this->noProj;
    }

    /**
     * Set the value of noProj
     *
     * @return  self
     */
    public function setNoProj(int $noProj)
    {
        $this->noProj = $noProj;

        return $this;
    }

    /**
     * Get the value of nomProj
     */
    public function getNomProj(): string
    {
        return $this->nomProj;
    }

    /**
     * Set the value of nomProj
     *
     * @return  self
     */
    public function setNomProj(string $nomProj)
    {
        $this->nomProj = $nomProj;

        return $this;
    }

    /**
     * Get the value of budget
     */
    public function getBudget(): float
    {
        return $this->budget;
    }

    /**
     * Set the value of budget
     *
     * @return  self
     */
    public function setBudget(float $budget)
    {
        $this->budget = $budget;

        return $this;
    }
}
