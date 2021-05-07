<?php

include_once(__DIR__ . "/../DAO/ProjetDAO.php");

class ProjetService
{

    public function selectAllProj(): array
    {
        $ProjetDAO = new ProjetDAO;
        $Projet = $ProjetDAO->selectAllProj();
        return $Projet;
    }
}
