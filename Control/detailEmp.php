<?php

include_once(__DIR__ . "/../Service/EmployeService.php");

session_start();
if (!isset($_SESSION) || empty($_SESSION) || $_SESSION["Profil"] == "user") {
    header("location: connexion.php");
}
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    $obj = new EmployeService;
    if (isset($_GET["id"])) {
        $data = $obj->showDetailById($_GET["id"]);
    }

    ?>
    <div class="container ">
        <div class="truc">
            <div class="row">
                <table>
                    <td> ID EMPLOYES </td>
                    <td> NOM </td>
                    <td> PRENOM </td>
                    <td> EMPLOI </td>
                    <td> SUPERIEUR</td>
                    <td> EMBAUCHE </td>
                    <td> SALAIRE </td>
                    <td> COMMISSION </td>
                    <td> SERVICE </td>
                    <td> LIEU </td>
                    <td> PROJET </td>
                    <td> BUDGET </td>
                    <?php
                    if ($data->getSup() == null) {
                        $sup = "";
                    } else {
                        $sup = $data->getSup()->getNom() . " " .  $data->getSup()->getPrenom();
                    }
                    ?>
                    <tr>

                        <td> <?php echo $data->getNoEmp() ?></td>
                        <td> <?php echo $data->getNom() ?></td>
                        <td> <?php echo $data->getPrenom() ?></td>
                        <td> <?php echo $data->getEmploi() ?></td>
                        <td> <?php echo $sup ?></td>
                        <td> <?php echo $data->getEmbauche() ?></td>
                        <td> <?php echo $data->getSal() ?></td>
                        <td> <?php echo $data->getCom() ?></td>
                        <td> <?php echo $data->getService()->getServ() ?></td>
                        <td> <?php echo $data->getService()->getVille() ?></td>
                        <td> <?php echo $data->getProjet()->getNomProj() ?></td>
                        <td> <?php echo $data->getProjet()->getBudget() ?></td>

                    </tr>
                </table>
            </div>
            <div class="row">
                <a href='Emp.php'> <button class="btn btn-dark"> Retour au registre </a>
            </div>
        </div>
    </div>

</body>

</html>