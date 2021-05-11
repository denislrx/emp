<?php

include_once(__DIR__ . "/../Model/User.php");
include_once(__DIR__ . "/ConnexionDAO.php");
include_once(__DIR__ . "/../Exception/UserExceptionDAO.php");

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

class UserDAO extends ConnexionDAO
{

    function searchByName($name)
    {
        try{
        $bdd = $this->connexion();
        $stmt = $bdd->prepare("SELECT * FROM user WHERE Nom = ?;");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        $dataUser = $result->fetch_array(MYSQLI_ASSOC);
        $objUser = new User;
        $result->free();
        $bdd->close();
    }catch(mysqli_sql_exception $exc){
        $message = "La fonction searchByName() ne marche pas";
        throw new UserExceptionDAO($message, $exc->getCode);
    } 
        
        $objUser->setIdUser($dataUser["IdUser"]);
        $objUser->setNom($dataUser["Nom"]);
        $objUser->setMdp($dataUser["MDP"]);
        $objUser->setProfil($dataUser["Profil"]);
        
        return $objUser;
    }

    function nextId()
    {
        try{
            $bdd = $this->connexion();
            $stmt = $bdd->prepare("SELECT Max(IdUser) FROM user");
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_array(MYSQLI_NUM);
            $result->free();
            $NextId = $data[0] + 1;
            $bdd->close();    
        }catch(mysqli_sql_exception $exc){
            $message = "La fonction nextId() ne marche pas";
            throw new UserExceptionDAO($message, $exc->getCode);
        } 
        
        return $NextId;
    }


    function listeNom()
    {
        try{
            $bdd = $this->connexion();
            $stmt = $bdd->prepare("SELECT DISTINCT Nom from user;");
            $stmt->execute();
            $result = $stmt->get_result();
            $tabNom = $result->fetch_array(MYSQLI_ASSOC);
            $result->free();
            $bdd->close();
        }catch(mysqli_sql_exception $exc){
            $message = "La fonction listeNom() ne marche pas";
            throw new UserExceptionDAO($message, $exc->getCode);
        } 
        
        return  $tabNom;
    }

    function insertUser(User $obj)
    {
        try{
            $bdd = $this->connexion();
            $id = $this->nextId();
            $nom = $obj->getNom();
            $mdp = $obj->getMdp();
            $stmt = $bdd->prepare("INSERT INTO user(IdUser, Nom, MDP) VALUE(
            ?,?,? );");
            $stmt->bind_param("iss", $id, $nom, $mdp);
            $stmt->execute();
            $bdd->close();
        }catch(mysqli_sql_exception $exc){
            $message = "La fonction insertUser() ne marche pas";
            throw new UserExceptionDAO($message, $exc->getCode);
        }
        
    }
}
