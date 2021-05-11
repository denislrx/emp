<?php
include_once(__DIR__ . "/../Service/UserService.php");
include_once(__DIR__ . "/../Presentation/InscriptionView.php");

$erreur = false;
$message = "";
$objUser = new UserService;

if (!empty($_POST)) {

try{
    $dataUser = $objUser->searchByName($_POST["Nom"]);
}catch(UserExceptionService $exc){
    echo $exc->getMessage();
}


    if (password_verify($_POST["MDP"], $dataUser->getMdp())) {
        session_start();
        $_SESSION["Nom"] = $dataUser->getNom();
        $_SESSION["Profil"] = $dataUser->getProfil();
        header("location:emp.php");
    } else {
        $erreur = true;
        $message = "Identification invalide";
    }
}

afficherConex($erreur, $message);


