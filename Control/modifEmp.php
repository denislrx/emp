<?php

include_once(__DIR__ . "/../Service/EmployeService.php");
include_once(__DIR__ . "/../Service/ServiceService.php");
include_once(__DIR__ . "/../Service/ProjetService.php");
include_once(__DIR__ . "/../Presentation/AjouterModifView.php");


session_start();
if (!isset($_SESSION) || empty($_SESSION) || $_SESSION["Profil"] == "user") {
    header("location: connexion.php");
}

$isThereError = false;
$messages = [];
$syntaxNom = "#^[A-Z-\s]*$#";
$syntaxDate = "#^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$#";
$syntaxSal = "#^[0-9]*\.[0-9]{2}$#";
$syntaxCom = "#^[0-9]*\.[0-9]{2}$|^$#";
$syntaxIdService = "#^[0-9]$#";
$syntaxIdProj = "#^[0-9]{3}$#";
$syntaxIdEmp = "#^[0-9]{4}$#";
$obj = new EmployeService;


if (isset($_GET["id"])) {

    $data = $obj->showDetailById($_GET["id"]);
}
if (!empty($_POST)) {

    if (!isset($_POST["nomPersonne"]) || empty($_POST["nomPersonne"]) || !preg_match($syntaxNom, $_POST["nomPersonne"])) {
        $isThereError = true;
        $messages[] = "Erreur de saisie du nom";
    }

    if (!isset($_POST["prenomPersonne"]) || empty($_POST["prenomPersonne"]) || !preg_match($syntaxNom, $_POST["prenomPersonne"])) {
        $isThereError = true;
        $messages[] = "Erreur de saisie du prénom";
    }

    if (!isset($_POST["Emploi"]) || empty($_POST["Emploi"]) || !preg_match($syntaxNom, $_POST["Emploi"])) {
        $isThereError = true;
        $messages[] = "Erreur de saisie d'emploi";
    }

    if (!isset($_POST["Embauche"]) || empty($_POST["Embauche"]) || !preg_match($syntaxDate, $_POST["Embauche"])) {
        $isThereError = true;
        $messages[] = "Erreur de saisie d'embauche";
    }

    if (!isset($_POST["Superieur"]) || empty($_POST["Superieur"]) || !preg_match($syntaxIdEmp, $_POST["Superieur"])) {
        $isThereError = true;
        $messages[] = "Erreur de saisie de supérieur";
    }

    if (!isset($_POST["Salaire"]) || empty($_POST["Salaire"]) || !preg_match($syntaxSal, $_POST["Salaire"])) {
        $isThereError = true;
        $messages[] = "Erreur de saisie dans salaire";
    }

    if (!isset($_POST["Commission"]) || !preg_match($syntaxCom, $_POST["Commission"])) {
        $isThereError = true;
        $messages[] = "Erreur de saisie dans commissions";
    }

    if (!isset($_POST["IdService"]) || empty($_POST["IdService"]) || !preg_match($syntaxIdService, $_POST["IdService"])) {
        $isThereError = true;
        $messages[] = "Erreur de saisie dans IdService";
    }

    if (!isset($_POST["IdProjet"]) || empty($_POST["IdProjet"]) || !preg_match($syntaxIdProj, $_POST["IdProjet"])) {
        $isThereError = true;
        $messages[] = "Erreur de saisie dans IdProjet";
    }


    if (!$isThereError) {


        $obj->UpdateALine($_POSt, $_POST["id"]);
        header("location:emp.php");
    }
}


$objServ = new ServiceService;
$tabServ = $objServ->selectAllServ();


$objProj = new ProjetService;
$tabProj = $objProj->selectAllProj();


AfficherModif($isThereError, $messages, $data, $tabServ, $tabProj);
