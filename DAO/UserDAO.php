<?php

include_once(__DIR__ . "/../Model/User.php");
include_once(__DIR__ . "/ConnexionDAO.php");

class UserDAO extends ConnexionDAO
{

    function searchByName($name)
    {
        $bdd = $this->connexion();
        $stmt = $bdd->prepare("SELECT * FROM user WHERE Nom = ?;");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        $dataUser = $result->fetch_array(MYSQLI_ASSOC);
        $objUser = new User;
        $objUser->setIdUser($dataUser["IdUser"]);
        $objUser->setNom($dataUser["Nom"]);
        $objUser->setMdp($dataUser["MDP"]);
        $objUser->setProfil($dataUser["Profil"]);
        $result->free();
        $bdd->close();
        return $objUser;
    }

    function NextId()
    {
        $bdd = $this->connexion();
        $stmt = $bdd->prepare("SELECT Max(IdUser) FROM user");
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_array(MYSQLI_NUM);
        $result->free();
        $NextId = $data[0] + 1;
        $bdd->close();
        return $NextId;
    }


    function listeNom()
    {
        $bdd = $this->connexion();
        $stmt = $bdd->prepare("SELECT DISTINCT Nom from user;");
        $stmt->execute();
        $result = $stmt->get_result();
        $tabNom = $result->fetch_array(MYSQLI_ASSOC);
        $result->free();
        $bdd->close();
        return  $tabNom;
    }

    function insertUser(User $obj)
    {
        $bdd = $this->connexion();
        $id = $this->NextId();
        $nom = $obj->getNom();
        $mdp = $obj->getMdp();
        $stmt = $bdd->prepare("INSERT INTO user(IdUser, Nom, MDP) VALUE(
        ?,?,? );");
        $stmt->bind_param("iss", $id, $nom, $mdp);
        $stmt->execute();
        $bdd->close();
    }
}
