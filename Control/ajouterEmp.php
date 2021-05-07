<?php
include_once(__DIR__ . "/../Service/EmployeService.php");
include_once(__DIR__ . "/../Service/ServiceService.php");
include_once(__DIR__ . "/../Service/ProjetService.php");
session_start();
if (!isset($_SESSION) || empty($_SESSION) || $_SESSION["Profil"] == "user") {
    header("location: connexion.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css" />
    <title>Ajouter une personne</title>
</head>

<body>

    <?php

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



            $sup = new Employe;
            $objPost = new Employe;
            $serv = new Service;
            if (empty($_POST["Commission"])) {
                $comm = null;
            } else {
                $comm = $_POST["Commission"];
            }

            $objPost->setNoEmp($nextId);
            $objPost->setNom($_POST["nomPersonne"]);
            $objPost->setPrenom($_POST["prenomPersonne"]);
            $objPost->setEmploi($_POST["Emploi"]);
            $objPost->setSup($sup);
            $sup->setNoEmp($_POST["Superieur"]);
            $objPost->setEmbauche($_POST["Embauche"]);
            $objPost->setSal($_POST["Salaire"]);
            $objPost->setCom($comm);
            $objPost->setService($serv);
            $serv->setNoServ($_POST["Service"]);

            $objService->insertion($objPost);

            header("location: emp.php");
        } else {

            if ($isThereError) {

                foreach ($messages as $message) {
                    echo $message;
                }
            }
        }
    }

    $objServ = new ServiceService;
    $tabServ = $objServ->selectAllServ();
    $objProj = new ProjetService;
    $tabProj = $objProj->selectAllProj();


    ?>

    <form action="" method="post" name="formule">

        <div class="container position-absolute top-50 start-50 translate-middle">

            <div class="row">
                <h2 class="text-center">Ajouter un personnel</h2>
            </div>

            <div class="row">
                <label class="col-sm" for="nom">Nom: </label>
                <input class="col-sm" id="nom" size="50" maxlength="20" type="text" placeholder="Nom de famille" name="nomPersonne" value="<?php if ($isThereError) {
                                                                                                                                                echo $_POST["nomPersonne"];
                                                                                                                                            }; ?>" />
                <br />
            </div>

            <div class=" row">
                <label class="col-sm" for="prenom">Prénom: </label>
                <input class="col-sm" id="prenom" size="50" maxlength="20" type="text" placeholder="Prénom" name="prenomPersonne" value="<?php if ($isThereError) {
                                                                                                                                                echo $_POST["prenomPersonne"];
                                                                                                                                            } ?>" />
                <br />
            </div>

            <div class=" row">
                <label class="col-sm" for="emploi">Emploi </label>
                <input class="col-sm" id="nom" size="50" maxlength="50" type="text" placeholder="Emploi" name="Emploi" value="<?php if ($isThereError) {
                                                                                                                                    echo $_POST["Emploi"];
                                                                                                                                }
                                                                                                                                ""; ?>" />
                <br />
            </div>

            <div class=" row">
                <label class="col-sm" for="superieur">Supérieur</label>
                <input class="col-sm" id="superieur" size="50" maxlength="20" type="text" placeholder="Supérieur" name="Superieur" value="<?php if ($isThereError) {
                                                                                                                                                echo $_POST["Superieur"];
                                                                                                                                            }  ?>" />
                <br />
            </div>

            <div class=" row">
                <label class="col-sm" for="embauche">Date d'embauche</label>
                <input class="col-sm" id="embauche" size="50" type="date" placeholder="Date d'embauche" name="Embauche" value="<?php if ($isThereError) {
                                                                                                                                    echo $_POST["Superieur"];
                                                                                                                                } ?>" />
                <br />
            </div>

            <div class=" row">
                <label class="col-sm" for="salaire">Salaire</label>
                <input class="col-sm" id="salaire" size="50" maxlength="20" type="text" placeholder="Salaire" name="Salaire" value="<?php if ($isThereError) {
                                                                                                                                        echo $_POST["Salaire"];
                                                                                                                                    } ?>" />
                <br />
            </div>

            <div class=" row">
                <label class="col-sm" for="commission">Commission</label>
                <input class="col-sm" id="commssion" size="50" maxlength="20" type="text" placeholder="Commission" name="Commission" value="<?php if ($isThereError) {
                                                                                                                                                echo $_POST["Commission"];
                                                                                                                                            } ?>" />
                <br />
            </div>

            <div class=" row">
                <label class="col-sm" for="service">Service</label>
                <select class="col-sm" name="Service" ?>">
                    <?php



                    foreach ($tabServ as $value) {
                    ?>
                        <option value="<?php echo $value->getNoServ(); ?>"> <?php echo $value->getServ() ?></option>
                    <?php
                    }
                    ?>
                </select>
                <br />
            </div>



            <div class="row">
                <label class="col-sm" for="projet">Projet</label>
                <select class="col-sm" name="Projet" ?>">
                    <?php


                    foreach ($tabProj as $value) {
                    ?>
                        <option value="<?php echo $value->getNoProj(); ?>"> <?php echo $value->getNomProj() ?></option>
                    <?php
                    }
                    ?>
                </select>
                <br />

            </div>

            <div class="row">
                <button type="submit">Ajouter un nouvel employé</button>
            </div>
        </div>
    </form>
</body>

</html>