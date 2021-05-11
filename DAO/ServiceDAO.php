<?php
include_once(__DIR__ . "/../Model/Service.php");
include_once(__DIR__ . "/ConnexionDAO.php");
include_once(__DIR__ . "/../Exception/ServExceptionDAO.php");

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

class ServiceDAO extends ConnexionDAO
{

    function selectAllServ()
    {
        try{
            $bdd = $this->connexion();
            $stmt = $bdd->prepare("SELECT * from Serv2;");
            $stmt->execute();
            $result = $stmt->get_result();
            $tab = $result->fetch_all(MYSQLI_ASSOC); 
            $tabObjServ = [];
            $result->free();
            $bdd->close();
        }catch(mysqli_sql_exception $exc){
            $message = "La fonction selectAllServ() ne marche pas";
            throw new ServExceptionDAO($message, $exc->getCode());
        }
        

        foreach ($tab as $value) {
            $service = new Service;
            $service->setNoServ($value["NoServ"]);
            $service->setServ($value["Serv"]);
            $service->setVille($value["Ville"]);
            $tabObjServ[] = $service;
        }

        return $tabObjServ;
    }
}
