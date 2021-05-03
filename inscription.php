<?php
$erreur = false;
$messageErreur = [];

if (!empty($_POST)) {


    $NextId = NextId();

    if (!isset($_POST["Nom"]) || empty($_POST["Nom"])) {
        $erreur = true;
        $messageErreur[] = "Erreur de saisie du mot de passe ";
    } else {

        $tabNom = listeNom();
        foreach ($tabNom as $nom) {
            if ($_POST["Nom"] == $nom) {
                $erreur = true;
                $messageErreur[] = "Nom déjà utilisé";
            }
        }
    }

    if (!isset($_POST["MDP1"]) || empty($_POST["MDP1"])) {
        $erreur = true;
        $messageErreur[] = "Saisisez le mot de passe une première fois";
    }

    if (!isset($_POST["MDP2"]) || empty($_POST["MDP2"])) {
        $erreur = true;
        $messageErreur[] = "Saisisez le mot de passe une seconde fois";
    }

    if ($_POST["MDP1"] == $_POST["MDP2"]) {
        $MDP = password_hash($_POST["MDP1"], PASSWORD_DEFAULT);
    } else {
        $erreur = true;
        $messageErreur[] = "Les deux saisies de mots de passe ne correspondent pas";
    }


    if (!$erreur) {

        insertion($NextId, $_POST["Nom"], $MDP);
        header("location:connexion.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php
    if ($erreur) {
    ?> <ul> <?php
            foreach ($messageErreur as $message) {
            ?> <li> <?php
                    echo $message;
                    ?> </li> <?php
                            }
                                ?> </ul> <?php
                                        }

                                            ?>

    <div class="container position-absolute top-50 start-50 translate-middle">
        <form action="" method="post">
            <div class="row">
                <h2 class="text-center">Inscription</h2>
            </div>
            <div class="row">
                <div> Nom :</div>
                <input name="Nom" type="text" placeholder="Saisir votre pseudo" value="<?php if ($erreur) {
                                                                                            echo $_POST["Nom"];
                                                                                        }; ?>" />
            </div>
            <div class="row">
                <div> Mot de passe :</div>
                <input name="MDP1" type="password" placeholder="Saisir votre mot de passe" />
            </div>
            <div class="row">
                <div> Confirmer le mot de passe :</div>
                <input name="MDP2" type="password" placeholder="Saisir votre mot de passe" />
            </div>
            <div class="row">
                <button type="submit">Valider</button>
            </div>
        </form>
    </div>

</body>

<?php

function NextId()
{
    $bdd = new mysqli("localhost", "root", "", "personnel_bdd");
    $findNextId = "SELECT Max(IdUser) FROM user;";
    $result = $bdd->query($findNextId);
    $data = $result->fetch_array(MYSQLI_NUM);
    mysqli_free_result($result);
    $NextId = $data[0] + 1;
    mysqli_close($bdd);
    return $NextId;
}
function listeNom()
{
    $bdd = new mysqli("localhost", "root", "", "personnel_bdd");
    $nomUnique = "SELECT DISTINCT Nom from user;";
    $result = $bdd->query($nomUnique);
    $tabNom = $result->fetch_array(MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($bdd);
    return  $tabNom;
}

function insertion($id, $nom, $mdp)
{
    $bdd = new mysqli("localhost", "root", "", "personnel_bdd");
    $insert = "INSERT INTO user(IdUser, Nom, MDP) VALUE(
        " . $id . ",
        '" . $nom . "', 
        '" . $mdp . "' );";
    $bdd->query($insert);
    mysqli_close($bdd);
}
?>