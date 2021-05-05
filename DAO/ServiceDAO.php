<?php
include_once("model/service.php");

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
            $Service = new Service;
            $Service->setNoServ($value["NoServ"]);
            $Service->setServ($value["Serv"]);
            $Service->setVille($value["Ville"]);
            $tabObjServ[] = $Service;
        }
        $result->free();
        $bdd->close();
        return $tabServ;
    }
}
