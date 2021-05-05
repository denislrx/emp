<?php

include_once("DAO/ProjetDAO");

class ProjetService
{

    public function selectAllProj(): array
    {
        $ProjetDAO = new ProjetDAO;
        $Projet = $ProjetDAO->selectAllProj();
        return $Projet;
    }
}
