<?php

include_once(__DIR__ . "/../Model/Employe.php");

class EmployeDAO
{

    function createTabObj($tab)
    {
        $tabObjEmp = [];
        foreach ($tab as $value) {


            $employe = new Employe();

            if (!is_null($value["Sup"])) {
                $sup = new Employe();
                $sup->setNoEmp($value["NoEmpSup"]);
                $sup->setNom($value["NomSup"]);
                $sup->setPrenom($value["PrenomSup"]);
                $employe->setSup($sup);
            } else {
                $employe->setSup(null);
            }

            $employe->setNoEmp($value["NoEmp"]);
            $employe->setNom($value["Nom"]);
            $employe->setPrenom($value["Prenom"]);
            $employe->setEmploi($value["Emploi"]);
            $employe->setEmbauche($value["Embauche"]);
            $employe->setSal($value["Sal"]);
            $employe->setCom($value["Comm"]);
            $service = new Service();
            $service->setNoServ($value["NoServ"]);
            $service->setServ($value["Serv"]);
            $service->setVille($value["Ville"]);
            $employe->setService($service);
            $projet = new Projet();
            $projet->setNoProj($value["noproj"]);
            $projet->setNomProj($value["nomproj"]);
            $projet->setBudget($value["budget"]);
            $employe->setProjet($projet);
            $employe->setSaisie($value["Saisie"]);
            $tabObjEmp[] = $employe;
        }
        return $tabObjEmp;
    }

    function selectAll()
    {
        $bdd = new mysqli("localhost", "root", "", "personnel_bdd");
        $stmt = $bdd->prepare("SELECT e.*, s.*, p.*,
        e2.NoEmp as NoEmpSup, 
        e2.Nom as NomSup, 
        e2.Prenom as PrenomSup 
        from EMP2 as e 
        left join EMP2 as e2 
        on e.Sup = e2.NoEmp
        inner join Serv2 as s 
        on e.NoServ = s.NoServ 
        inner join proj as p 
        on e.NOPROJ = p.NOPROJ
        ORDER BY e.NoEmp");
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $objDAO = new EmployeDAO;
        $tabEmp = $objDAO->createTabObj($data);
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
        $supp = $obj->supp->getNoEmp();
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
            $supp,
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
        $supp = $obj->getSup()->getNoEmp();
        $embauche = $obj->getEmbauche();
        $sal = $obj->getSal();
        $com = $obj->getCom();
        $noserv = $obj->getService()->getNoServ();
        $noproj = $obj->getProjet()->getNoProj();
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
            $supp,
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
    function nomPrenomChef($id)
    {
        $bdd = new mysqli("localhost", "root", "", "personnel_bdd");
        $stmt = $bdd->prepare("SELECT Nom, Prenom FROM EMP2 WHERE NoEmp = ?;");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_array(MYSQLI_ASSOC);
        return $data;
    }


    function showDetailById($id)
    {
        $bdd = new mysqli("localhost", "root", "", "personnel_bdd");
        $stmt = $bdd->prepare("SELECT e.*, s.*, p.*, e2.NoEmp as NoEmpSup, e2.Nom as NomSup, e2.Prenom as PrenomSup from EMP2 as e left join EMP2 as e2 on e.Sup = e2.NoEmp inner join Serv2 as s on e.NoServ = s.NoServ inner join proj as p on e.NOPROJ = p.NOPROJ where e.NoEmp = ?;");

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_array(MYSQLI_ASSOC);
        // var_dump($data["nomproj"]);

        $employe = new Employe();

        if (!is_null($data["Sup"])) {
            $supp = new Employe();
            $supp->setNoEmp($data["NoEmpSup"]);
            $supp->setNom($data["NomSup"]);
            $supp->setPrenom($data["PrenomSup"]);
            $employe->setSup($supp);
        } else {
            $employe->setSup(null);
        }

        $employe->setNoEmp($data["NoEmp"]);
        $employe->setNom($data["Nom"]);
        $employe->setPrenom($data["Prenom"]);
        $employe->setEmploi($data["Emploi"]);
        $employe->setEmbauche($data["Embauche"]);
        $employe->setSal($data["Sal"]);
        $employe->setCom($data["Comm"]);
        $service = new Service();
        $service->setNoServ($data["NoServ"]);
        $service->setServ($data["Serv"]);
        $service->setVille($data["Ville"]);
        $employe->setService($service);
        $projet = new Projet();
        $projet->setNoProj($data["noproj"]);
        $projet->setNomProj($data["nomproj"]);
        $projet->setBudget($data["budget"]);
        $employe->setProjet($projet);
        $employe->setSaisie($data["Saisie"]);

        $result->free();
        $bdd->close();
        // var_dump($employe);
        return $employe;
    }

    function counter(): int
    {
        $bdd = new mysqli("localhost", "root", "", "personnel_bdd");
        $stmt = $bdd->prepare("SELECT COUNT(*) FROM EMP2 WHERE Saisie = DATE_FORMAT(SYSDATE(),'%Y-%m-%d');");
        $stmt->execute();
        $compt = $stmt->get_result();
        $compteur = $compt->fetch_array(MYSQLI_NUM);
        mysqli_free_result($compt);
        $bdd->close();
        return $compteur[0];
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
            $Sup->setNom($value["Nom"]);
            $Sup->setPrenom($value["Prenom"]);
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
