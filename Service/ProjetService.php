<?php

include_once(__DIR__ . "/../DAO/ProjetDAO.php");
include_once(__DIR__ . "/../Exception/ProjExceptionService.php");

class ProjetService
{

    public function selectAllProj(): array
    {
        $ProjetDAO = new ProjetDAO;
        try{
            $Projet = $ProjetDAO->selectAllProj();
        }catch(ProjExceptionDAO $exc){
            throw new ProjExceptionService($exc->getMessage());
        }

        return $Projet;
    }
}
