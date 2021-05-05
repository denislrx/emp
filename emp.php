<?php
session_start();
$profil = $_SESSION["Profil"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Données Employés</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php

    include_once("DAO/EmployeDAO.php");

    $data->selectAll();
    ?>
    <div class="container">
        <div class="row">
            <div class="row">

                <?php
                $compteur = counter();
                ?>
                <div class="label"> Nombre de lignes insérées aujourd'hui : <?php echo $compteur[0] ?></div>
                <div><a href='deconnexion.php'> <button class="btn btn-dark"> Déconnexion </a></div>
            </div>
            <table>

                <td> NOM </td>
                <td> PRENOM </td>
                <td> EMPLOI </td>
                <td> SUPERIEUR </td>
                <?php if ($profil == "admin") { ?>
                    <td> Détail </td>
                    <td> Modifier </td>
                    <td> Supprimer </td>
                <?php }

                $tabChef = detailChef();

                $tableau = [];
                $tabNoEmpChef = listChef();

                for ($h = 0; $h < sizeof($tabNoEmpChef); $h++) {
                    $tableau[$h] = $tabNoEmpChef[$h]["Sup"];
                }



                for ($i = 0; $i < sizeof($data); $i++) {
                    $nom = $data[$i]["Nom"];
                    $prenom = $data[$i]["Prenom"];
                    $emploi = $data[$i]["Emploi"];
                    for ($j = 0; $j < sizeof($tabChef); $j++) {
                        if (is_null($data[$i]["Sup"])) {
                            $sup = "";
                        } else if ($tabChef[$j]["NoEmp"] == $data[$i]["Sup"]) {
                            $sup = $tabChef[$j]["Nom"] . " " . $tabChef[$j]["Prenom"];
                        }
                    }


                ?>

                    <tr>
                        <td> <?php echo $nom ?></td>
                        <td> <?php echo $prenom ?></td>
                        <td> <?php echo $emploi ?></td>
                        <td> <?php echo $sup ?></td>
                        <?php if ($profil == "admin") { ?>
                            <td> <a href='detailEmp.php?id=<?php echo $data[$i]["NoEmp"] ?>'><button class="btn btn-primary"> Détail </button></a></td>
                            <td> <a href='modifEmp.php?id=<?php echo $data[$i]["NoEmp"] ?>'><button class="btn btn-warning"> Modifier </button></a></td>
                            <td> <?php if (!in_array($data[$i]["NoEmp"], $tableau)) { ?> <a href='suppEmp.php?id=<?php echo $data[$i]["NoEmp"] ?>'><button class="btn btn-danger"> Supprimer </button></a> <?php } ?> </td>
                        <?php } ?>
                    </tr>
                <?php
                }
                ?>

            </table>
            <?php if ($profil == "admin") { ?>
                <a href='ajouterEmp.php'> <button class="btn btn-dark"> Ajouter des coordonnées </a>
            <?php } ?>
        </div>
    </div>
</body>

</html>