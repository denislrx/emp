<?php
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
    if (isset($_GET["id"])) {
        $data = showDetailById($_GET["id"]);
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

                    <tr>

                        <td> <?php echo $data["NoEmp"] ?></td>
                        <td> <?php echo $data["Nom"] ?></td>
                        <td> <?php echo $data["Prenom"] ?></td>
                        <td> <?php echo $data["Emploi"] ?></td>
                        <td> <?php echo $data["Sup"] ?></td>
                        <td> <?php echo $data["Embauche"] ?></td>
                        <td> <?php echo $data["Sal"] ?></td>
                        <td> <?php echo $data["Comm"] ?></td>
                        <td> <?php echo $data["Serv"] ?></td>
                        <td> <?php echo $data["Ville"] ?></td>
                        <td> <?php echo $data["nomproj"] ?></td>
                        <td> <?php echo $data["budget"] ?></td>

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

<?php
function showDetailById($id)
{
    $bdd = new mysqli("localhost", "root", "", "personnel_bdd");
    $stmt = $bdd->prepare("SELECT * from EMP2 as e inner join Serv2 as s inner join proj as p on e.NoServ = s.NoServ and e.NOPROJ = p.NOPROJ where NoEmp =?;");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_array(MYSQLI_ASSOC);
    $result->free();
    $bdd->close();
    return $data;
}
?>