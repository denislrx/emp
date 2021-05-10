<?php

function afficherConex($erreur, $message)
{
?>
    <!DOCTYPE html>
    <html lang="en">
    <?php
    viewHead();
    echoError($erreur, $message);
    formConnex();

    ?>

    </html>
<?php
}

function echoError($erreur, $message)
{
    if ($erreur) {
        echo $message;
    }
}

function formConnex()
{
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
<?php
}

function afficherInscr($er, $messageErr, $post)
{
?>
    <!DOCTYPE html>
    <html lang="en">
    <?php
    viewHead();
    erreurView($er, $messageErr);
    formInscrView($er, $post)
    ?>

    </html>
<?php
}

function viewHead()
{
?>



    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inscription</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous" />
        <link rel="stylesheet" href="style.css" />
    </head>




<?php


}

function formInscrView($er, $post)
{
?>

    <body>
        <div class="container position-absolute top-50 start-50 translate-middle">
            <form action="inscription.php" method="post">
                <div class="row">
                    <h2 class="text-center">Inscription</h2>
                </div>
                <div class="row">
                    <div> Nom :</div>
                    <input name="Nom" type="text" placeholder="Saisir votre pseudo" value="<?php if ($er) {
                                                                                                echo $post["Nom"];
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
}

function erreurView($er, $messageErr)
{
?> <ul> <?php

        if ($er) {
            foreach ($messageErr as $message) {
        ?> <li> <?php
                echo $message;
                ?> </li> <?php
                        }
                            ?> </ul> <?php
                                    }
                                }
