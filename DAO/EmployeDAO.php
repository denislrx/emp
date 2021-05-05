<?php

include_once("Model/Employe.php");

class EmployeDAO
{

    function selectAll()
    {
        $bdd = new mysqli("localhost", "root", "", "personnel_bdd");
        $stmt = $bdd->prepare("SELECT * FROM EMP2;");
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $tabEmp = [];
        foreach ($data as $value) {
            $Employe = new Employe;
            $Employe->setNoEmp($value["NoEmp"]);
            $Employe->setNom($value["Nom"]);
            $Employe->setPrenom($value["Prenom"]);
            $Employe->setEmploi($value["Emploi"]);
            $Employe->setSup($value["Sup"]);
            $Employe->setEmbauche($value["Embauche"]);
            $Employe->setSal($value["Sal"]);
            $Employe->setCom($value["Comm"]);
            $Employe->service->setNoServ($value["NoServ"]);
            $Employe->projet->setNoProj($value["NOPROJ"]);
            $Employe->setSaisie($value["Saisie"]);
            $tabEmp[] = $Employe;
        }
        mysqli_free_result($result);
        mysqli_close($bdd);
        return $tabEmp;
    }

    function insertion(Employe $obj)
    {
        $bdd = new mysqli("localhost", "root", "", "personnel_bdd");
        $id = $this->nextId();
        $nom = $obj->getNom();
        $prenom = $obj->getPrenom();
        $emploi = $obj->getEmploi();
        $sup = $obj->getSup();
        $embauche = $obj->getEmbauche();
        $sal = $obj->getSal();
        $com = $obj->getCom();
        $noserv = $obj->service->getNoServ();
        $noproj = $obj->projet->getNoProj();
        $stmt = $bdd->prepare(" INSERT INTO EMP2(NoEmp, Nom, Prenom, Emploi, Sup, Embauche, Sal, Comm, NoServ, noproj) 
    VALUES(?,?,?,?,?,?,?,?,?,?);");
        $stmt->bind_param(
            "isssisddii",
            $id,
            $nom,
            $prenom,
            $emploi,
            $sup,
            $embauche,
            $sal,
            $com,
            $noserv,
            $noproj,
        );
        $stmt->execute();
        $bdd->close();
    }

    function UpdateALine(Employe $obj, int $id)
    {
        $bdd = new mysqli("localhost", "root", "", "personnel_bdd");
        $nom = $obj->getNom();
        $prenom = $obj->getPrenom();
        $emploi = $obj->getEmploi();
        $sup = $obj->getSup();
        $embauche = $obj->getEmbauche();
        $sal = $obj->getSal();
        $com = $obj->getCom();
        $noserv = $obj->service->getNoServ();
        $noproj = $obj->projet->getNoProj();
        $stmt = $bdd->prepare(" UPDATE EMP2 SET 
    Nom = ?, 
    Prenom = ?, 
    Emploi = ?, 
    Sup = ?, 
    Embauche = ?, 
    Sal = ?, 
    Comm = ?, 
    NoServ = ?, 
    noproj = ? WHERE NoEmp = ?;");
        $stmt->bind_param(
            "sssisddiii",
            $nom,
            $prenom,
            $emploi,
            $sup,
            $embauche,
            $sal,
            $com,
            $noserv,
            $noproj,
            $id
        );
        $stmt->execute();
        mysqli_close($bdd);
    }

    function nextId()
    {
        $bdd = new mysqli("localhost", "root", "", "personnel_bdd");
        $stmt = $bdd->prepare("SELECT Max(NoEmp) FROM EMP2;");
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_array(MYSQLI_NUM);
        $result->free();
        $bdd->close();
        $NextId = $data[0] + 1;
        return $NextId;
    }

    function showDetailById($id)
    {
        $bdd = new mysqli("localhost", "root", "", "personnel_bdd");
        $stmt = $bdd->prepare("SELECT * from EMP2 as e inner join Serv2 as s inner join proj as p on e.NoServ = s.NoServ and e.NOPROJ = p.NOPROJ where NoEmp =?;");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_array(MYSQLI_ASSOC);
        $Employe = new Employe;
        $Employe->setNoEmp($data["NoEmp"]);
        $Employe->setNom($data["Nom"]);
        $Employe->setPrenom($data["Prenom"]);
        $Employe->setEmploi($data["Emploi"]);
        $Employe->setSup($data["Sup"]);
        $Employe->setEmbauche($data["Embauche"]);
        $Employe->setSal($data["Sal"]);
        $Employe->setCom($data["Comm"]);
        $Employe->service->setNoServ($data["NoServ"]);
        $Employe->service->setServ($data["Serv"]);
        $Employe->service->setVille($data["Ville"]);
        $Employe->projet->setNoProj($data["noproj"]);
        $Employe->projet->setNomProj($data["nomproj"]);
        $Employe->projet->setVille($data["budget"]);
        $Employe->setSaisie($data["Saisie"]);
        $result->free();
        $bdd->close();
        return $Employe;
    }

    function counter()
    {
        $bdd = new mysqli("localhost", "root", "", "personnel_bdd");
        $stmt = $bdd->prepare("SELECT COUNT(*) FROM EMP2 WHERE Saisie = DATE_FORMAT(SYSDATE(),'%Y-%m-%d');");
        $stmt->execute();
        $compt = $stmt->get_result();
        $compteur = $compt->fetch_array(MYSQLI_NUM);
        mysqli_free_result($compt);
        $bdd->close();
        return $compteur;
    }
    //service?
    function listChef()
    {
        $bdd = new mysqli("localhost", "root", "", "personnel_bdd");
        $stmt = $bdd->prepare("SELECT DISTINCT Sup FROM EMP2;");
        $stmt->execute();
        $a = $stmt->get_result();
        $tabNoEmpChef = $a->fetch_all(MYSQLI_ASSOC);
        $a->free();
        $bdd->close();
        return $tabNoEmpChef;
    }

    function detailChef()
    {
        $bdd = new mysqli("localhost", "root", "", "personnel_bdd");
        $stmt = $bdd->prepare(" SELECT NoEmp, Nom, Prenom FROM EMP2 WHERE NoEmp IN (SELECT DISTINCT Sup FROM EMP2);");
        $stmt->execute();
        $chef = $stmt->get_result();
        $tabChef = $chef->fetch_all(MYSQLI_ASSOC);
        $objChef = [];
        foreach ($tabChef as $value) {
            $Sup = new Employe;
            $Sup->setNoEmp($value["NoEmp"]);
            $Sup->setNoEmp($value["Nom"]);
            $Sup->setNoEmp($value["Prenom"]);
            $objChef[] = $Sup;
        }
        $chef->free();
        $bdd->close();
        return $objChef;
    }

    function deleteLine($id)
    {

        $bdd = new mysqli("localhost", "root", "", "personnel_bdd");
        $stmt = $bdd->prepare("DELETE FROM  emp2 WHERE NoEmp =?;");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $bdd->close();
    }
}
