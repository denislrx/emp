<?php

include_once(__DIR__ . "/../Service/UserService.php");

$erreur = false;
$messageErreur = [];
$objUser = new UserService;
if (!empty($_POST)) {


    $NextId = $objUser->nextId();

    if (!isset($_POST["Nom"]) || empty($_POST["Nom"])) {
        $erreur = true;
        $messageErreur[] = "Erreur de saisie du mot de passe ";
    } else {

        $tabNom = $objUser->listeNom();
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
        $objProfil = new User;
        $objProfil->setNom($_POST["Nom"]);
        $objProfil->setMDP($_POST["MDP1"]);
        $objUser->insertion($objProfil);
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