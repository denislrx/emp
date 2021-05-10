<?php
include_once(__DIR__ . "/../Model/Service.php");
include_once(__DIR__ . "/ConnexionDAO.php");

class ServiceDAO extends ConnexionDAO
{

    function selectAllServ()
    {
        $bdd = $this->connexion();
        $stmt = $bdd->prepare("SELECT * from Serv2;");
        $stmt->execute();
        $result = $stmt->get_result();
        $tabObjServ = [];
        foreach ($result->fetch_all(MYSQLI_ASSOC) as $value) {
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
