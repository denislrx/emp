<?php

include_once(__DIR__ . "/../DAO/ServiceDAO.php");
include_once(__DIR__ . "/../Exception/ServExceptionService.php");

class ServiceService
{

    public function selectAllServ(): array
    {
        $ServiceDAO = new ServiceDAO;
    try{
    $Service = $ServiceDAO->selectAllServ(); 
    }catch(ServExceptionDAO $exc){
        throw new ServExceptionService($exc->getMessage());
    }
     
        return $Service;
    }
}
