<?php

function afficherTableau($compteur, $profil, $objSelectAll, $tabNoEmpChef)
{ ?>
    <!DOCTYPE html>
    <html lang="en">
    <?php
    viewHead();

    ?>

    <body>
        <?php
        viewTableau($compteur, $profil, $objSelectAll, $tabNoEmpChef)
        ?>
    </body>

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
        <title>Données Employés</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous" />
        <link rel="stylesheet" href="style.css" />

    </head>
<?php
}

function viewTableau($compteur, $profil, $objSelectAll, $tabNoEmpChef)
{
?>
    <div class="container">
        <div class="row">
            <div class="row">
                <div class="label"> Nombre de lignes insérées aujourd'hui : <?php echo $compteur ?></div>
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


                foreach ($objSelectAll as $value) {

                    if ($value->getSup() == null) {
                        $sup = "";
                    } else {
                        $sup = $value->getSup()->getNom() . " " . $value->getSup()->getPrenom();
                    }

                ?>
                    <tr>
                        <td> <?php echo $value->getNom() ?></td>
                        <td> <?php echo $value->getPrenom() ?></td>
                        <td> <?php echo $value->getEmploi() ?></td>
                        <td> <?php echo $sup  ?></td>
                        <?php if ($profil == "admin") { ?>
                            <td> <a href='detailEmp.php?id=<?php echo $value->getNoEmp() ?>'><button class="btn btn-primary"> Détail </button></a></td>
                            <td> <a href='modifEmp.php?id=<?php echo $value->getNoEmp() ?>'><button class="btn btn-warning"> Modifier </button></a></td>
                            <td> <?php
                                    if (!in_array($value->getNoEmp(), $tabNoEmpChef)) {
                                    ?> <a href="suppEmp.php?id=<?php echo $value->getNoEmp() ?>"><button class="btn btn-danger"> Supprimer </button></a> <?php
                                                                                                                                                        } ?> </td>
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

<?php

}


function affichDetail($data){
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <?php
    viewHead();
    viewLineDetail($data)
    ?>
    </html>
    <?php
}

function viewLineDetail($data)
{
    ?>
    <body>
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
<?php
}