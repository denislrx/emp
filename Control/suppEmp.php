
<?php

include_once(__DIR__ . "/../Service/EmployeService.php");

if (isset($_GET["id"])) {

    $objService = new EmployeService;
    $objService->deleteLine($_GET["id"]);
}

header("location:emp.php");
