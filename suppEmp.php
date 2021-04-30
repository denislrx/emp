
<?php



if (isset($_GET["id"])) {

    $bdd = mysqli_init();
    mysqli_real_connect($bdd, "localhost", "root", "", "personnel_bdd");
    $delete = "DELETE FROM  emp2 WHERE NoEmp =" . $_GET["id"] . ";";
    mysqli_query($bdd, $delete);
}

header("location:emp.php");
