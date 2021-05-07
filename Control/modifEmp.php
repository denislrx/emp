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
    <title>Modifier</title>
</head>

<body>
    <?php

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
    if (isset($_GET["id"]) || $isThereError) {

        if ($isThereError) {
            foreach ($messages as $message) {
                echo $message;
            }
        }
    }

    $objServ = new ServiceService;
    $tabServ = $objServ->selectAllServ();


    $objProj = new ProjetService;
    $tabProj = $objProj->selectAllProj();


    ?>

    <form action="" method="post" name="formule">
        <input name="id" value="<?php echo $data->getNoEmp() ?>" hidden>
        <div class="container position-absolute top-50 start-50 translate-middle">

            <div class="row">
                <h2 class="text-center">Saisir vos modifications</h2>
            </div>

            <div class="row">
                <label class="col-sm" for="nom">Nom: </label>
                <input class="col-sm" id="nom" size="50" maxlength="20" type="text" placeholder="Nom de famille" name="nomPersonne" value="<?php echo $isThereError ? $_POST["nomPersonne"] : $data->getNom(); ?>" />
                <br />
            </div>

            <div class="row">
                <label class="col-sm" for="prenom">Prénom: </label>
                <input class="col-sm" id="prenom" size="50" maxlength="20" type="text" placeholder="Prénom" name="prenomPersonne" value="<?php echo $isThereError ? $_POST["prenomPersonne"] : $data->getPrenom(); ?>" />
                <br />
            </div>

            <div class="row">
                <label class="col-sm" for="emploi">Emploi </label>
                <input class="col-sm" id="nom" size="50" maxlength="50" type="text" placeholder="Emploi" name="Emploi" value="<?php echo $isThereError ? $_POST["Emploi"] : $data->getEmploi(); ?>" />
                <br />
            </div>

            <div class="row">
                <label class="col-sm" for="superieur">Supérieur</label>
                <input class="col-sm" id="superieur" size="50" maxlength="20" type="text" placeholder="Pas de supérieur" name="Superieur" value="<?php echo $isThereError ? $_POST["Superieur"] : $data->getSup()->getNoEmp(); ?>" />
                <br />
            </div>

            <div class="row">
                <label class="col-sm" for="embauche">Embauche : </label>
                <input class="col-sm" id="embauche" size="50" maxlength="50" type="date" placeholder="Date d'embauche" name="Embauche" value="<?php echo $isThereError ? $_POST["Embauche"] : $data->getEmbauche(); ?>" />
                <br />
            </div>

            <div class="row">
                <label class="col-sm" for="salaire">Salaire</label>
                <input class="col-sm" id="salaire" size="50" maxlength="20" type="text" placeholder="Salaire" name="Salaire" value="<?php echo $isThereError ? $_POST["Salaire"] : $data->getSal(); ?>" />
                <br />
            </div>

            <div class="row">
                <label class="col-sm" for="commission">Commission</label>
                <input class="col-sm" id="commssion" size="50" maxlength="20" type="text" placeholder="Pas de commission" name="Commission" value="<?php echo $isThereError ? $_POST["Commission"] : $data->getCom(); ?>" />
                <br />
            </div>

            <div class="row">
                <label class="col-sm" for="service">Service</label>
                <select class="col-sm" name="IdService">
                    <?php
                    foreach ($tabServ as $value) {

                    ?>

                        <option value="<?php echo $value->getNoServ(); ?>" <?php if (($isThereError ? $_POST["IdService"] : $data->getService()->getServ()) == $value->getServ()) {
                                                                                echo "selected";
                                                                            }
                                                                            ?>><?php echo $value->getServ() ?></option>
                    <?php
                    }
                    ?>
                </select>
                <br />
            </div>

            <div class="row">
                <label class="col-sm" for="projet">Projet</label>
                <select class="col-sm" name="IdProjet">
                    <?php
                    foreach ($tabProj as $value) {

                    ?>

                        <option value="<?php echo $value->getNoProj(); ?>" <?php if (($isThereError ? $_POST["IdProjet"] : $data->getProjet()->getNomProj()) == $value->getNomProj()) {
                                                                                echo "selected";
                                                                            }
                                                                            ?>><?php echo $value->getNomProj() ?></option>
                    <?php
                    }
                    ?>
                </select>
                <br />

            </div>


            <div class="row">
                <button type="submit">Modifier</button>
            </div>
        </div>
    </form>
</body>

</html>