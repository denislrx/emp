<?php
include_once("model/projet.php");

class ProjetDAO
{

    function selectAllProj()
    {
        $bdd = new mysqli("localhost", "root", "", "personnel_bdd");
        $stmt = $bdd->prepare("SELECT * from PROJ;");
        $stmt->execute();
        $result = $stmt->get_result();
        $tabProj = $result->fetch_all(MYSQLI_ASSOC);
        $tabObjProj = [];
        foreach ($tabProj as $value) {
            $Projet = new Projet;
            $Projet->setNoProj($value["noproj"]);
            $Projet->setNomProj($value["nomproj"]);
            $Projet->setBudget($value["budget"]);
            $tabObjProj[] = $Projet;
        }
        $result->free();
        $bdd->close();
        return $tabObjProj;
    }
}
