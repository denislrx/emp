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

    $data = selectAll();
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

<?php
function selectAll()
{
    $bdd = new mysqli("localhost", "root", "", "personnel_bdd");
    $stmt = $bdd->prepare("SELECT * FROM EMP2;");
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($bdd);
    return $data;
}

function counter()
{
    $bdd = new mysqli("localhost", "root", "", "personnel_bdd");
    $stmt = $bdd->prepare("SELECT COUNT(*) FROM EMP2 WHERE Saisie = DATE_FORMAT(SYSDATE(),'%Y-%m-%d');");
    $stmt->execute();
    $compt = $stmt->get_result();
    $compteur = $compt->fetch_array(MYSQLI_NUM);
    mysqli_free_result($compt);
    $bdd->close();
    return $compteur;
}

function listChef()
{
    $bdd = new mysqli("localhost", "root", "", "personnel_bdd");
    $stmt = $bdd->prepare("SELECT DISTINCT Sup FROM EMP2;");
    $stmt->execute();
    $a = $stmt->get_result();
    $tabNoEmpChef = $a->fetch_all(MYSQLI_ASSOC);
    $a->free();
    $bdd->close();
    return $tabNoEmpChef;
}

function detailChef()
{
    $bdd = new mysqli("localhost", "root", "", "personnel_bdd");
    $stmt = $bdd->prepare(" SELECT NoEmp, Nom, Prenom FROM EMP2 WHERE NoEmp IN (SELECT DISTINCT Sup FROM EMP2);");
    $stmt->execute();
    $chef = $stmt->get_result();
    $tabChef = $chef->fetch_all(MYSQLI_ASSOC);
    $chef->free();
    $bdd->close();
    return $tabChef;
}
?>