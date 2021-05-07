<?php
include_once(__DIR__ . "/../Model/Service.php");

class ServiceDAO
{

    function selectAllServ()
    {
        $bdd = new mysqli("localhost", "root", "", "personnel_bdd");
        $stmt = $bdd->prepare("SELECT * from Serv2;");
        $stmt->execute();
        $result = $stmt->get_result();
        $tabServ = $result->fetch_all(MYSQLI_ASSOC);
        $tabObjServ = [];
        foreach ($tabServ as $value) {
            $service = new Service;
            $service->setNoServ($value["NoServ"]);
            $service->setServ($value["Serv"]);
            $service->setVille($value["Ville"]);
            $tabObjServ[] = $service;
        }
        $result->free();
        $bdd->close();
        return $tabObjServ;
    }
}
