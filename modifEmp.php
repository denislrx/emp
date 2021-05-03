<?php
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



    if (isset($_GET["id"])) {

        $data = selectAllById($_GET["id"]);
        // var_dump($_POST);
        // var_dump($_GET);
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


            UpdateALine($_POSt, $_POST["id"]);
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

    ?>

    <form action="" method="post" name="formule">
        <input name="id" value="<?php echo $data["NoEmp"] ?>" hidden>
        <div class="container position-absolute top-50 start-50 translate-middle">

            <div class="row">
                <h2 class="text-center">Saisir vos modifications</h2>
            </div>

            <div class="row">
                <label class="col-sm" for="nom">Nom: </label>
                <input class="col-sm" id="nom" size="50" maxlength="20" type="text" placeholder="Nom de famille" name="nomPersonne" value="<?php echo $isThereError ? $_POST["nomPersonne"] : $data["Nom"]; ?>" />
                <br />
            </div>

            <div class="row">
                <label class="col-sm" for="prenom">Prénom: </label>
                <input class="col-sm" id="prenom" size="50" maxlength="20" type="text" placeholder="Prénom" name="prenomPersonne" value="<?php echo $isThereError ? $_POST["prenomPersonne"] : $data["Prenom"]; ?>" />
                <br />
            </div>

            <div class="row">
                <label class="col-sm" for="emploi">Emploi </label>
                <input class="col-sm" id="nom" size="50" maxlength="50" type="text" placeholder="Emploi" name="Emploi" value="<?php echo $isThereError ? $_POST["Emploi"] : $data["Emploi"]; ?>" />
                <br />
            </div>

            <div class="row">
                <label class="col-sm" for="superieur">Supérieur</label>
                <input class="col-sm" id="superieur" size="50" maxlength="20" type="text" placeholder="Pas de supérieur" name="Superieur" value="<?php echo $isThereError ? $_POST["Superieur"] : $data["Sup"]; ?>" />
                <br />
            </div>

            <div class="row">
                <label class="col-sm" for="embauche">Embauche : </label>
                <input class="col-sm" id="embauche" size="50" maxlength="50" type="date" placeholder="Date d'embauche" name="Embauche" value="<?php echo $isThereError ? $_POST["Embauche"] : $data["Embauche"]; ?>" />
                <br />
            </div>

            <div class="row">
                <label class="col-sm" for="salaire">Salaire</label>
                <input class="col-sm" id="salaire" size="50" maxlength="20" type="text" placeholder="Salaire" name="Salaire" value="<?php echo $isThereError ? $_POST["Salaire"] : $data["Sal"]; ?>" />
                <br />
            </div>

            <div class="row">
                <label class="col-sm" for="commission">Commission</label>
                <input class="col-sm" id="commssion" size="50" maxlength="20" type="text" placeholder="Pas de commission" name="Commission" value="<?php echo $isThereError ? $_POST["Commission"] : $data["Comm"]; ?>" />
                <br />
            </div>

            <div class="row">
                <label class="col-sm" for="service">Service</label>
                <select class="col-sm" name="IdService">
                    <?php

                    $tabServ = selectAllServ();



                    for ($i = 0; $i < sizeof($tabServ); $i++) {
                    ?>
                        <option value="<?php echo $tabServ[$i]["NoServ"]; ?>" <?php if (($isThereError ? $_POST["IdService"] : $data["Serv"]) == $tabServ[$i]["Serv"]) {
                                                                                    echo "selected";
                                                                                }
                                                                                ?>><?php echo $tabServ[$i]["Serv"] ?></option>
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
                    $tabProj = selectAllProj();

                    for ($i = 0; $i < sizeof($tabProj); $i++) {
                    ?>
                        <option value="<?php echo $tabProj[$i]["noproj"]; ?>" <?php if (($isThereError ? $_POST["IdProjet"] : $data["NOPROJ"]) == $tabProj[$i]["nomproj"]) {
                                                                                    echo "selected";
                                                                                }
                                                                                ?>><?php echo $tabProj[$i]["nomproj"] ?></option>
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

<?php
function selectAllById($id)
{
    $bdd = new mysqli("localhost", "root", "", "personnel_bdd");
    $requete = "SELECT * from EMP2 as e inner join Serv2 as s inner join proj as p on e.NoServ = s.NoServ and e.NOPROJ = p.NOPROJ where NoEmp =" . $id . ";";
    $result = $bdd->query($requete);
    $data = $result->fetch_array(MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($bdd);
    return $data;
}

function UpdateALine($tab, $id)
{
    $bdd = new mysqli("localhost", "root", "", "personnel_bdd");
    $update = " UPDATE EMP2 SET 
Nom = '" . $tab["nomPersonne"] . "', 
Prenom = '" . $tab["prenomPersonne"] . "', 
Emploi = '" . $tab["Emploi"] . "', 
Sup = '" . $tab["Superieur"] . "', 
Embauche = '" . $tab["Embauche"] . "', 
Sal = '" . $tab["Salaire"] . "', 
Comm = '" . $tab["Commission"] . "', 
NoServ = '" . $tab["IdService"] . "', 
noproj = '" . $tab["IdProjet"] . "' WHERE NoEmp = '" . $id . "';";
    $bdd->query($update);
    mysqli_close($bdd);
}

function selectAllServ()
{
    $bdd = new mysqli("localhost", "root", "", "personnel_bdd");
    $requete = "SELECT * from Serv2";
    $result = $bdd->query($requete);
    $tabServ = $result->fetch_all(MYSQLI_ASSOC);
    $result->free();
    $bdd->close();
    return $tabServ;
}

function selectAllProj()
{
    $bdd = new mysqli("localhost", "root", "", "personnel_bdd");
    $requete = "SELECT * from PROJ";
    $result = $bdd->query($requete);
    $tabProj = $result->fetch_all(MYSQLI_ASSOC);
    $result->free();
    $bdd->close();
    return $tabProj;
}
?>