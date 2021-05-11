<?php
include_once(__DIR__ . "/../Model/Projet.php");
include_once(__DIR__ . "/ConnexionDAO.php");
include_once(__DIR__ . "/../Exception/ProjExceptionDAO.php");



class ProjetDAO extends ConnexionDAO
{

    function selectAllProj()
    {
        try{
            $bdd = $this->connexion();
            $stmt = $bdd->prepare("SELECT * from PROJ;");
            $stmt->execute();
            $result = $stmt->get_result();
            $tabProj = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();
            $bdd->close();
        }catch(mysqli_sql_exception $exc){
            $message = "La fonction selectAllProj() ne marche pas";
            throw new ProjExceptionDAO($message, $exc->getCode());
        }
        

        $tabObjProj = [];
        foreach ($tabProj as $value) {
            $Projet = new Projet;
            $Projet->setNoProj($value["noproj"]);
            $Projet->setNomProj($value["nomproj"]);
            $Projet->setBudget($value["budget"]);
            $tabObjProj[] = $Projet;
        }
        
        return $tabObjProj;
    }
}
