<?php

include_once(__DIR__ . "/../DAO/ServiceDAO.php");

class ServiceService
{

    public function selectAllServ(): array
    {
        $ServiceDAO = new ServiceDAO;
        $Service = $ServiceDAO->selectAllServ();
        return $Service;
    }
}
