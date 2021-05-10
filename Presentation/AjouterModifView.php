<?php

function afficherAjout($isThereError, $tabServ, $tabProj, $message)
{
?>
    <!DOCTYPE html>
    <html lang="en">
    <?php
    viewHead();
    erreurView($isThereError, $message);
    viewFormAjout($isThereError, $tabServ, $tabProj);
    ?>

    </html>
<?php
}

function erreurView($er, $messageErr)
{
?>
    <ul>
        <?php

        if ($er) {
            foreach ($messageErr as $message) {
        ?> <li> <?php
                echo $message;
                ?> </li> <?php
                        }
                            ?> </ul>

<?php
        }
    }
    function viewHead()
    {
?>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css" />
    <title>Ajouter une personne</title>
</head>
<?php
    }

    function viewFormAjout($isThereError, $tabServ, $tabProj)
    {
?>

    <body>
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
<?php
    }


    function AfficherModif($isThereError, $message, $data, $tabServ, $tabProj)
    {
?>

    <!DOCTYPE html>
    <html lang="en">
    <?php
        viewHead();
        erreurView($isThereError, $message);
        viewFormModif($isThereError, $data, $tabServ, $tabProj);
    ?>

    </html>
<?php
    }

    function viewFormModif($isThereError, $data, $tabServ, $tabProj)
    {
?>

    <body>
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

<?php
    }
