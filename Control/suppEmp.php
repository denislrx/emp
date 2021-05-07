
<?php

include_once(__DIR__ . "/../Service/EmployeService.php");

if (isset($_GET["id"])) {

    deleteLine($_GET["id"]);
}

header("location:emp.php");
