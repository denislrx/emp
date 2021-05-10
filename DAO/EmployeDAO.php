<?php

include_once(__DIR__ . "/../Model/Employe.php");
include_once(__DIR__ . "/ConnexionDAO.php");

class EmployeDAO extends ConnexionDAO
{

    function createTabObj($tab)
    {
        $tabObjEmp = [];
        foreach ($tab as $value) {


            $e = new Employe();

            if (!is_null($value["Sup"])) {
                $s = new Employe();
                $s->setNoEmp($value["NoEmpSup"]);
                $s->setNom($value["NomSup"]);
                $s->setPrenom($value["PrenomSup"]);
                $e->setSup($s);
            } else {
                $e->setSup(null);
            }

            $e->setNoEmp($value["NoEmp"]);
            $e->setNom($value["Nom"]);
            $e->setPrenom($value["Prenom"]);
            $e->setEmploi($value["Emploi"]);
            $e->setEmbauche($value["Embauche"]);
            $e->setSal($value["Sal"]);
            $e->setCom($value["Comm"]);
            $s = new Service();
            $s->setNoServ($value["NoServ"]);
            $s->setServ($value["Serv"]);
            $s->setVille($value["Ville"]);
            $e->setService($s);
            $p = new Projet();
            $p->setNoProj($value["noproj"]);
            $p->setNomProj($value["nomproj"]);
            $p->setBudget($value["budget"]);
            $e->setProjet($p);
            $e->setSaisie($value["Saisie"]);
            $tabObjEmp[] = $e;
        }
        return $tabObjEmp;
    }

    function selectAll()
    {

        $bdd = $this->connexion();
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
        $bdd = $this->connexion();
        $id = $this->nextId();
        $nom = $obj->getNom();
        $prenom = $obj->getPrenom();
        $emploi = $obj->getEmploi();
        $superieur = $obj->getSup()->getNoEmp();
        $embauche = $obj->getEmbauche();
        $sal = $obj->getSal();
        $com = $obj->getCom();
        $noserv = $obj->getService()->getNoServ();
        $noproj = $obj->getProjet()->getNoProj();
        $stmt = $bdd->prepare(" INSERT INTO EMP2(NoEmp, Nom, Prenom, Emploi, Sup, Embauche, Sal, Comm, NoServ, noproj) 
    VALUES(?,?,?,?,?,?,?,?,?,?);");
        $stmt->bind_param(
            "isssisddii",
            $id,
            $nom,
            $prenom,
            $emploi,
            $superieur,
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
        $bdd = $this->connexion();
        $nom = $obj->getNom();
        $prenom = $obj->getPrenom();
        $emploi = $obj->getEmploi();
        $superieur = $obj->getSup()->getNoEmp();
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
            $superieur,
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
        $bdd = $this->connexion();
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
        $bdd = $this->connexion();
        $stmt = $bdd->prepare("SELECT Nom, Prenom FROM EMP2 WHERE NoEmp = ?;");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_array(MYSQLI_ASSOC);
        return $data;
    }


    function showDetailById($id)
    {
        $bdd = $this->connexion();
        $stmt = $bdd->prepare("SELECT e.*, s.*, p.*, e2.NoEmp as NoEmpSup, e2.Nom as NomSup, e2.Prenom as PrenomSup from EMP2 as e left join EMP2 as e2 on e.Sup = e2.NoEmp inner join Serv2 as s on e.NoServ = s.NoServ inner join proj as p on e.NOPROJ = p.NOPROJ where e.NoEmp = ?;");

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_array(MYSQLI_ASSOC);
        // var_dump($data["nomproj"]);

        $e = new Employe();

        if (!is_null($data["Sup"])) {
            $s = new Employe();
            $s->setNoEmp($data["NoEmpSup"]);
            $s->setNom($data["NomSup"]);
            $s->setPrenom($data["PrenomSup"]);
            $e->setSup($s);
        } else {
            $e->setSup(null);
        }

        $e->setNoEmp($data["NoEmp"]);
        $e->setNom($data["Nom"]);
        $e->setPrenom($data["Prenom"]);
        $e->setEmploi($data["Emploi"]);
        $e->setEmbauche($data["Embauche"]);
        $e->setSal($data["Sal"]);
        $e->setCom($data["Comm"]);
        $service = new Service();
        $service->setNoServ($data["NoServ"]);
        $service->setServ($data["Serv"]);
        $service->setVille($data["Ville"]);
        $e->setService($service);
        $p = new Projet();
        $p->setNoProj($data["noproj"]);
        $p->setNomProj($data["nomproj"]);
        $p->setBudget($data["budget"]);
        $e->setProjet($p);
        $e->setSaisie($data["Saisie"]);

        $result->free();
        $bdd->close();
        // var_dump($e);
        return $e;
    }

    function counter(): int
    {
        $bdd = $this->connexion();
        $stmt = $bdd->prepare("SELECT COUNT(*) FROM EMP2 WHERE Saisie = DATE_FORMAT(SYSDATE(),'%Y-%m-%d');");
        $stmt->execute();
        $compt = $stmt->get_result();
        $compteur = $compt->fetch_array(MYSQLI_NUM);
        mysqli_free_result($compt);
        $bdd->close();
        return $compteur[0];
    }
    //service?
    function listChef(): array
    {
        $bdd = $this->connexion();
        $stmt = $bdd->prepare("SELECT DISTINCT Sup FROM EMP2;");
        $stmt->execute();
        $a = $stmt->get_result();
        $tabNoEmpChef = $a->fetch_all(MYSQLI_ASSOC);
        $a->free();
        $bdd->close();
        return $tabNoEmpChef;
    }

    function detailChef(): array
    {
        $bdd = $this->connexion();
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

    function deleteLine(int $id)
    {

        $bdd = $this->connexion();
        $stmt = $bdd->prepare("DELETE FROM  emp2 WHERE NoEmp =?;");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $bdd->close();
    }
}
