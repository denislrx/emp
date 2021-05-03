
<?php



if (isset($_GET["id"])) {

    deleteLine($_GET["id"]);
}

header("location:emp.php");

function deleteLine($id)
{

    $bdd = new mysqli("localhost", "root", "", "personnel_bdd");
    $stmt = $bdd->prepare("DELETE FROM  emp2 WHERE NoEmp =?;");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $bdd->close();
}
