<?php
$erreur = false;

if (!empty($_POST)) {


    $dataUser = searchByName($_POST["Nom"]);

    if (password_verify($_POST["MDP"], $dataUser["MDP"])) {
        session_start();
        $_SESSION["Nom"] = $dataUser["Nom"];
        $_SESSION["Profil"] = $dataUser["Profil"];
        header("location:emp.php");
    } else {
        $erreur = true;
        $message = "Identification invalide";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>

    <?php
    if ($erreur) {
        echo $message;
    }

    ?>

    <div class="container position-absolute top-50 start-50 translate-middle">
        <form action="" method="post">
            <div class="row">
                <h2 class="text-center">Connexion</h2>
            </div>
            <div class="row">
                <div> Nom :</div>
                <input name="Nom" type="text" placeholder="Saisir votre pseudo" />
            </div>
            <div class="row">
                <div> Mot de passe :</div>
                <input name="MDP" type="password" placeholder="Saisir votre mot de passe" />
            </div>

            <div class="row">
                <button type="submit">Valider</button>
            </div>
        </form>
    </div>

</body>

<?php
function searchByName($name)
{
    $bdd = mysqli_init();
    mysqli_real_connect($bdd, "localhost", "root", "", "personnel_bdd");
    $verifMdP = "SELECT * FROM user WHERE Nom = '" . $name . "';";
    $result = mysqli_query($bdd, $verifMdP);
    $dataUser = mysqli_fetch_array($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($bdd);
    return $dataUser;
}
?>