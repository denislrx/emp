
<?php



if (isset($_GET["id"])) {

    deleteLine($_GET["id"]);
}

header("location:emp.php");
