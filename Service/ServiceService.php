<?php

include_once("DAO/ServiceDAO");

class ServiceService
{

    public function selectAllServ(): array
    {
        $ServiceDAO = new ServiceDAO;
        $Service = $ServiceDAO->selectAllServ();
        return $Service;
    }
}
