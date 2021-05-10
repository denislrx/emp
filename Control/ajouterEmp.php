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
if (!isset($_POST)) {
    $isThereError = true;
}
$messages = [];
$syntaxNom = "#^[A-Z-\s]*$#";
$syntaxDate = "#^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$#";
$syntaxSal = "#^[0-9]*\.[0-9]{2}$#";
$syntaxCom = "#^[0-9]*\.[0-9]{2}$|^$#";
$syntaxIdService = "#^[0-9]$#";
$syntaxIdProj = "#^[0-9]{3}$#";
$syntaxIdEmp = "#^[0-9]{4}$#";

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

    if (!isset($_POST["Service"]) || empty($_POST["Service"]) || !preg_match($syntaxIdService, $_POST["Service"])) {
        $isThereError = true;
        $messages[] = "Erreur de saisie dans IdService";
    }

    if (!isset($_POST["Projet"]) || empty($_POST["Projet"]) || !preg_match($syntaxIdProj, $_POST["Projet"])) {
        $isThereError = true;
        $messages[] = "Erreur de saisie dans IdProjet";
    }

    if (!$isThereError) {

        $objService = new EmployeService;
        $nextId = $objService->nextId();
        $supp = new Employe;
        $objPost = new Employe;
        $s = new Service;
        $p = new Projet;
        if (empty($_POST["Commission"])) {
            $comm = null;
        } else {
            $comm = $_POST["Commission"];
        }

        $objPost->setNoEmp($nextId);
        $objPost->setNom($_POST["nomPersonne"]);
        $objPost->setPrenom($_POST["prenomPersonne"]);
        $objPost->setEmploi($_POST["Emploi"]);
        $objPost->setSup($supp);
        $supp->setNoEmp($_POST["Superieur"]);
        $objPost->setEmbauche($_POST["Embauche"]);
        $objPost->setSal($_POST["Salaire"]);
        $objPost->setCom($comm);
        $objPost->setService($s);
        $s->setNoServ($_POST["Service"]);
        $objPost->setProjet($p);
        $p->setNoProj($_POST["Projet"]);

        $objService->insertion($objPost);

        header("location: emp.php");
    }
}

$objServ = new ServiceService;
$tabServ = $objServ->selectAllServ();
$objProj = new ProjetService;
$tabProj = $objProj->selectAllProj();

afficherAjout($isThereError, $tabServ, $tabProj, $messages);
